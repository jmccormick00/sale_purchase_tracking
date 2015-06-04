<?php
$this->breadcrumbs=array(
	'Material Categories'=>array('index'),
	$model->cat_id=>array('view','id'=>$model->cat_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categories','url'=>array('index')),
	array('label'=>'Create Category','url'=>array('create')),
	array('label'=>'View Category','url'=>array('view','id'=>$model->cat_id)),
);
?>

<h1>Update Category: <?php echo $model->cat_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>