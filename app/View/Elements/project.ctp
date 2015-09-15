<?php 
	$project = $content['project'];
	$unassigned = $content['unassigned'];
	$stat = $content['stat'];
?>
<div id="project_content" class="panel panel-success">
	<div class="panel-heading" role="tab" id="headingTwo">
		<h4 class="panel-title">
			<a role="button" data-toggle="collapse" data-parent="#project" href="#issue" aria-expanded="true" aria-controls="collapseOne">
      		<?php echo $project['Project']['p_name'];?>
			</a>
		</h4>
	</div>
	<div id="issue" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		<div id="headingTwo"  class="panel-body">
			<table id="project_table" class="table table-hover" style="word-wrap:break-word;table-layout:fixed;">
				<!--insert if condition to check if there are issues-->
				<?php if($unassigned):?>
				<thead>
					<th>Issue No.</th>
					<th>Description</th>
					<th>Issue Link</th>
					<th>Status</th>
					<th>Deadline</th>
				</thead>
				<tbody team="<?php echo h($project['Project']['team_id']);?>">
					<!-- <tr colspan="5" class="notSortable" ></tr> -->
					<tr class="notSortable" ><td></td><td></td><td></td><td></td><td></td></tr>
					<!--insert foreach here for issue-->
					<?php foreach ($unassigned as $u_assign): ?>
					<tr class="success" id=<?php echo h($u_assign['Pdetail']['id']);?> data="<?php echo h($u_assign['Pdetail']['status']); ?>">
						<td><?php echo h($u_assign['Pdetail']['issue_no']); ?></td>
						<td><?php echo h($u_assign['Pdetail']['task_description']); ?></td>
						<td style="word-wrap:break-word"><a href="<?php echo h($u_assign['Pdetail']['issue_link']); ?>" target="_blank"><?php echo h($u_assign['Pdetail']['issue_link']); ?></a></td>
						<td>
							<?php
								//echo h($u_assign['Pdetail']['status']); 
							$getstat = $u_assign['Pdetail']['status']; 
							foreach($stat as $key => $value) {
								foreach ($value as $key1 => $nval) {
									if($getstat == $nval['status_id']){
								        echo $nval['status']; 
								    }
								}
							}
							?>
						</td>
						<td><?php echo h($u_assign['Pdetail']['deadline']); ?></td>
					</tr>
					<?php endforeach;?>
					<!--endforeach here-->
				</tbody>
				<?php else: ?>
				<!--else condition -->
				<tbody team="<?php echo h($project['Project']['team_id']);?>">
					<!-- <tr colspan="5" class="notSortable" >No Issue</tr> -->
					<tr class="notSortable" >No Issue<td></td><td></td><td></td><td></td><td></td></tr>
				</tbody>
				<?php endif;?>
				<!--endif -->
			</table>
		</div>
	</div>
</div>