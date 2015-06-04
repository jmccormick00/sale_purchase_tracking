<?php
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$model->po_number,
);

$this->menu=array(
	array('label'=>'List POs','url'=>array('index')),
	array('label'=>'Create PO','url'=>array('create')),
	array('label'=>'Update PO','url'=>array('update','id'=>$model->po_number)),
	array('label'=>'Delete PO','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->po_number),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Purchase Order #<?php echo $model->po_number; ?></h1>

<?php 

    $this->widget('editable.EditableDetailView',array(
	'data'=>$model,
        'url'=>Yii::app()->createUrl('purchaseOrder/updateview'),
	'attributes'=>array(
		'po_number',
		array(
                    'name' => 'Maturity Date',
                    'value' => Yii::app()->dateFormatter->formatDateTime($model->maturity_date, "short", null),
                ),
		array(
                    'name' => 'Created',
                    'value' => Yii::app()->dateFormatter->formatDateTime($model->created, "short", null),
                ),
                array(
                    'name' => 'Updated',
                    'value' => Yii::app()->dateFormatter->formatDateTime($model->updated, "short", null),
                ),
                array(
                    'name' => 'Supplier',
                    'type' => 'raw',
                    'value' => CHtml::link($model->comp->name,array('company/view', 'id'=>$model->comp_id)),
                ),
                array(
                    'name' => 'Contact',
                    'value' => $model->contact,
                ),
                array(
                    'name' => 'Contact Telephone',
                    'value' => $model->contact_telephone,
                ),
		array(
                    'name' => 'Payment Term',
                    'value' => $model->paymentTerm->description,
                ),
		array(
                    'name' => 'is_open',
                    'value' => $model->is_open ? "Open" : "Closed",
                    'editable'=>array(
                        'type'   => 'select',
                        'source'=>array(1 => 'Open', 0 => 'Closed'),
                    )
                ),
                array(
                    'name' => 'Comments',
                    'value' => $model->comments,
                ),
	),
    )); 


//    $this->widget('bootstrap.widgets.TbDetailView',array(
//	'data'=>$model,
//	'attributes'=>array(
//		'po_number',
//		array(
//                    'name' => 'maturity_date',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->maturity_date, "short", null),
//                ),
//		array(
//                    'name' => 'created',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->created, "short", null),
//                ),
//                array(
//                    'name' => 'updated',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->updated, "short", null),
//                ),
//                array(
//                    'name' => 'Supplier',
//                    'type' => 'raw',
//                    'value' => CHtml::link($model->comp->name,array('company/view', 'id'=>$model->comp_id)),
//                ),
//                'contact',
//		'contact_telephone',
//		'paymentTerm.description',
//		array(
//                    'name' => 'Sale State',
//                    'value' => $model->is_open ? "Open" : "Closed",
//                ),
//                'comments',
//	),
//    )); 
    ?>

<?php $this->widget('application.components.TableList', array(
    'tableTitle' => 'PO Item List',
    'buttonLabel' => 'Add Item',
    'dataProvider' => $poItemDataProvider,
    'columns' => array(    
           'material.cat.description',
           'material.description',
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'date',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'date',
                    'viewformat' => 'mm.dd.yyyy',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'qty',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'qty_units',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'unit_price',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'price_units',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'qty_recieved',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('poItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
           'qty_diff',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{delete}',
                'buttons'=>array(
                  'delete'=>array(
                        'url'=>'Yii::app()->createUrl("/poItem/delete",array("material_id"=>$data->material_id, "po_number"=>$data->po_number))',
                    ),
                ),
            ),
	),
    'modalTitle' => 'PO Item',
    'ajaxCreateURL' => array('/poItem/create', 'id'=>$model->po_number),
 )); ?>

<?php $eek=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action'=>Yii::app()->createUrl('/purchaseOrder/excel', array("id"=>$model->po_number)),
        'method'=>'get',
)); ?>
        <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Export',
        )); ?>
        </div>
<?php $this->endWidget(); ?>

