<?php
/* @var $this FilesController */
/* @var $model Files */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'files-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdBy'); ?>
		<?php echo $form->textField($model,'createdBy',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'createdBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model,'parent',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'folder'); ?>
		<?php echo $form->textField($model,'folder'); ?>
		<?php echo $form->error($model,'folder'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->