<?php

class MaterialController extends Controller
{
    
        public function actionDynamicmaterial() {
            //$data = Material::model()->findAll('cat_id=:cat_id', array(':cat_id'=>(int) $_POST['PoItems']['material_cat']));
            $data = Material::model()->findAll('cat_id=:cat_id', array(':cat_id'=>(int) $_POST['material_cat']));
            $data = CHtml::listData($data, 'material_id','description');
            foreach($data as $value=>$name) {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }
        }
    
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
                            'actions'=>array('index','view', 'create','update', 'delete', 'dynamicmaterial'),
                            'roles'=>array('admin', 'user'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Material;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Material']))
		{
			$model->attributes=$_POST['Material'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->material_id));
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

		if(isset($_POST['Material']))
		{
			$model->attributes=$_POST['Material'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->material_id));
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
                    try {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
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
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Material('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Material']))
			$model->attributes=$_GET['Material'];

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
		$model=Material::model()->with('cat')->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='material-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
