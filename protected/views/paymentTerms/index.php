<?php
$this->breadcrumbs=array(
	'Payment Terms',
);

$this->menu=array(
	array('label'=>'Create Payment Terms','url'=>array('create')),
);


?>

<h1>Manage Payment Terms</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div id="statusMsg">
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-block alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-block alert-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'payment-terms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'term_id',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
