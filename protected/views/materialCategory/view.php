<?php
$this->breadcrumbs=array(
	'Material Categories'=>array('index'),
	$model->cat_id,
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Create Category','url'=>array('create')),
	array('label'=>'Update Category','url'=>array('update','id'=>$model->cat_id)),
	array('label'=>'Delete Category','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->cat_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Category #<?php echo $model->cat_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'cat_id',
		'description',
	),
)); ?>
