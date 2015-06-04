<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Company','url'=>array('index')),
	array('label'=>'Create Company','url'=>array('create')),
	array('label'=>'Update Company','url'=>array('update','id'=>$model->comp_id)),
	array('label'=>'Delete Company','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->comp_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
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

<h1>View Company: <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'comp_id',
		'name',
		'website',
		//'updated',
                array(
                    'name' => 'updated',
                    'value' => Yii::app()->dateFormatter->formatDateTime($model->updated, "short", null),
                ),
		'compType.description',
		'telephone',
                'description',
	),
)); ?>


<?php $this->widget('application.components.TableList', array(
    'tableTitle' => 'Company Address List',
    'buttonLabel' => 'Add Address',
    'dataProvider' => $addressDataProvider,
    'columns' => array(     
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'name',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'address1',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'address2',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'city',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
           array(
                'class'=>'editable.EditableColumn',
                'name'=>'province',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'postal_code',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'country_code',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('address/update'),
                    'type' => 'select',
                    'source' => Country::model()->getCountries(),
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'name' => 'updated',
                'value' => 'Yii::app()->dateFormatter->formatDateTime($data->updated, "short", null)',
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                'template'=>'{delete}',
                'buttons'=>array(
                  'delete'=>array(
                        'url'=>'Yii::app()->createUrl("/address/delete",array("address_id"=>$data->address_id, "comp_id"=>$data->comp_id))',
                    ),
                ),
            ),
	),
    'modalTitle' => 'Address',
    'ajaxCreateURL' => array('/address/create', 'id'=>$model->comp_id),
 )); ?>
