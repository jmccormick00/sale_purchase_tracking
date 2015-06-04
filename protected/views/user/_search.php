<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>45)); ?>

		<?php echo $form->textFieldRow($model,'pw_hash',array('class'=>'span5','maxlength'=>128)); ?>

		<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'role_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
