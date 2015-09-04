<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>

	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		
		echo $this->fetch('css');
		echo $this->Html->css(
			array(
				'assets/css/bootstrap',
				'assets/font-awesome/css/font-awesome',
				'assets/css/zabuto_calendar',
				'assets/js/gritter/css/jquery.gritter',
				'assets/lineicons/style',
				'assets/css/style',
				'assets/css/style-responsive',
				'bars-1to10',
				'bars-pill',
				'mystyle'
			)
		);
		
		echo $this->fetch('script');
		echo $this->Html->script(
			array(
				'assets/js/jquery',
				//'assets/js/jquery-1.8.3.min',
				'bars',
				'jquery.barrating',
				'assets/js/chart-master/Chart'
			)
		);
	?>
</head>
<body>
	<section id="container">
		<!-- **********************************************************************************************************************************************************
		TOP BAR CONTENT & NOTIFICATIONS
		*********************************************************************************************************************************************************** -->
      	<!--header start-->
      	<header class="header black-bg">
			<div class="sidebar-toggle-box">
			  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
			</div>
	            <!--logo start-->
	            <a href="index.html" class="logo"><b>FDC-Project Viewer</b></a>
	            <!--logo end-->
	            <div class="nav notify-row" id="top_menu">
	                <!--  notification start -->
	                <ul class="nav top-menu">
	                    <!-- settings start -->
	                    <li class="dropdown">
	                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
	                            <i class="fa fa-tasks"></i>
	                            <span class="badge bg-theme">4</span>
	                        </a>
	                        <ul class="dropdown-menu extended tasks-bar">
	                            <div class="notify-arrow notify-arrow-green"></div>
	                            <li>
	                                <p class="green">You have 4 pending tasks</p>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <div class="task-info">
	                                        <div class="desc">DashGum Admin Panel</div>
	                                        <div class="percent">40%</div>
	                                    </div>
	                                    <div class="progress progress-striped">
	                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	                                            <span class="sr-only">40% Complete (success)</span>
	                                        </div>
	                                    </div>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <div class="task-info">
	                                        <div class="desc">Database Update</div>
	                                        <div class="percent">60%</div>
	                                    </div>
	                                    <div class="progress progress-striped">
	                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
	                                            <span class="sr-only">60% Complete (warning)</span>
	                                        </div>
	                                    </div>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <div class="task-info">
	                                        <div class="desc">Product Development</div>
	                                        <div class="percent">80%</div>
	                                    </div>
	                                    <div class="progress progress-striped">
	                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
	                                            <span class="sr-only">80% Complete</span>
	                                        </div>
	                                    </div>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <div class="task-info">
	                                        <div class="desc">Payments Sent</div>
	                                        <div class="percent">70%</div>
	                                    </div>
	                                    <div class="progress progress-striped">
	                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	                                            <span class="sr-only">70% Complete (Important)</span>
	                                        </div>
	                                    </div>
	                                </a>
	                            </li>
	                            <li class="external">
	                                <a href="#">See All Tasks</a>
	                            </li>
	                        </ul>
	                    </li>
	                    <!-- settings end -->
	                    <!-- inbox dropdown start-->
	                    <li id="header_inbox_bar" class="dropdown">
	                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
	                            <i class="fa fa-envelope-o"></i>
	                            <span class="badge bg-theme">5</span>
	                        </a>
	                        <ul class="dropdown-menu extended inbox">
	                            <div class="notify-arrow notify-arrow-green"></div>
	                            <li>
	                                <p class="green">You have 5 new messages</p>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <span class="photo"><img alt="avatar" src="img/ui-zac.jpg"></span>
	                                    <span class="subject">
	                                    <span class="from">Zac Snider</span>
	                                    <span class="time">Just now</span>
	                                    </span>
	                                    <span class="message">
	                                        Hi mate, how is everything?
	                                    </span>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <span class="photo"><img alt="avatar" src="img/ui-divya.jpg"></span>
	                                    <span class="subject">
	                                    <span class="from">Divya Manian</span>
	                                    <span class="time">40 mins.</span>
	                                    </span>
	                                    <span class="message">
	                                     Hi, I need your help with this.
	                                    </span>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <span class="photo"><img alt="avatar" src="img/ui-danro.jpg"></span>
	                                    <span class="subject">
	                                    <span class="from">Dan Rogers</span>
	                                    <span class="time">2 hrs.</span>
	                                    </span>
	                                    <span class="message">
	                                        Love your new Dashboard.
	                                    </span>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">
	                                    <span class="photo"><img alt="avatar" src="img/ui-sherman.jpg"></span>
	                                    <span class="subject">
	                                    <span class="from">Dj Sherman</span>
	                                    <span class="time">4 hrs.</span>
	                                    </span>
	                                    <span class="message">
	                                        Please, answer asap.
	                                    </span>
	                                </a>
	                            </li>
	                            <li>
	                                <a href="index.html#">See all messages</a>
	                            </li>
	                        </ul>
	                    </li>
	                    <!-- inbox dropdown end -->
	                </ul>
	                <!--  notification end -->
	            </div>
	            <div class="top-menu">
	            	<ul class="nav pull-right top-menu">
	                    <li><a class="logout" href="login.html">Logout</a></li>
	            	</ul>
	            </div>
        </header>
      	<!--header end-->
		<!-- **********************************************************************************************************************************************************
		MAIN SIDEBAR MENU
		*********************************************************************************************************************************************************** -->
		<!--sidebar start-->
		<aside>
		    <div id="sidebar"  class="nav-collapse ">
		        <!-- sidebar menu start-->
		        <ul class="sidebar-menu" id="nav-accordion">
		        
		        	  <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="60"></a></p>
		        	  <h5 class="centered">Admin</h5>
		        	  	
		            <li class="mt">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-dashboard')).$this->Html->tag('span','Dashboard'), 
		                      array('controller' => 'pages', 'action' => 'display'), array('escape' => false));?>
		            </li>

		            <li class="sub-menu">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-desktop')).$this->Html->tag('span','Projects'), 
		                    "javascript:;", array('escape' => false));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Projects'), array('controller' => 'projects', 'action' => 'index'));?></li>
		                  <li><?php echo $this->Html->link(__('Issue Assignment'), array('controller' => 'teams', 'action' => 'view'));?></li>
		                </ul>
		            </li>

		            <li class="sub-menu">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-cogs')).$this->Html->tag('span','Teams'), 
		                    "javascript:;", array('escape' => false));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Teams'), array('controller' => 'teams', 'action' => 'index'));?></li>
		                </ul>
		            </li>
		            <li class="sub-menu">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-book')).$this->Html->tag('span','Members'), 
		                    "javascript:;", array('escape' => false));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Members'), array('controller' => 'members', 'action' => 'index'));?></li>
		                </ul>
		            </li>
		        </ul>
		        <!-- sidebar menu end-->
		    </div>
		</aside>
		<!--sidebar end-->
		<section id="main-content">
			<section class="wrapper">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
				</section>
		</section>

		<?php 
			echo $this->Html->script(
				array(
					'assets/js/bootstrap.min',
					'assets/js/jquery.scrollTo.min',
					'assets/js/jquery.nicescroll',
					'assets/js/jquery.sparkline',
					'assets/js/common-scripts',
					'assets/js/gritter/js/jquery.gritter',
					'assets/js/gritter-conf',
					'assets/js/sparkline-chart',
					'assets/js/zabuto_calendar',
					'assets/js/jquery.dcjqaccordion.2.7.js'
				)
			);
		?>
	    <!--<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>-->
	    
	</section>
	<br><br>
	<!--footer start-->
	<footer class="site-footer">
	  <div class="text-center">
	      FDC - Project Viewer
	     <!-- <a href="index.html#" class="go-top">
	          <i class="fa fa-angle-up"></i>
	      </a>
	  	  -->
	  </div>
	</footer>
	<!--footer end-->
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
