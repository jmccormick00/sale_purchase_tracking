<?php
$this->breadcrumbs=array(
	'Payment Terms'=>array('index'),
	$model->term_id,
);

$this->menu=array(
	array('label'=>'List Payment Terms','url'=>array('index')),
	array('label'=>'Create Payment Terms','url'=>array('create')),
	array('label'=>'Update Payment Terms','url'=>array('update','id'=>$model->term_id)),
	array('label'=>'Delete Payment Terms','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->term_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Payment Terms #<?php echo $model->term_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'term_id',
		'description',
	),
)); ?>
