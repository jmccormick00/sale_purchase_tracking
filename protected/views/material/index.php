<?php
$this->breadcrumbs=array(
	'Materials',
);

$this->menu=array(
	array('label'=>'Create Material','url'=>array('create')),
);


?>

<h1>Manage Materials</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div id="statusMsg">
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-block alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-block alert-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'material-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//                array(
//                    'name'=>'material_id',
//                    'htmlOptions'=>array('width'=>'100px'),
//                ),
		'description',
                array(
                    'name'=>'cat_id',
                    'value'=>'$data->cat->description',
                    'filter'=>  MaterialCategory::model()->getCategories(),
                    'htmlOptions'=>array('width'=>'150px'),
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }'
		),
	),
)); ?>
