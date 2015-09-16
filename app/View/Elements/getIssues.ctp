<?php // debug($issueArray); ?>
<script>
	function getProject(id)
	{
		$('#issue-history').html($('#'+id).html());
		$('#issue-history').show();
	}
</script>
<br ><br >
<table class='table table-bordered table-hovered table-striped content-panel'>
											<center>		<tr>
												<td></td>
													<th>Issue No.</th>
													<th>Task Description </th>
													<th>Issue Link</th>
													<th>Asignee</th>
													<th>Created</th>
													<th>Modified</th>
													<th>Deadline</th>
													<th>Start Date</th>
													<th>Priority</th>
													<th>Progress</th>
													</tr>
											<?php
												$r = 1;
												foreach ($issueArray as $project):
												{ ?>
													<tr onclick="getProject('issue<?php echo $r++; ?>')">
													<td><input type='radio' id='issue-radio<?php echo $r;?>' name='radio-issue'></td>
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
										<?php } ?>
									</div>					