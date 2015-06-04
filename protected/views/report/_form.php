<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model, 'material_cat', MaterialCategory::model()->getCategories(), 
                array(
                    'prompt'=>'Select Category',
                    'ajax' => array(
                        'type'=>'POST', //request type
                        'url'=>CController::createUrl('material/dynamicmaterial'),
                        'update'=>'#ReportForm_material_id', //selector to update
                        'data'=>array('material_cat'=>'js:this.value'),
                        ))); 
        ?>
        
        <?php 
            echo $form->dropDownListRow($model,'material_id', array(), array('prompt'=>'Select Category'));
        ?>

	<?php echo $form->datepickerRow($model,'startDate',array('options'=>array('format'=>'yyyy/mm/dd','language'=>'en',),)); ?>

        <?php echo $form->datepickerRow($model,'endDate',array('options'=>array('format'=>'yyyy/mm/dd','language'=>'en',),)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
