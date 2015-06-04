<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Purchase Order','url'=>array('index')),
);
?>

<h1>Create Purchase Order</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>