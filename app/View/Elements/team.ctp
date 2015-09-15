<?php 
	$team = $content['team'];
	$members = $content['members'];
	$pdetails = $content['pdetails'][0];
	$stat = $content['stat'];
?>
<div id="team_content" class="panel panel-primary">
	<div class="panel-heading" role="tab" id="headingOne">
  		<h4 class="panel-title">
    		<a role="button" data-toggle="collapse" data-parent="#team" href="#member" aria-expanded="true" aria-controls="collapseOne">
      		<?php echo $team['Team']['team'];?>
			</a>
  		</h4>
	</div>
	<div data-example-id="simple-responsive-table" class="bs-example">
		<div class="table-responsive">
			<div id="member" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<table class="table">
						<thead>
							<th>Member</th>
							<th>Issue No.</th>
							<th>Description</th>
							<th>Issue Link</th>
							<th>Status</th>
							<th>Deadline</th>
						</thead>
						<tbody>
						<?php foreach ($members as $member): ?>
							<tr>
								<td rowspan="1" style="border-bottom:0;"><?php echo $member['Member']['member'];?></td>
								<td colspan="5" style="border-bottom:0;">
									<table id="team_issue" class="table table-hover" border="0">
										<tbody team="<?php echo h($team['Team']['id']);?>" member="<?php echo h($member['Member']['id']);?>">
										<?php foreach ($pdetails['Pdetail'] as $pdetail):?>
										<?php if($pdetail['member'] == $member['Member']['id']):?>
											<tr class="info" id=<?php echo h($pdetail['id']); ?> data="<?php echo h($pdetail['status']); ?>">
												<td><?php echo h($pdetail['issue_no']); ?></td>
												<td><?php echo h($pdetail['task_description']); ?></td>
												<td style="word-wrap:break-word"><a href="<?php echo h($pdetail['issue_link']); ?>" target="_blank"><?php echo h($pdetail['issue_link']); ?></a></td>
												<td><?php
												 $getstat = $pdetail['status']; 
												foreach($stat as $key => $value) {
													foreach ($value as $key1 => $nval) {
														if($getstat == $nval['status_id']){
													        echo $nval['status']; 
													    }
													}
												}
												?></td>
												<td><?php echo h($pdetail['deadline']); ?></td>
											</tr>
										<?php endif; ?>
										<?php endforeach;?>

											<tr class="notSortable" ><td></td><td></td><td></td><td></td><td></td></tr>
										</tbody>
									</table>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>