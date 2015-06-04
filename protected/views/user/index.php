<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
array('label'=>'Create User','url'=>array('create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//$('.search-form').toggle();
//return false;
//});
//$('.search-form form').submit(function(){
//$.fn.yiiGridView.update('user-grid', {
//data: $(this).serialize()
//});
//return false;
//});
//");
?>

<h1>Manage Users</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'user_id',
		'username',
		'first_name',
		'last_name',
		array(
//                    'header'=>'Role',
//                    'value'=>'$data->role->description',
                    'name'=>'role_id',
                    'value'=>'$data->role->description',
                    'filter'=>Roles::model()->getRoles(),
                    'htmlOptions'=>array('width'=>'100px'),
                ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
