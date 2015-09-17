*Click on member to show more details
<table class='table table-hovered table-bordered table-striped content-panel'>

	<thead>
								<tr>
								<td></td>	
								<th><?php echo $this->Paginator->sort('Team Member'); ?></th>
								<th><?php echo $this->Paginator->sort('Created'); ?></th>
								<th><?php echo $this->Paginator->sort('Modified'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								 $r = 0;
								 foreach ($issueArray as $leaderInfo): ?>
								 <?php $r++; ?>
								<tr onclick="toggleRowsMember('member<?php echo $r; ?>','<?php echo $r ?>');">
									<td></td>
									<td><?php echo $leaderInfo['Member']['member'] ?></td>
									<td><?php echo $leaderInfo['Member']['created'] ?></td>
									<td><?php echo $leaderInfo['Member']['modified'] ?></td>


								<?php endforeach; ?>	
							</tbody>

</table>

	<div id='member-history' class="rcorners2" style='display:none;'>
		</div>			

									<?php $count =1; ?>
		

		 								<?php 
		 							foreach ($issueArray as $project)
										{?>
									 <div  id='member<?php echo $count++; ?>' style='display:none;'>
										<table  class='table table-bordered table-hovered table-striped archive-table'>
											<tr >
											<th  style='background-color:#428bca;color:white'>Team'</th>
											<th  style='background-color:#428bca;color:white'>Created</th>
											<th  style='background-color:#428bca;color:white'>Modified</th>
													</tr>
											<?php
											
											
													echo '<tr>';
													echo '<td>'.$project['Team']['team'].'</td>';
													echo '<td>'.$project['Team']['created'].'</td>';
													echo '<td>'.$project['Team']['modified'].'</td>';
													echo '</tr>';
												
												
											?>
										</div>
										</table>
										<form>

										</form>
										<?php } ?>