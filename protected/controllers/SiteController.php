<?php

class SiteController extends Controller
{
        public $layout='//layouts/column1';
	/**
	 * Declares class-based actions.
	 */
//	public function actions()
//	{

//	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $criteriaPO = new CDbCriteria;
            $criteriaPO->with = array('comp');
            $criteriaPO->compare('is_open', 1);

//            $sortPO = new CSort;
//            $sortPO->attributes = array(
//                'maturity_date' => array(
//                    'asc' => 'maturity_date',
//                    'desc' => 'maturity_date DESC'
//                ),
//            );

            $poDataProvider = new CActiveDataProvider('PurchaseOrder' , array(
                    'criteria'=>$criteriaPO,
                    //'sort'=>$sortPO,
                    'pagination'=>array(
                     'pageSize'=>10,
                    ),
            ));
            
            $criteriaSale = new CDbCriteria;
            $criteriaSale->with = array('comp');
            $criteriaSale->compare('is_open', 1);

//            $sortSale = new CSort;
//            $sortSale->attributes = array(
//                'maturity_date' => array(
//                    'asc' => 'maturity_date',
//                    'desc' => 'maturity_date DESC'
//                ),
//            );

            $saleDataProvider = new CActiveDataProvider('SaleOrder' , array(
                    'criteria'=>$criteriaSale,
                    //'sort'=>$sortSale,
                    'pagination'=>array(
                     'pageSize'=>10,
                    ),
            ));
            
            
            // renders the view file 'protected/views/site/index.php'
            // using the default layout 'protected/views/layouts/main.php'
            $this->render('index', array(
                'poDataProvider' =>  $poDataProvider,
                'saleDataProvider' => $saleDataProvider,
            ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}