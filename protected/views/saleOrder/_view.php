<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sale_id),array('view','id'=>$data->sale_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_number')); ?>:</b>
	<?php echo CHtml::encode($data->po_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maturity_date')); ?>:</b>
	<?php echo CHtml::encode($data->maturity_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comp_id')); ?>:</b>
	<?php echo CHtml::encode($data->comp_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_term_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_term_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_open')); ?>:</b>
	<?php echo CHtml::encode($data->is_open); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address_id')); ?>:</b>
	<?php echo CHtml::encode($data->address_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact')); ?>:</b>
	<?php echo CHtml::encode($data->contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_telephone')); ?>:</b>
	<?php echo CHtml::encode($data->contact_telephone); ?>
	<br />

	*/ ?>

</div>