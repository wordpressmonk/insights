<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/material-design-iconic-font.min.css" />	
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="<?=\Yii::$app->homeUrl;?>css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->

</head>
<body class="menubar-hoverable header-fixed menubar-pin">
<?php $this->beginBody() ?>
<header id="header" >
<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand">
							<div class="brand-holder">
								<a href="../../html/dashboards/dashboard.html">
									<span class="text-lg text-bold text-primary">TeeSpring</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-options">
						<li>
							<!-- Search form -->
							<form class="navbar-search" role="search">
								<div class="form-group">
									<input type="text" class="form-control" name="headerSearch" placeholder="Enter your keyword">
								</div>
								<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
							</form>
						</li>
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell"></i><sup class="badge style-danger">4</sup>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Todays messages</li>
								<li>
									<a class="alert alert-callout alert-warning" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="../../assets/img/avatar2.jpg?1404026449" alt="">
										<strong>Alex Anistor</strong><br>
										<small>Testing functionality...</small>
									</a>
								</li>
								<li>
									<a class="alert alert-callout alert-info" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="../../assets/img/avatar3.jpg?1404026799" alt="">
										<strong>Alicia Adell</strong><br>
										<small>Reviewing last changes...</small>
									</a>
								</li>
								<li class="dropdown-header">Options</li>
								<li><a href="../../html/pages/login.html">View all messages <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
								<li><a href="../../html/pages/login.html">Mark as read <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-area-chart"></i>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Server load</li>
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Today</strong></span>
											<strong class="pull-right">93%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 93%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Yesterday</strong></span>
											<strong class="pull-right">30%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-success" style="width: 30%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
								<li class="dropdown-progress">
									<a href="javascript:void(0);">
										<div class="dropdown-label">
											<span class="text-light">Server load <strong>Lastweek</strong></span>
											<strong class="pull-right">74%</strong>
										</div>
										<div class="progress"><div class="progress-bar progress-bar-warning" style="width: 74%"></div></div>
									</a>
								</li><!--end .dropdown-progress -->
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-options -->
					<ul class="header-nav header-nav-profile">
					<li><?php if(\Yii::$app->user->id){ 
	                        echo Html::beginForm(['/site/logout'], 'post');
	               			echo Html::submitButton(
	                   				'Logout',
	                   			['class' => 'btn btn-default signin']
	               			);
	               			echo Html::endForm();

               } else { ?>
                        <button class="btn btn-default signin" onclick="location.href='<?=\Yii::$app->homeUrl;?>site/login';">Sign In/Sign Up</button>			    
	        <?php }?></li>

					</ul><!--end .header-nav-profile -->

				</div><!--end #header-navbar-collapse -->
</div>
</header>
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div>
			<div id="content">
				<section>
					<div class="section-body">
						<div class="row">
							<?= $content ?>
						</div>
					</div>
				</section>
			</div>
<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">

				<div class="menubar-scroll-panel">

					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">

						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="#" class="active">
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Dashboard</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->

						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="#" >
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Other</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->



					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->   
			</div> <!-- END BASE --> 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
