<div id="sighnUp">
<?php
$form=$this->beginWidget('CActiveForm', array(
		'id'=>'register',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
)); 
?>
	<h1>Register</h1>                
	<div id="sign_up_form">
		<label><strong>User name <!-- or Email id -->:</strong> 	
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</label>
		<label><strong>Email id :</strong> 	
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</label>
		<label><strong>Password <!-- or Email id -->:</strong> 	
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</label>    
	    
		<div id="actions">
			<a class="close form_button sprited" id="cancel" href="#">Cancel</a>
			<a class="form_button sprited" id="try_it" href="javascript:sighnUp();">Create</a>
		</div>
	</div>
	<a id="close_x" class="close sprited" href="#">close</a>
	<?php if(strstr($form->errorSummary($model),"dummy") == "") { ///echo htmlentities($form->errorSummary($model)) ?>
	
	<script>popLogin();</script>
	<?php }?>
	<?php $this->endWidget(); ?>
</div>