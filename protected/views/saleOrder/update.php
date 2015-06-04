<?php
$this->breadcrumbs=array(
	'Sale Orders'=>array('index'),
	$model->sale_id=>array('view','id'=>$model->sale_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sale Order','url'=>array('index')),
	array('label'=>'Create Sale Order','url'=>array('create')),
	array('label'=>'View Sale Order','url'=>array('view','id'=>$model->sale_id)),
);
?>

<h1>Update Sale Order <?php echo $model->sale_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>