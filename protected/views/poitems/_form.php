<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'poitems-form',
	//'enableAjaxValidation'=>true,
        'enableClientValidation'=> true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->hiddenField($model, 'po_number'); ?>
        
	<?php echo $form->dropDownListRow($model, 'material_cat', MaterialCategory::model()->getCategories(), 
                array(
                    'prompt'=>'Select Category',
                    'ajax' => array(
                        'type'=>'POST', //request type
                        'url'=>CController::createUrl('material/dynamicmaterial'),
                        'update'=>'#PoItems_material_id', //selector to update
                        'data'=>array('material_cat'=>'js:this.value'),
                        ))); 
        ?>
        
        <?php 
            echo $form->dropDownListRow($model,'material_id', array(), array('prompt'=>'Select Category'));
        ?>
        
        <?php echo $form->textFieldRow($model,'qty',array('class'=>'span5','maxlength'=>12)); ?>
        
        <?php echo $form->textFieldRow($model,'qty_units',array('class'=>'span5','maxlength'=>15)); ?>
        
        <?php echo $form->textFieldRow($model,'unit_price',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'price_units',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'qty_recieved',array('class'=>'span5', 'maxlength'=>12)); ?>

	<div class="form-actions">
        <?php 
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Create' : 'Save',
            )); 
        ?>

	</div>

<?php $this->endWidget(); ?>
</div>