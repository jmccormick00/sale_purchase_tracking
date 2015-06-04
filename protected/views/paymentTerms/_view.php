<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('term_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->term_id),array('view','id'=>$data->term_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>