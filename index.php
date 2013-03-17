<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
function display( $data ) {
	if( true == isset( $data ) ) {
		echo '<pre>';
		if( true == is_array($data) && 0 < count( $data )) {
			foreach( $data as $objData ) {
				print_r($objData->getAttributes());
			}
		} else if(true == is_object( $data ) ){
			print_r($data->getAttributes());
		}
		echo '<pre>';
	}
}