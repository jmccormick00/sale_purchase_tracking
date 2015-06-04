<?php

class ReportController extends Controller
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
                        //'postOnly + delete', // we only allow deletion via POST request
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
                            'actions'=>array('index', 'excel'),
                            'roles'=>array('admin', 'user'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
                );
	}
        
        public function actionExcel()
	{
                
            Yii::import('ext.phpexcel.XPHPExcel');
            $objPHPExcel = XPHPExcel::createPHPExcel();
            //$objReader = PHPExcel_IOFactory::createReader('Excel5');
            //$objPHPExcel = $objReader->load(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR."PO_Template.xls");
            
            $data = $_SESSION['reportdata-excel'];
            $data->setPagination(false);
            //$criteria = $_SESSION['reportcriteria-excel'];
            
            $objPHPExcel->getProperties()->setCreator(Yii::app()->user->name)
                             ->setLastModifiedBy(Yii::app()->user->name)
                             ->setTitle("Report");
                             //->setSubject("Office 2007 XLSX Test Document")
                             //->setDescription("Sales Order#")
                             //->setKeywords("office 2007 openxml php")
                             //->setCategory("Test result file");
           

            $row = 3;
            $i = 1;
            // Write the sale items now
            $items = $data->getData();
            foreach($items as $item) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("B".$row, $i)
                    ->setCellValue("C".$row, $item["compName"])
                    ->setCellValue("D".$row, $item["shippedSum"]);
                $i++;
                $row++;
            }
                        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            // Redirect output to a client’s web browser
            //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Report.xls"');
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
	 * The report page
	 */
	public function actionIndex()
	{
		$model=new ReportForm();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReportForm']))
			$model->attributes=$_GET['ReportForm'];

		$this->render('index',array(
			'model'=>$model,
		));
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
