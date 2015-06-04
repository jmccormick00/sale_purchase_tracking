<?php
$this->breadcrumbs=array(
	'Payment Terms'=>array('index'),
	$model->term_id=>array('view','id'=>$model->term_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Payment Terms','url'=>array('index')),
	array('label'=>'Create Payment Terms','url'=>array('create')),
	array('label'=>'View Payment Terms','url'=>array('view','id'=>$model->term_id)),
);
?>

<h1>Update Payment Terms <?php echo $model->term_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>