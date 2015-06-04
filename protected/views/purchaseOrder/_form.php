<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'purchase-order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->datepickerRow($model,'maturity_date',array('options'=>array('format'=>'yyyy/mm/dd','language'=>'en',),)); ?>

	<?php echo $form->dropDownListRow($model,'payment_term_id', PaymentTerms::model()->getPaymentTerms(), array('prompt'=>'Select Term')); ?>
        
        <?php echo $form->dropDownListRow($model,'comp_id', Company::model()->getPurchaseOrderComp(), array('prompt'=>'Select Company')); ?>

	<?php echo $form->dropDownListRow($model,'is_open',  array(1 => 'Open', 0 => 'Closed')); ?>

	<?php echo $form->textFieldRow($model,'contact',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'contact_telephone',array('class'=>'span5','maxlength'=>15)); ?>
        
        <?php echo $form->textAreaRow($model,'comments',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
