
<script>
	
</script>
<table class='table table-bordered table-hovered table-striped content-panel'>
											<center>		<tr>
												<td></td>
													<th><?php echo $this->Paginator->sort('Issue No.'); ?></th>
													<th><?php echo $this->Paginator->sort('Task Description'); ?> </th>
													<th><?php echo $this->Paginator->sort('Issue Link'); ?></th>
													<th><?php echo $this->Paginator->sort('Asignee'); ?></th>
													<th><?php echo $this->Paginator->sort('Created'); ?></th>
													<th><?php echo $this->Paginator->sort('Modified'); ?></th>
													<th><?php echo $this->Paginator->sort('Deadline'); ?></th>
													<th><?php echo $this->Paginator->sort('Start Date'); ?></th>
													<th><?php echo $this->Paginator->sort('Priority'); ?></th>
													<th><?php echo $this->Paginator->sort('Progress'); ?></th>
													</tr>
											<?php
												$r = 1;
												foreach ($issueArray as $project):
												{ ?>
													<tr onclick="getProject('issue<?php echo $r++; ?>')">
													<td></td>
													<?php 
													echo '<td>'.h($project['Pdetail']['issue_no']).'</td>';
													echo '<td>'.h($project['Pdetail']['task_description']).'</td>';
													echo '<td>'.h($project['Pdetail']['issue_link']).'</td>';
													echo '<td>'.h($project['Member']['member']).'</td>';
													echo '<td>'.h($project['Pdetail']['created']).'</td>';
													echo '<td>'.h($project['Pdetail']['modified']).'</td>';
													echo '<td>'.h($project['Pdetail']['deadline']).'</td>';
													echo '<td>'.h($project['Pdetail']['start_date']).'</td>';
													echo '<td>'.h($project['Pdetail']['priority']).'</td>';
													echo '<td>'.h($project['Pdetail']['progress']).'</td>';
													echo '</tr>';
												}
												
											?>
												<?php  endforeach;  ?> 

										</table>

		<div id='issue-history' class="rcorners2" style='display:none;'>
		</div>			

		<?php $count =1; ?>
		

		 								<?php 
		 							foreach ($issueArray as $project)
										{?>
									 <div  id='issue<?php echo $count++; ?>' style='display:none;'>
										<table  class='table table-bordered table-hovered table-striped'>
											<tr >
											<th  style='background-color:#428bca;color:white'>Project Name'</th>
											<th  style='background-color:#428bca;color:white'>Link</th>
											<th  style='background-color:#428bca;color:white'>Team Assigned</th>
											<th  style='background-color:#428bca;color:white'>Created Date</th>
											<th  style='background-color:#428bca;color:white'>Modified Date</th>
													</tr>
											<?php
											
											
													echo '<tr>';
													echo '<td>'.$project['Project']['p_name'].'</td>';
													echo '<td>'.$project['Project']['link'].'</td>';
													echo '<td></td>';
													echo '<td>'.$project['Project']['created'].'</td>';
													echo '<td>'.$project['Project']['modified'].'</td>';
													echo '</tr>';
												
												
											?>
										</div>
										</table>
										<form>

										</form>
										<?php } ?>
											