<?php

class SiteController extends Controller
{
public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('@'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('login','logout'),
						'users'=>array('*'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	/*function actionLogout () {
		Yii::app()->user->logout();
	}*/

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new Files;
		$userId = isset(Yii::app()->user->_id) ? Yii::app()->user->_id : 1;
		$data = $model->findAll(array("condition"=>"parent=0 && createdBy = $userId"));
		$output = array();
		foreach( $data as $objData ) {
			$output[] = $objData->getAttributes();
		}
		//echo json_encode($output);
		$this->render('index',array('message'=>$output));
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
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		$loginFlag = isset($_GET['id']) ? $_GET['id'] : 0;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']) && $loginFlag)
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form		
		$userModel=new User;
		if(isset($_POST['User']))
		{			
			$userModel->attributes=$_POST['User'];
			if($userModel->save()) {
				$loginArray = array();
				$loginArray['username'] = $_POST['User']['username'];
				$loginArray['password'] = $_POST['User']['password'];
				$loginArray['rememberMe'] = 0;
				//Create some default folders for the user
				$files = array("name" => "home", "parent" => 0, "createdBy" => $userModel->id, "folder" => 1);
				$this->createFiles ($files);
				
				$files = array("name" => "share", "parent" => 0, "createdBy" => $userModel->id, "folder" => 1);
				$this->createFiles ($files);
				
				$files = array("name" => $loginArray['username'] , "parent" => 0, "createdBy" => $userModel->id, "folder" => 1);
				$this->createFiles ($files);
				
				$model->attributes=$loginArray;
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
				
		}
		$this->render('login',array('model'=>$model));
		$this->renderPartial('register',array('model'=>$userModel));
	}
	private function createFiles ($files)
	{
		$model=new Files;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($files))
		{
			//$files['createdBy'] = ($files['createdBy'] == 0 ) ? 1 : Yii::app()->user->_id; // set to logged in user id
			//print_r($_POST['Files'])	; die();
			$model->attributes=$files;
			if($model->save())
				echo json_encode(array("id" => $model->id));
			//$this->redirect(array('view','id'=>$model->id));
		}
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