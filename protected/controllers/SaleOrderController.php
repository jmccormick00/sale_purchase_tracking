<?php

class SaleOrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                    array('allow',  
                            'actions'=>array('index','view', 'create','update', 'delete', 'excel', 'updateview'),
                            'roles'=>array('admin', 'user'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
                );
	}
        
        public function actionUpdateview()
	{
            $es = new EditableSaver('SaleOrder');  //'SaleOrder' is name of model to be updated
            $es->onBeforeUpdate = function($event) {
                // The models beforeupdate method will update this, this will just force it to be updated in the database
                $event->sender->setAttribute('updated', 0);  
            };
            $es->update();
	}
        
        public function actionExcel($id)
	{
            $sale = $this->loadModel($id);
                
            $saleItemCriteria = new CDbCriteria;
            $saleItemCriteria->with = array('material');
            $saleItemCriteria->compare('sale_id', $id);

            $saleItemDataProvider = new CActiveDataProvider( 'SaleItems' , array(
                    'criteria'=>$saleItemCriteria,
                    'pagination'=>false,
                ));
                
            Yii::import('ext.phpexcel.XPHPExcel');
            $objPHPExcel = XPHPExcel::createPHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."Sale_Template.xls");
            
            $objPHPExcel->getProperties()->setCreator(Yii::app()->user->name)
                             ->setLastModifiedBy(Yii::app()->user->name)
                             ->setTitle("Sale Order-" . $id);
                             //->setSubject("Office 2007 XLSX Test Document")
                             //->setDescription("Sales Order#")
                             //->setKeywords("office 2007 openxml php")
                             //->setCategory("Test result file");
            
            // Add the data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C2', $sale->sale_id)
                        ->setCellValue('C3', $sale->po_number)
                        ->setCellValue('C4', Yii::app()->dateFormatter->formatDateTime($sale->maturity_date, "short", null))
                        ->setCellValue('C5', Yii::app()->dateFormatter->formatDateTime($sale->created, "short", null))
                        ->setCellValue('C6', Yii::app()->dateFormatter->formatDateTime($sale->updated, "short", null))
                        ->setCellValue('E2', $sale->comp->name)
                        ->setCellValue('E3', $sale->contact)
                        ->setCellValue('E4', $sale->contact_telephone)
                        ->setCellValue('C7', $sale->paymentTerm->description)
                        ->setCellValue('C8', $sale->is_open ? "Open" : "Closed")
                        ->setCellValue('A9', "Comments:\r".$sale->comments)
                        ->setCellValue('D6', $sale->address->address1);
            
            
            if(isset($sale->address2)) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D7', $sale->address2)
                        ->setCellValue('D8', $sale->address->city.', '.$sale->address->province.' '.$sale->address->postal_code.' '.$sale->address->country_code);
            } else {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D7', $sale->address->city.', '.$sale->address->province.' '.$sale->address->postal_code.' '.$sale->address->country_code);
            }

            $row = 14;
            //$i = 1;
            // Write the sale items now
            $items = $saleItemDataProvider->getData();
            foreach($items as $item) {
                $objPHPExcel->setActiveSheetIndex(0)
                    //->setCellValue("A".$row, $i)
                    ->setCellValue("B".$row, $item->material->cat->description."-".$item->material->description)
                    ->setCellValue("D".$row, $item->qty)
                    ->setCellValue("E".$row, $item->qty_units)
                    ->setCellValue("F".$row, $item->unit_price)
                    ->setCellValue("G".$row, $item->price_units)
                    ->setCellValue("H".$row, $item->qty_shipped)
                    ->setCellValue("I".$row, $item->qty_diff);
                //$i++;
                $row++;
            }
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            // Redirect output to a client’s web browser
            //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename='. '"SaleOrder-' .$id. '.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $sale = $this->loadModel($id);
                
                $saleItemCriteria = new CDbCriteria;
                $saleItemCriteria->with = array('material');
                $saleItemCriteria->compare('sale_id', $id);

                $saleItemDataProvider = new CActiveDataProvider( 'SaleItems' , array(
                        'criteria'=>$saleItemCriteria,
                        //'sort'=>$sort,
                        'pagination'=>array(
                         'pageSize'=>10,
                        ),
                    ));
                
		$this->render('view',array(
			'model'=>$sale,
                        'saleItemDataProvider'=>$saleItemDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SaleOrder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SaleOrder']))
		{
			$model->attributes=$_POST['SaleOrder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->sale_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SaleOrder']))
		{
			$model->attributes=$_POST['SaleOrder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->sale_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('SaleOrder');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new SaleOrder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SaleOrder']))
			$model->attributes=$_GET['SaleOrder'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SaleOrder::model()->with('comp')->with('address')->with('paymentTerm')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sale-order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
