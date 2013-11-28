<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--
 -
 -   Copyright © 2010-2012 by xhost.ch GmbH
 -
 -   All rights reserved.
 -
 -->
<head>
    <meta content="initial-scale=1.0, width=device-width, user-scalable=yes" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rev="made" href="mailto:multicraft@xhost.ch">
    <meta name="description" content="Multicraft: The Minecraft server control panel">
    <meta name="keywords" content="Multicraft, Minecraft, server, management, control panel, hosting">
    <meta name="author" content="xhost.ch GmbH">

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Theme::css('screen.css') ?>" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Theme::css('print.css') ?>" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Theme::css('ie.css') ?>" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Theme::css('main.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Theme::css('form.css') ?>" />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,300|Oswald:300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://spartanhost.net/css/style.css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="pagetrimmer">
    <div class="container">
        <nav class="main"> 
            <a class="navbar-brand col-md-2" href="http://spartanhost.net">SpartanHost</a>
            <div class="col-md-7">  
                <ul class="nav navbar-nav navbar-right white bar">
                    <li><a href="http://spartanhost.net">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Plans <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://billing.spartanhost.net/cart.php?gid=3">Budget Minecraft Plans</a></li>
                            <li><a href="https://billing.spartanhost.net/cart.php?gid=1">Premium Minecraft Plans</a></li>
                            <li><a href="https://billing.spartanhost.net/cart.php?gid=8">Dedicated Server Plans</a></li>
                            <li><a href="https://billing.spartanhost.net/cart.php?gid=7">DDoS Protection Plans</a></li>
                            <li><a href="https://billing.spartanhost.net/cart.php?gid=2">Web Hosting Plans</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="http://spartanhost.net/faq">FAQ</a></li>
                            <li><a href="https://billing.spartanhost.net/">Client Area</a></li>
                            <li><a href="https://billing.spartanhost.net/contact.php">Contact Us</a></li>
                            <li><a href="http://spartanhost.net/irc">IRC Chat</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="nav navbar-nav red bar">
                    <li><a href="http://cp.spartanhost.net/">Multicraft</a></li>
                    <li><a href="https://billing.spartanhost.net/">Client Area</a></li>
                </ul>
            </div>
        </nav>
        <div class="clearfix"></div>
    </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-sub">
        <?php
        $items = array();

        $simple = (Yii::app()->theme && in_array(Yii::app()->theme->name, array('simple', 'mobile', 'platform')));
        if (!$simple)
            $items[] = array('label'=>Yii::t('mc', 'Home'), 'url'=>array('/site/page', 'view'=>'home'));
        if (@Yii::app()->params['installer'] !== 'show')
        {
            $items[] = array(
                'label'=>Yii::t('mc', 'Servers'),
                'url'=>array('/server/index', 'my'=>($simple && !Yii::app()->user->isSuperuser() ? 1 : 0)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', 'Users'),
                'url'=>array('/user/index'),
                'visible'=>(Yii::app()->user->isSuperuser()
                    || !(Yii::app()->user->isGuest || (Yii::app()->params['hide_userlist'] === true) || $simple)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', 'Profile'),
                'url'=>array('/user/view', 'id'=>Yii::app()->user->id),
                'visible'=>(!Yii::app()->user->isSuperuser() && !Yii::app()->user->isGuest
                    && ((Yii::app()->params['hide_userlist'] === true) || $simple)),
            );
            $items[] = array(
                'label'=>Yii::t('mc', 'Settings'),
                'url'=>array('/daemon/index'),
                'visible'=>Yii::app()->user->isSuperuser(),
            );
            $items[] = array(
                'label'=>Yii::t('mc', 'Support'),
                'url'=>array('/site/report'),
                'visible'=>!empty(Yii::app()->params['admin_email']),
            );
        }
        if (Yii::app()->user->isGuest)
        {
            $items[] = array(
                'label'=>Yii::t('mc', 'Login'),
                'url'=>array('/site/login'),
                'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
            );
        }
        else
        {
            $items[] = array(
                'label'=>Yii::t('mc', 'Logout ({name})', array('{name}'=>Yii::app()->user->name)),
                'url'=>array('/site/logout'),
                'itemOptions'=>$simple ? array('style'=>'float: right') : array(),
            );
        }
        $items[] = array(
            'label'=>Yii::t('mc', 'About'),
            'url'=>array('/site/page', 'view'=>'about'),
            'visible'=>$simple,
            'itemOptions'=>array('style'=>'float: right'),
        );
        
        
        $this->widget('zii.widgets.CMenu', array(
            'items'=>$items,
            'htmlOptions' => array('class' => 'nav navbar-nav')
        )); ?>
    </div><!-- mainmenu -->

    <div class="container">
        <div class="pagecontent">
        
            <?php
                if (!$simple)
                {
                    array_pop($this->breadcrumbs);
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'homeLink'=>'',
                        'links'=>$this->breadcrumbs,
                        'tagName' => 'ol',
                        'htmlOptions' => array('class' => 'breadcrumb'),
                        'separator' => '',
                        'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                        'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                    ));
                }
            ?>

            <?php echo $content; ?>
        </div>
    </div> 
    <footer class="container">
        <div class="col-md-6">
            <a href="http://spartanhost.net/terms">Terms of Service</a> | <a href="http://spartanhost.net/careers">Careers</a>
        </div>
        <div class="col-md-6 text-right">
            Copyright 2013 SpartanHost. <a href="http://vector-media.net/">Designed</a>. Powered by <a href="http://www.multicraft.org">Multicraft Control Panel</a>
        </div>
    </footer>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min.js" type="text/javascript"></script>
</div><!-- page -->
</div>
</body>
<!--  C o p y r i g h t   (c)   2 0 1 0 - 2 0 1 2   b y   x h o s t . c h   G m b H .   A l l   r i g h t s   r e s e r v e d .  -->
</html>
