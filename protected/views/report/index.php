<?php
$this->breadcrumbs=array(
	'Report',

);

$this->menu=array(
	//array('label'=>'Create PO','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('report-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Sales Report</h1>

<div class="search-form">
<?php $this->renderPartial('_form',array('model'=>$model)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'report-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                array(
                    'name'=>'Company Name',
                    'type'=>'raw',
                    'value'=>'$data["compName"]',
                    'footer'=>"Total:",
                ),
                array(
                    'name'=>'Totals',
                    'type'=>'raw',
                    'value'=>'$data["shippedSum"]',
                    'class'=>'bootstrap.widgets.TbTotalSumColumn'
                ),
	),
)); ?>

<?php $eek=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action'=>Yii::app()->createUrl('/report/excel'),
        'method'=>'get',
)); ?>
        <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Export',
        )); ?>
        </div>
<?php $this->endWidget(); ?>