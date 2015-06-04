<?php
$this->breadcrumbs=array(
	'Sale Orders',
);

$this->menu=array(
	array('label'=>'Create Sale Order','url'=>array('create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$.fn.yiiGridView.update('sale-order-grid', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>

<h1>Manage Sale Orders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sale-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sale_id',
		'po_number',
//                array(
//                    'name' => 'maturity_date',
//                    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->maturity_date, "short", null)',
//                ),
//                array(
//                    'name' => 'created',
//                    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->created, "short", null)',
//                ),
//                array(
//                    'name' => 'updated',
//                    'value' => 'Yii::app()->dateFormatter->formatDateTime($data->updated, "short", null)',
//                ),
                array(
                    'header' => 'Consumer',
                    'name' => "comp_name",
                    'value' => '$data->comp->name',
                ),
                array(
                    'name'=>'payment_term_id',
                    'value'=>'$data->paymentTerm->description',
                    'filter'=>  PaymentTerms::model()->getPaymentTerms(),
                    'htmlOptions'=>array('width'=>'110px'),
                ),
                array(
                    'name'=>'is_open',
                    'value'=>'$data->is_open ? "Open" : "Closed"',
                    'filter'=>array(1 => 'Open', 0 => 'Closed'),
                    'htmlOptions'=>array('width'=>'100px'),
                ),
		//'address_id',
		//'contact',
		//'contact_telephone',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
