<div id="login">
<?php
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
)); 
?>
	<h1>Login</h1>                
	<div id="sign_up_form">
		<label><strong>User name <!-- or Email id -->:</strong> 	
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</label>
		<label><strong>Password <!-- or Email id -->:</strong> 	
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</label>    
	    <?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
		<div id="actions">
			<a class="close form_button sprited" id="cancel" href="#">Cancel</a>
			<a class="form_button sprited" id="log_in" href="javascript:login();">Create</a>
		</div>
	</div>
	<a id="close_x" class="close sprited" href="#">close</a>
	<?php if(strstr($form->errorSummary($model),"dummy") == "") { ///echo htmlentities($form->errorSummary($model)) ?>
	
	<script>popLogin();</script>
	<?php }?>
	<?php $this->endWidget(); ?>
</div>

<div class = "arrow"><h1>4 easy steps to start.</h1></div>
<div class="row-arrow">
	<div class = "arrow"><img src="/dropnshare/images/arrow.png" /></div>
	<div class = "arrow"><h2>Create your Account. If you already have it, Just login.</h2></div>
</div>
<div class="row-arrow">
	<div class = "arrow"><img src="/dropnshare/images/arrow.png" /></div>
	<div class = "arrow"><h2>Manage your folders.(Click mouse right button and select new folder option)</h2></div>
</div>
<div class="row-arrow">
	<div class = "arrow"><img src="/dropnshare/images/arrow.png" /></div>
	<div class = "arrow"><h2>Drag files from your desktop and drop inside the folder.</h2></div>
</div>
<div class="row-arrow">
	<div class = "arrow"><img src="/dropnshare/images/arrow.png" /></div>
	<div class = "arrow"><h2>Share it with DropNShare or with your FaceBook user.</h2></div>
</div>