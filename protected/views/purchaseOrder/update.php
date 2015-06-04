<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->po_number=>array('view','id'=>$model->po_number),
	'Update',
);

$this->menu=array(
	array('label'=>'List POs','url'=>array('index')),
	array('label'=>'Create PO','url'=>array('create')),
	array('label'=>'View PO','url'=>array('view','id'=>$model->po_number)),
);
?>

<h1>Update Purchase Order <?php echo $model->po_number; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>