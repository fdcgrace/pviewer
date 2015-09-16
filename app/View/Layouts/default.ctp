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
				'mystyle',
				'bootstrap-colorpicker.min',
				'bootstrap-colorpicker',
				'colpick',
				'style',
				'jquery-ui',
				'jquery-ui.structure',
				'jquery-ui.theme'
			)
		);
		echo $this->fetch('css');

		echo $this->Html->script(
			array(
				// 'assets/js/jquery-1.8.3.min',
				'assets/js/jquery',
				'jquery-ui',
				'bars',
				'jquery.barrating',
				'assets/js/chart-master/Chart',
				'bootstrap-colorpicker',
				'colorpicker-color',
				'docs',
				'colpick',
				'bootstrap-slider',
				'pdfobject',
				'custom'
			)
		);
		echo $this->fetch('script');

	?>
	<script type="text/javascript">var baseUrl = '<?php echo $this->base; ?>';</script>
</head>
<body>
	<section id="container">
		<!-- *****************(*****************************************************************************************************************************************
		TOP BAR CONTENT & NOTIFICATIONS
		*********************************************************************************************************************************************************** -->
      	<!--header start-->
      	<header class="header black-bg" style="z-index:99">
			<div class="sidebar-toggle-box">
			  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
			</div>
	            <!--logo start-->
	            <!-- <a href="index.html" class="logo"><b>FDC-Project Viewer</b></a> -->
	            <?php echo $this->Html->link($this->Html->tag('b','FDC-Project Viewer'), array('controller' => 'pages', 'action' => 'display'), array('escape' => false, 'class' => 'logo'));?>
	            <!--logo end-->
	            
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
		    <div id="sidebar"  class="nav-collapse " style="z-index:98">
		        <!-- sidebar menu start-->
		        <ul class="sidebar-menu" id="nav-accordion">
		        
		        	  <p class="centered"><a href="profile.html"><img src="<?php echo $this->base; ?>/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
		        	  <h5 class="centered">Admin</h5>
		        	  	
		            <li class="sub-menu">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-desktop')).$this->Html->tag('span','Projects'), 
		                    "javascript:;", array('escape' => false, 'cid' => 1, 'class' => 'parent'));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Projects'), array('controller' => 'projects', 'action' => 'index'));?></li>
		                  <!-- <li><?php //echo $this->Html->link(__('Issue'), array('controller' => 'pdetails', 'action' => 'getIssue'));?></li> -->
		                  <li><?php echo $this->Html->link(__('Issue Assignment'), array('controller' => 'teams', 'action' => 'view'));?></li>
		                </ul>
		            </li>

		            <li class="sub-menu">  
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-cogs')).$this->Html->tag('span','Teams'), 
		                    "javascript:;", array('escape' => false, 'cid' => 2, 'class' => 'parent'));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Teams'), array('controller' => 'teams', 'action' => 'index'));?></li>
		                </ul>
		            </li>
		            <li class="sub-menu">
		                <?php echo $this->Html->link($this->Html->tag('i','', array('class' => 'fa fa-book')).$this->Html->tag('span','Members'), 
		                    "javascript:;", array('escape' => false, 'cid' => 3, 'class' => 'parent'));?>
		                <ul class="sub">
		                  <li><?php echo $this->Html->link(__('View Members'), array('controller' => 'members', 'action' => 'index'));?></li>
		                </ul>
		            </li>
		        </ul>
		        <!-- sidebar menu end-->
		    </div>
		</aside>
		<!--sidebar end-->
		<!--start of script-->
		<script>
			$(document).ready(function() {
				var id = <?php echo $controllerID; ?>;
				$("a.parent").each(function() {
					if($(this).attr('cid') == id) {
						$(this).addClass('active');
					} else {
						// $(this).removeClass('active');
					}
				});
			});
		</script>
		<!-- end of script -->
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
					'assets/js/jquery.dcjqaccordion.2.7.js',
				)
			);
		?>
	    <!--<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>-->
	    
	</section>
	<br><br>
	<!--footer start-->
	<footer class="site-footer footer">
	  <div class="text-center" style="text-align:center;">
	      FDC - Project Viewer
	     <!-- <a href="index.html#" class="go-top">
	          <i class="fa fa-angle-up"></i>
	      </a>
	  	  -->
	  </div>
	</footer>
	<!--footer end-->
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
