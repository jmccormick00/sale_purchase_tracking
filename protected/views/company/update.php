<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name=>array('view','id'=>$model->comp_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Companies','url'=>array('index')),
	array('label'=>'Create Company','url'=>array('create')),
	array('label'=>'View Company','url'=>array('view','id'=>$model->comp_id)),
);
?>

<h1>Update Company: <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>