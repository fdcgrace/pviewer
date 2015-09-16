
<table class='table table-hovered table-bordered table-striped content-panel'>

	<thead>
								<tr>
								<td></td>	
								<th><?php echo $this->Paginator->sort('Team Leader'); ?></th>
								<th><?php echo $this->Paginator->sort('Created'); ?></th>
								<th><?php echo $this->Paginator->sort('Modified'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								 $r = 0;
								 foreach ($issueArray as $leaderInfo): ?>
								 <?php $r++; ?>
								<tr onclick="toggleRowsLeader('project<?php echo $r; ?>','<?php echo $r ?>');">
									<td></td>
									<td><?php echo $leaderInfo['Team']['team'] ?></td>
									<td><?php echo $leaderInfo['Team']['created'] ?></td>
									<td><?php echo $leaderInfo['Team']['modified'] ?></td>


								<?php endforeach; ?>	
							</tbody>

</table>

	<div id='leader-history' class="rcorners2" style='display:none;'>
		</div>			

									<?php $count =1; ?>
		

		 								<?php 
		 							foreach ($issueArray as $project)
										{?>
									 <div  id='project<?php echo $count++; ?>' style='display:none;'>
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
