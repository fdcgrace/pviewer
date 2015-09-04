<section class="container-fluid" id="content">

	<h3>Project Detail</h3>
	<div class="row mt">
		<div class="col-md-6">

			<?php 
				date_default_timezone_set("Asia/Manila"); 
			$todayDate = date("Y-m-d"); 
			$baseUrl= Router::url('/', true);
				echo $this->Html->link(__('Create New Issue'), array('action' => 'add',1), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
			?>

		</div>
		<div class="col-md-6" style="text-align:right;">
				Legend: 
				<span class="label color-box" style="background-color:#FF1919;?>"  id="1">
					For Testing
				</span>
				<span class="label color-box" style="background-color:#FFA3D1;?>"  id="1">
					In Progress
				</span>
				<span class="label color-box" style="background-color:#A3FFA3;?>"  id="1">
					Released
				</span>
				<span class="label color-box" style="background-color:#666699;?>"  id="1">
					For Release
				</span>
				<span class="label color-box" style="background-color:#CC33FF;?>"  id="1">
					Pending
				</span>
			<a href="#" class="btn-setting"><img class='legend-modal' src='http://localhost/pviewer-layout/img/setting.png' style='width:18px;height=18px'></a>
		</div>

	</div>	
	<hr>
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading" style="background:#FF1919;color:#FFF;">
					<h4><i class="fa fa-angle-right"></i> For Testing</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-advance table-hover table-responsive" id='tab-click'>
						<thead>
							<th>PID</th>
							<th>Deadline</th>
							<th>Issue Number</th>
							<th>Task Description</th>
							<th>Assignee</th>
							<th>Issue Link</th>
							<th>Status</th>
							<th>Priority</th>	
							<th>Progress</th>
							<th class="actions">Actions</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>2015-08-06</td>
								<td>7875</td>
								<td>Pagination</td>
								<td>
									<select>
										<option>Please Select</option>
									</select>
								</td>
								<td><a>http://redmine.vjsol.jp/issues/7874</a></td>
								<td>
									<select>
										<option>Please Select</option>
									</select>
								</td>
								<td>
									<div class="input select">
										<div class="br-wrapper br-theme-bars-pill">
											<select class="example-pill" style="display: none;" default="default">
												<option>Lowest</option>
												<option>Medium</option>
												<option>Highest</option>
											</select>
										</div>
									</div>
								</td>
								<td>
									<div class="input select">
										<div class="br-wrapper br-theme-bars-1to10">
											<select class="example-1to10" style="display: none;">
												<option>0</option>
												<option>10</option>
												<option>20</option>
												<option>30</option>
												<option>40</option>
												<option>50</option>
												<option>60</option>
												<option>70</option>
												<option>80</option>
												<option>90</option>
												<option>100</option>
											</select>
										</div>
									</div>
								</td>
								<td>
									<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', 1), array('class' => 'glyphicon glyphicon-floppy-disk', 'style' => 'color:#FF1919')); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#editForm', 'class' => 'glyphicon glyphicon-pencil', 'style' => 'color:#FF1919')); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', 1), array('confirm' => __('Are you sure you want to delete # %s?', 1), 'class' => 'glyphicon glyphicon-trash', 'style' => 'color:#FF1919')); ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</section>

<!--addForm button -->
<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end addForm button -->

<!--editForm button -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
	    <div class="modal-content">
	    </div>
	</div>
</div>
<!--end editForm button -->

