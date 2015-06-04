<?php

class SaleItemController extends Controller
{   
	public function actionCreate($id)
	{
               $model = new SaleItems;

               //$this->performAjaxValidation($model);
               
               $model->sale_id = $id;

                if(isset($_POST['SaleItems']))
                {
                    $model->attributes = $_POST['SaleItems'];
                    if($model->save()) {
                        if(Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status'=>1, 
                               ));
                            exit;
                        }
                        else 
                            $this->redirect(array('/saleOrder/view', 'id'=>$id));
                    } 
                }

                if(Yii::app()->request->isAjaxRequest) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
                    echo CJSON::encode(array(
                        'status'=>0, 
                        'div'=>$this->renderPartial('/saleitems/_form',array('model'=>$model), true, true)));
                    exit;
                }
	}
        
        public function actionUpdate()
	{
            $es = new EditableSaver('SaleItems');  //'SaleItems' is name of model to be updated
            $es->onBeforeUpdate = function($event) {
                // The models beforeupdate method will update this, this will just force it to be updated in the database
                $event->sender->setAttribute('qty_diff', 0);  
            };
            $es->update();
	}
        
        
        public function actionDelete($material_id, $sale_id) {
            if(Yii::app()->request->isPostRequest)
            {
                    // we only allow deletion via POST request
                    $this->loadModel($material_id, $sale_id)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        }

	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view', 'create', 'update', 'delete','update'),
				'roles'=>array('admin', 'user'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function loadModel($material_id, $sale_id)
	{
		$model = SaleItems::model()->findByAttributes(array('material_id'=>$material_id, 'sale_id'=>$sale_id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'postOnly + delete', // we only allow deletion via POST request
		);
	}

	
}