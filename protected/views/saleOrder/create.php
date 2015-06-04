<?php
$this->breadcrumbs=array(
	'Sale Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SaleOrder','url'=>array('index')),
);
?>

<h1>Create Sale Order</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>