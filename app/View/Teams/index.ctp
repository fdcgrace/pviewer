<div class="container-fluid">
<?php echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
	<hr>
	<div class="row">
	<?php $counter = 0; ?>
	<?php foreach ($team as $key => $teams): ?>
		<?php $counter++; ?>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  	<div class="panel panel-default">
			    	<div class="panel-heading" role="tab" id="headingOne">
			      		<h4 class="panel-title">
			        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $counter;?>" aria-expanded="true" aria-controls="collapseOne">
				      		<?php echo $teams['Team']['team'];?>
							</a>
			      		</h4>
			    	</div>
		    		<div id="<?php echo $counter;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      			<div class="panel-body">
					      	<table class="table table-hover">
					      	<?php if($teams['Project']['p_name']): ?>
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('Project Name'); ?></th>
									<th><?php echo $this->Paginator->sort('Link'); ?></th>
									<th><?php echo $this->Paginator->sort('Team Assigned'); ?></th>
									<th><?php echo $this->Paginator->sort('Number of Task'); ?></th>
									<th><?php echo $this->Paginator->sort('Created Date'); ?></th>
									<th><?php echo $this->Paginator->sort('Modifiedd Date'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
					      	<?php //foreach ($teams as $key2 => $val): ?>
					      			<?php //if ($key2 != 0 ):?>
					      			
										<tbody>
											<tr>
												<td><?php echo h($teams['Project']['p_name']); ?></td>
												<td><a href="<?php echo h($teams['Project']['link']); ?>" target="_blank"><?php echo h($teams['Project']['link']); ?></a></td>
												<td><?php echo h($teams['Team']['team']); ?></td>
												<td><?php echo h($teams[0]['total_num_task']); ?></td>
												<td><?php echo h($teams['Project']['created']); ?></td>
												<td><?php echo h($teams['Project']['modified']); ?></td>
												<td class="actions">
													<?php echo $this->Html->link(__('View Issue'), array('controller' => 'pdetails', 'action' => 'index', $teams['Project']['id'])); ?>
													<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $teams['Project']['id'])); ?>
													<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $teams['Project']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $teams['Project']['id']))); ?>
												</td>
											</tr>
										</tbody>
									<?php else:?>
										<tbody>
											<td>No Issue</td>
										</tbody>
									<?php endif;?>
							<?php// endforeach; ?>
							</table>
				      	</div>
				    </div>
			  	</div>
			</div>
	<?php endforeach; ?>
	</div>
</div>


    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Lorem ipsum</p>
      </div>
      
      <div class="row">
      	<h4>These work</h4>
      	<div class="col-md-6">
      		<input type="text" id="colorPick1" class="colorPick"/>
      	</div>
      	<div class="col-md-6">
      		<input type="text" id="colorPick2" class="colorPick"/>
      	</div>
      </div>
      
      <!-- Button trigger modal -->
      <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Launch demo modal
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
            	<h4>Within a modal, these don't work</h4>
            	<div class="row">
            		<div class="col-md-6">
            			<input type="text" id="colorPick3" class="colorPick"/>
            		</div>
            		<div class="col-md-6">
            			<input type="text" id="colorPick4" class="colorPick"/>
            		</div>
            	</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div><!-- /.container -->



     <div class="well">
          <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Show
          </button>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
               aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"
                          aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">In a Modal</h4>
                </div>
                <div class="modal-body">
                  <div class="input-group colorpicker-component demo demo-auto">
                    <input type="hidden" value="#ffffff" class="form-control"/>
                    <span class="input-group-addon"><i></i></span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>