<?php

class FilesController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','getchild','upload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	protected function getFileName ($filename = '',$parentId) {
		$filename = empty($filename) ? md5(time().uniqid()).".jpg" : $filename;
		$userId = Yii::app()->user->_id;
		$model=new Files;
		$data = $model->findAll(array("condition"=>"parent=$parentId && createdBy = $userId && name = '$filename'"));
		$output = array();
		foreach( $data as $objData ) {
			$output[] = $objData->getAttributes();
		}
		if(count($output) > 0)
		{
			return count($output) . "." . $filename;
		}
		else
		{
			return $filename;
		}
	}
	
	public function actionUpload()
	{	
		$parentId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
		$basepath = Yii::app()->basePath;
		$basepath = str_replace("protected", "", $basepath);
		
		$str = file_get_contents('php://input');
		//$filename = md5(time().uniqid()).".jpg";
		$filename = $this->getFileName ($_REQUEST['filename'],$parentId);
		file_put_contents( $basepath . "uploads/".$filename,$str);
		$files = array("name" => $filename, "parent" => $parentId, "createdBy" => 0, "folder" => 0);
		$this->createFiles ($files);
		echo $filename;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$files = $_POST['Files'];		
		$this->createFiles ($files);
	}
	private function createFiles ($files)
	{
		$model=new Files;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($files))
		{
			$files['createdBy'] = ($files['createdBy'] == 0 ) ? Yii::app()->user->_id : 1; // set to logged in user id
			//print_r($_POST['Files'])	; die();
			$model->attributes=$files;
			if($model->save())
				echo json_encode(array("id" => $model->id));
			//$this->redirect(array('view','id'=>$model->id));
		}
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

		if(isset($_POST['Files']))
		{
			$model->attributes=$_POST['Files'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($parent)
	{
		$model=new Files;
		$data = $model->findAll();
		$output = array();
		foreach( $data as $objData ) {
			$output[] = $objData->getAttributes();
		}
		echo json_encode($output);
	}

	public function actionGetChild()
	{
		$id = $_GET['id'];
		//if(!empty($id)) {
			$model=new Files;
			//$model->addCondition("id=" . $id);
			$data = $model->findAll(array("condition"=>"parent=$id"));
			$output = array();
			foreach( $data as $objData ) {
				$output[] = $objData->getAttributes();
			}
			echo json_encode($output);
		//}
		//else 
		//{
		//	json_encode(array("error"=>1));
		//}
		//$this->render('index',array('message'=>$output));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Files('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Files']))
			$model->attributes=$_GET['Files'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Files the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Files::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Files $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='files-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
