<?php
$this->breadcrumbs=array(
	'Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Materials','url'=>array('index')),
);
?>

<h1>Create Material</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>