<?php
$this->breadcrumbs=array(
	'Material Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Material Categories','url'=>array('index')),
);
?>

<h1>Create Material Category</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>