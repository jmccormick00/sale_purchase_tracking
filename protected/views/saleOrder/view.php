<?php
$this->breadcrumbs=array(
	'Sale Orders'=>array('index'),
	$model->sale_id,
);

$this->menu=array(
	array('label'=>'List Sale Orders','url'=>array('index')),
	array('label'=>'Create Sale Order','url'=>array('create')),
	array('label'=>'Update Sale Order','url'=>array('update','id'=>$model->sale_id)),
	array('label'=>'Delete Sale Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->sale_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Sale Order #<?php echo $model->sale_id; ?></h1>

<?php 

$this->widget('editable.EditableDetailView',array(
	'data'=>$model,
        'url'=>Yii::app()->createUrl('saleOrder/updateview'),
	'attributes'=>array(
                array(
                    'name' => 'Sale Number',
                    'value' => $model->sale_id,
                ),
                array(
                    'name' => 'PO Number',
                    'value' => $model->po_number,
                ),
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
                    'name' => 'Customer',
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
                    'name' => 'Shipping Name',
                    'value' => $model->address->name,
                ),
                array(
                    'name' => 'Shipping Address',
                    'value' => $model->address->address1,
                ),
                array(
                    'name' => 'Shipping Address 2',
                    'value' => $model->address->address2,
                ),
                array(
                    'name' => 'Shipping City',
                    'value' => $model->address->city,
                ),
                array(
                    'name' => 'Shipping Province',
                    'value' => $model->address->province,
                ),
                array(
                    'name' => 'Shipping Postal Code',
                    'value' => $model->address->postal_code,
                ),
                array(
                    'name' => 'Shipping Country',
                    'value' => $model->address->country_code,
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
//		'sale_id',
//		'po_number',
//                array(
//                    'name' => 'maturity_date',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->maturity_date, "short", null),
//                ),
//                array(
//                    'name' => 'created',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->created, "short", null),
//                ),
//                array(
//                    'name' => 'updated',
//                    'value' => Yii::app()->dateFormatter->formatDateTime($model->updated, "short", null),
//                ),
//                array(
//                    'name' => 'Customer',
//                    'type' => 'raw',
//                    'value' => CHtml::link($model->comp->name,array('company/view', 'id'=>$model->comp_id)),
//                ),
//		'contact',
//		'contact_telephone',
//		'paymentTerm.description',
//                array(
//                    'name' => 'Sale State',
//                    'value' => $model->is_open ? "Open" : "Closed",
//                ),
//                array(
//                    'name' => 'Shipping Name',
//                    'value' => $model->address->name,
//                ),
//                array(
//                    'name' => 'Shipping Address',
//                    'value' => $model->address->address1,
//                ),
//                array(
//                    'name' => 'Shipping Address 2',
//                    'value' => $model->address->address2,
//                ),
//                array(
//                    'name' => 'Shipping City',
//                    'value' => $model->address->city,
//                ),
//                array(
//                    'name' => 'Shipping Province',
//                    'value' => $model->address->province,
//                ),
//                array(
//                    'name' => 'Shipping Postal Code',
//                    'value' => $model->address->postal_code,
//                ),
//                array(
//                    'name' => 'Shipping Country',
//                    'value' => $model->address->country_code,
//                ),
//                'comments',
//	),
//    )); 
    ?>

<?php $this->widget('application.components.TableList', array(
    'tableTitle' => 'Sale Item List',
    'buttonLabel' => 'Add Item',
    'dataProvider' => $saleItemDataProvider,
    'columns' => array(
           'material.cat.description',
           'material.description',
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'date',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('saleItem/update'),
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
                    'url' => Yii::app()->createUrl('saleItem/update'),
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
                    'url' => Yii::app()->createUrl('saleItem/update'),
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
                    'url' => Yii::app()->createUrl('saleItem/update'),
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
                    'url' => Yii::app()->createUrl('saleItem/update'),
                    'type' => 'text',
                    // Make sure the grid gets updated
                    'success'=> 'js: function(response, newValue) {    
                        $.fn.yiiGridView.update("grid-view");  
                    }'
                ),
            ),
            array(
                'class'=>'editable.EditableColumn',
                'name'=>'qty_shipped',
                //'headerHtmlOptions' => array('style' => 'width:80px'),
                'editable' => array(
                    'url' => Yii::app()->createUrl('saleItem/update'),
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
                        'url'=>'Yii::app()->createUrl("/saleItem/delete",array("material_id"=>$data->material_id, "sale_id"=>$data->sale_id))',
                    ),
                ),
            ),
	),
    'modalTitle' => 'Sale Item',
    'ajaxCreateURL' => array('/saleItem/create', 'id'=>$model->sale_id),
 )); ?>

<?php $eek=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action'=>Yii::app()->createUrl('/saleOrder/excel', array("id"=>$model->sale_id)),
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