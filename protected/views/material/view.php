<?php
$this->breadcrumbs=array(
	'Materials'=>array('index'),
	$model->material_id,
);

$this->menu=array(
	array('label'=>'List Materials','url'=>array('index')),
	array('label'=>'Create Material','url'=>array('create')),
	array('label'=>'Update Material','url'=>array('update','id'=>$model->material_id)),
	array('label'=>'Delete Material','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->material_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Material #<?php echo $model->material_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'material_id',
		'description',
		'cat.description',
	),
)); ?>
