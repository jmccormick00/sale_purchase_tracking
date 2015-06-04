<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'address-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=> true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->hiddenField($model, 'comp_id'); ?>
        
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>150)); ?>
        
        <?php echo $form->textFieldRow($model,'address1',array('class'=>'span5','maxlength'=>50)); ?>
        
        <?php echo $form->textFieldRow($model,'address2',array('class'=>'span5','maxlength'=>50)); ?>
        
        <?php echo $form->textFieldRow($model,'city',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'province',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'postal_code',array('class'=>'span5')); ?>
        
        <?php echo $form->dropDownListRow($model, 'country_code', Country::model()->getCountries());  ?>

	<div class="form-actions">
        <?php 
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Create' : 'Save',
            )); 
//        $this->widget('bootstrap.widgets.TbButton', array(
//                'buttonType'=>'ajaxsubmit',
//                'type'=>'primary',
//                'label'=>$model->isNewRecord ? 'Create' : 'Save',
//                'url' => Yii::app()->createUrl('/address/create', array('id' => $model->comp_id)),
//                //'ajaxOptions'=> array('update'=>'#address'),
//            ));
//        echo CHtml::ajaxSubmitButton('Create',array('/address/create', 'id'=>$model->comp_id));
        ?>

	</div>

<?php $this->endWidget(); ?>
</div>