	*Click on project to show more details
<table class='table table-hovered table-bordered table-striped content-panel'>
	<thead>
								<tr>
								<td></td>	
								<th><?php echo $this->Paginator->sort('Project Name'); ?></th>
								<th><?php echo $this->Paginator->sort('Link'); ?></th>
								<th><?php echo $this->Paginator->sort('Team Assigned'); ?></th>
								<th><?php echo $this->Paginator->sort('Number of Task'); ?></th>
								<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								 $r = 0;
								 foreach ($deletedProject as $project): ?>
								 <?php $r++; ?>
								<tr onclick="toggleRows('issue<?php echo $r; ?>','<?php echo $r;  ?>');">
							



									<td><input type='radio' id='issue-radio<?php echo $r;?>' name='radio-issue'></td>	
									<td><?php echo h($project['Project']['p_name']); ?></td>
									<td><?php echo h($project['Project']['link']); ?></td>
									<td><?php echo h($project['Team']['team']); ?></td>
									<td><?php echo h(count($project['Pdetail'])); ?></td>
									<td><?php echo h($project['Project']['created']); ?></td>
									
								<?php  ?>	
								</tr>
						
								<?php endforeach; ?>
							</tbody>

</table>
								<div id='issue-div' class="rcorners2" style='display:none;'>
								</div>
		



									<?php
									  $count =1;
									  foreach ($deletedProject as $project): ?>
									   <div  id='issue<?php echo $count++; ?>'  style='display:none;' >
									   		<h3>Issues Covered</h3>
									   		<div data-example-id="simple-responsive-table" class="bs-example">
					<div class="table-responsive ">
										 <table   class='table table-hovered table-striped'> 
											<center>		<tr>

													<th style='background-color:#428bca;color:white'>Issue No.</th>
													<th style='background-color:#428bca;color:white'>Task Description </th>
													<th style='background-color:#428bca;color:white'>Issue Link</th>
													<th style='background-color:#428bca;color:white'>Created</th>
													<th style='background-color:#428bca;color:white'>Modified</th>
													<th style='background-color:#428bca;color:white'>Deadline</th>
													<th style='background-color:#428bca;color:white'>Start Date</th>
													<th style='background-color:#428bca;color:white'>Priority</th>
													<th style='background-color:#428bca;color:white'>Progress</th>
													</tr>
											<?php
												$hide = '';
												$tot = count($project['Pdetail']);
												if($tot === 0 ){
													echo "<tr><td colspan='9' class='center  blue'>No Issues found under this project.</td></tr>";
													$hide = "style='display:none'";
												}
												for($i=0;$i<count($project['Pdetail']);$i++)
												{
													echo "<tr $hide>";
													echo '<td>'.$project['Pdetail'][$i]['issue_no'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['task_description'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['issue_link'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['created'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['modified'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['deadline'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['start_date'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['priority'].'</td>';
													echo '<td>'.$project['Pdetail'][$i]['progress'].'</td>';
													echo '</tr>';
												}
												
											?>
											</center>
										</table>
										</div>
										</div>
									</div></br>
										<?php  endforeach;  ?> 
										
	