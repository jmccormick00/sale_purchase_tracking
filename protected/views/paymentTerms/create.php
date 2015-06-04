<?php
$this->breadcrumbs=array(
	'Payment Terms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Payment Terms','url'=>array('index')),
);
?>

<h1>Create Payment Terms</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>