<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
                    'type' => null, // null or 'inverse'
                    'brand' => 'All American',
                    'collapse' => true, // requires bootstrap-responsive.css
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'items' => array(
                                    array('label' => 'Purchase Orders', 'url' => array('/purchaseOrder/index'), 'visible' => !Yii::app()->user->isGuest),
                                    array('label' => 'Sale Orders', 'url' => array('/saleOrder/index'), 'visible' => !Yii::app()->user->isGuest),
                                    array('label' => 'Companies', 'url' => array('/company/index'), 'visible' => !Yii::app()->user->isGuest),
                                    array('label' => 'Reports', 'url' => array('/report/index'), 'visible' => !Yii::app()->user->isGuest),
                                    array('label' => 'Payment Terms', 'url'=>array('/paymentTerms/index'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                                    array('label' => 'Materials', 'url'=>array('/material/index'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                                    array('label' => 'Material Categories', 'url'=>array('/materialCategory/index'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                                    array('label' => 'Users', 'url'=>array('/user/index'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                            ),
                        ),
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                    //array('label' => 'Profile', 'url' => array('/user/profile'), 'visible' => !Yii::app()->user->isGuest),
                                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                            ),
                        ),
                     )));   
                ?>
	<!-- mainmenu -->
	<div class="container" style="margin-top:80px">
        <?php if(!Yii::app()->user->isGuest): ?> 
            <?php if (isset($this->breadcrumbs)): ?>
                <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
            <?php endif?>
        <?php endif?>

	<?php echo $content; ?>

	<hr/>

	<div id="footer">
		All American Metals and Recycling<br/>
		Sales/Purchase Order System<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
