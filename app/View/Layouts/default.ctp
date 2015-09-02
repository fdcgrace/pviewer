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
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(
			array(
			//'cake.generic',
			'bootstrap',
			'bootstrap-theme',

			/*'bootstrap-editable',*/
			//'docs',
			'bootstrap-colorpicker.min',
			'colpick',
			'bootstrap-slider',
			'jquery-ui',
			'jquery-ui.structure',
			'jquery-ui.theme',
			'mystyle', 
			'font-awesome.min',
			'bars-pill',
			'bars-1to10',
			'style',
			'mystyle',
			)
		);

		echo $this->Html->script(array(

			'jquery',
			'jquery.min',
			// 'bootstrap', 
			'bootstrap.min',
			/*'bootstrap-editable.min',*/
			/*'colorpicker',
			'jquery',
			'jquery.min',
			'bootstrap', /*
			'bootstrap.min',*/
			/*'colorpicker',*/
			'bootstrap-colorpicker',
			'colorpicker-color',
			'docs',
			'colpick',
			'bootstrap-slider',
			'jquery-ui',

			'custom',
			'jquery.barrating',
			'bars'
			)
		);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>

</script>
<body>			
	<div id="container">
		<div id="header">
			<nav class="navbar navbar-default navbar-static-top">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          	<a class="navbar-brand" href="#">Project Viewer</a>
		       		<ul class="nav navbar-nav">
		          		<li><?php echo $this->Html->link(__('Team Project List View'), array('controller' => 'teams', 'action' => 'index')); ?>
		          		</li>
		          	</ul>
		        
		      	</div>
    		</nav>
		</div>
		<div id="content">
		<div class="container-fluid">
			<div class="row">

					<!-- <div class="col-sm-3 col-md-2 sidebar">
			      <ul class="nav nav-sidebar">
			        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
			        <li><a href="#">Reports</a></li>
			        <li><a href="#">Analytics</a></li>
			        <li><a href="#">Export</a></li>
			      </ul>
			      </ul>
			    </div>
			    <div class="col-sm-9 "> -->
					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
					<!-- </div> -->
				</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</div>


	<?php // echo $this->element('sql_dump'); ?>

</body>
</html>
