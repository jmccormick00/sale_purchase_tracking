<?php
/* @var $this SiteController */


 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Open Purchase Orders',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    ));?>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
                //'id'=>'action-grid',
                'fixedHeader' => true,
                'type'=>'striped bordered condensed',
                //'template' => "{items}",
                'responsiveTable' => true,
                'dataProvider'=>$poDataProvider,
                //'filter'=>$model,
                'columns'=>array(
                    'po_number',           
                    'comp.name',
                    'maturity_date',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}',
                        'viewButtonUrl'=>'Yii::app()->createUrl("purchaseOrder/view",array("id"=>$data->po_number))'
                    ),
                ),
)); ?>
<?php $this->endWidget();?>

<br>

<?php
 $box1 = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Open Sale Orders',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    ));?>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
                //'id'=>'action-grid',
                'fixedHeader' => true,
                'type'=>'striped bordered condensed',
                //'template' => "{items}",
                'responsiveTable' => true,
                'dataProvider'=>$saleDataProvider,
                //'filter'=>$model,
                'columns'=>array(
                    'sale_id',
                    'po_number',           
                    'comp.name',
                    'maturity_date',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}',
                        'viewButtonUrl'=>'Yii::app()->createUrl("saleOrder/view",array("id"=>$data->sale_id))'
                    ),
                ),
)); ?>
<?php $this->endWidget();?>