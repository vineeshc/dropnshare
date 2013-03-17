<?php 
foreach($message as $key => $val)
{
	echo "<div class='folderContainer'>";
	if($val['folder'] == 0)
		echo "<div class='folderContainer'><a href='javascript:openFolder(" . $val['id'] . ");'><img src='" . Yii::app()->request->baseUrl ."/uploads/" . $val['name'] .  "'><br/>" . $val['name'] . "</a></div>";
	else
		echo "<a href='javascript:openFolder(" . $val['id'] . ");'><img src='" . Yii::app()->request->baseUrl . "/js/src/images/images.jpg'><br/>" . $val['name'] . "</a>";
	echo "</div>";
}
?>