<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
    array('label'=>'List User','url'=>array('index')),
    array('label'=>'Create User','url'=>array('create')),
    array('label'=>'View User','url'=>array('view','id'=>$model->user_id)),
);
?>

<h1>Update User - <?php echo $model->username; ?></h1>
<p>Only modify the password fields if you want to change them.</p>
        
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>