<?php
/**
 * Main website frontend login.php
 *
 * 
 */
$this->pageTitle = 'Login';

?>
<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'login-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
                'htmlOptions'=>array('class'=>'well'),
)); ?>
	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3'));?>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3'));  ?>
                <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login')); ?>

<?php $this->endWidget(); ?>