<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Company','url'=>array('index')),
);
?>

<h1>Create a Company</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>