<?php

class AddressController extends Controller
{
    
        public function actionDynamicaddress() {
            //$data = Address::model()->findAll('comp_id=:comp_id', array(':comp_id'=>(int) $_POST['SaleOrder']['comp_id']));
            $data = Address::model()->findAll('comp_id=:comp_id', array(':comp_id'=>(int) $_POST['comp_id']));
 
            
            $data = CHtml::listData($data, 'address_id','name');
            foreach($data as $value=>$name) {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }
        }
    
	public function actionCreate($id)
	{
		$model = new Address;

               //$this->performAjaxValidation($model);
               
               $model->comp_id = $id;

                if(isset($_POST['Address']))
                {
                    $model->attributes = $_POST['Address'];
                    if($model->save()) {
                        if(Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status'=>1, 
                               ));
                            exit;
                        }
                        else 
                            $this->redirect(array('/company/view', 'id'=>$id));
                    } 
                }

                if(Yii::app()->request->isAjaxRequest) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;  
                    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
                    echo CJSON::encode(array(
                        'status'=>0, 
                        'div'=>$this->renderPartial('/address/_form',array('model'=>$model), true)));
                    exit;
                }
	}
        
        public function actionUpdate() {
            $es = new EditableSaver('Address');  //'Address' is name of model to be updated
            $es->onBeforeUpdate = function($event) {
                // The models beforeupdate method will update this, this will just force it to be updated in the database
                $event->sender->setAttribute('updated', 0);  
            };
            $es->update();
        }
        
        public function actionDelete($address_id, $comp_id) {
            if(Yii::app()->request->isPostRequest)
            {
                try {
			// we only allow deletion via POST request
                        $this->loadModel($address_id, $comp_id)->delete();
                        if(!isset($_GET['ajax'])) {
                            Yii::app()->user->setFlash('success','<strong>Success!</strong> Delete Successfull');
                        } else {
                            echo "<div class='alert alert-block alert-success'><strong>Success!</strong> Delete Successfull</div>";
                        }
                    } catch(CDbException $e) {

                        if(!isset($_GET['ajax'])) {
                            Yii::app()->user->setFlash('error','<strong>Error!<strong> Can not remove this item due to existing relationships!');
                        } else {
                            echo "<div class='alert alert-block alert-error'><strong>Error!<strong> Can not remove this item due to existing relationships!</div>"; //for ajax
                        }
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        }

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'create', 'update', 'delete', 'dynamicaddress'),
				'roles'=>array('admin', 'user'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function loadModel($address_id, $comp_id)
	{
		$model = Address::model()->findByAttributes(array('address_id'=>$address_id, 'comp_id'=>$comp_id));
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