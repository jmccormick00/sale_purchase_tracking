<?php
$this->breadcrumbs=array(
	'Materials'=>array('index'),
	$model->material_id=>array('view','id'=>$model->material_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Material','url'=>array('index')),
	array('label'=>'Create Material','url'=>array('create')),
	array('label'=>'View Material','url'=>array('view','id'=>$model->material_id)),
);
?>

<h1>Update Material <?php echo $model->material_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>