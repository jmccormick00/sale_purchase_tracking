<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => $this->tableTitle, #tableTitle
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    'headerButtons'=> array (
      array(
          'class'=> 'bootstrap.widgets.TbButton',
          'type'=>'primary',
          'label' => $this->buttonLabel, #buttonLabel
          'htmlOptions'=>array(
          'data-target'=>'#ModalDialog',
           'url'=>'#',
           'onclick'=>"{dialogJavaScript(); $('#ModalDialog').modal();}"     
            ),  
          ),
    ),
    ));?>
<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'grid-view',
        //'fixedHeader' => true,
        'type'=>'striped bordered condensed',
	'dataProvider'=>$this->dataProvider,  #dataProvider
         // 'template' => "{items}",  
	//'filter'=>$model,
	'columns'=>$this->columns,
)); ?>
<?php $this->endWidget();?>

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array( 'id'=>'ModalDialog'));?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">x</a>
    <h3><?php echo $this->modalTitle ?></h3>
</div>

<div class="modal-body">
</div>


<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function dialogJavaScript()
{
    <?php echo CHtml::ajax(array(
            'url'=> $this->ajaxCreateURL,   #ajaxCreateURL
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 0)
                {
                    $('#ModalDialog div.modal-body').html(data.div);
                    // Here is the trick: on submit-> once again this function!
                    $('#ModalDialog div.modal-body form').submit(dialogJavaScript);
                }
                else
                {
                    setTimeout(\"$('#ModalDialog').modal('hide') \", 500);
                    // Refresh the grid with the update
                    //$.fn.yiiGridView.update('grid-view');
                    $('#grid-view').yiiGridView('update');
                }
 
            }",
            )); ?>;
    return false; 
 
}

</script>