

<div class="container-fluid">

	<h3>Project Detail</h3>
	<div class="row">
		<div class="col-md-8">

			<?php 
				date_default_timezone_set("Asia/Manila"); 
			$todayDate = date("Y-m-d"); 
			$baseUrl= Router::url('/', true);
				echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary'));
				echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
			?>

		</div>
		
			Legend: 
			<?php
			$statusArray= array();
			$colorArray = array();
				foreach ($legendStatusId as $statusId => $status) {
					$statusArray[] = $status;
				}

				//debug($legendColor);
			 foreach ($legendColor as $key => $value): ?>
				<span class="label color-box" style="background-color:<?php echo $key;?>"  id="<?php echo $key;?>">
					<?php 
					 $colorArray[] = $key;
					 echo $value;

					 ?>
				</span>
			<?php endforeach;

			?>

			<a href="#" class="btn-setting"><img class='legend-modal' src='<?php echo $baseUrl; ?>img/setting.png' style='width:18px;height=18px'></a>
		</div>

	</div>	
	<hr>
	<div class="container-fluid">
		<div class="row">
			<table class="table table-striped" id='tab-click'>
				<thead>
					<tr>

						<!-- <th><?php echo $this->Paginator->sort('Project ID'); ?></th>

						<th><?php echo $this->Paginator->sort('Deadline'); ?></th>
						<th><?php echo $this->Paginator->sort('Issue Number'); ?></th>
						<!-- <th><?php //echo $this->Paginator->sort('Sub Task Description'); ?></th> -->
						<!-- <th><?php echo $this->Paginator->sort('Task Description'); ?></th>
						<th><?php echo $this->Paginator->sort('Assignee'); ?></th>
						<th><?php echo $this->Paginator->sort('Issue Link'); ?></th>
						<th><?php echo $this->Paginator->sort('Status'); ?></th>
						<th><?php echo $this->Paginator->sort('Priority'); ?></th>
						<th><?php echo $this->Paginator->sort('Progress'); ?></th>
						<th><?php echo $this->Paginator->sort('Created Date'); ?></th>

						<th><?php echo $this->Paginator->sort('Modified Date'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th> -->
						<th>Project ID</th>
									<th>Deadline</th>
									<th>Issue Number</th>
									<th>Task Description</th>
									<th>Assignee</th>
									<th>Issue Link</th>
									<th>Status</th>
									<th>Priority</th>	
									<th>Progress</th>
									<th>Modified Date</th>
									<th class="actions">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$selectedStatus = array();
					
					$tempar = array();
					$temp2 = array();

				//	debug($pdetails);

					$countArr = count($pdetails);


					echo '<h2>'.$pdetails[0]['TblColor']['status'].'</h2>';
					foreach ($pdetails as $key=>$Pdetail): ?>
						<?php
						

						$tempar[] = $Pdetail['Pdetail']['status'];
						$temp2[] = prev($tempar);

						if($key+1 != $countArr)
						$break_row =  $pdetails[$key+1]['Pdetail']['status'];
						
						if($Pdetail['Pdetail']['status'] != prev($tempar))

						$statusPdetail = $Pdetail['Pdetail']['status'];
						$selectedStatus[] = $statusPdetail;
						 echo $this->Form->create('Pdetail');
						$detId = $Pdetail['Pdetail']['id'];
						
				
						 ?>
						<tr style="background-color:<?php
						if (array_key_exists($statusPdetail, $legendColorStatus)) {
								    echo $legendColorStatus[$statusPdetail];
								}
						?>" id='<?php echo $detId; ?>'>
							<td><?php echo h($Pdetail['Pdetail']['project_id']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['deadline']); ?></td>

							<td><?php echo h($Pdetail['Pdetail']['issue_no']); ?></td>
							<!-- <td><?php //echo h($Pdetail['Pdetail']['sub_task']); ?></td> -->
							<td><?php echo h($Pdetail['Pdetail']['task_description']); ?></td>
							<td>
								 <div class="pull-right sub-menu">
								<?php

								 echo $this->Form->input('member', array(
									'type'=>'select', 
									'label' => '', 
									'empty' => 'Please Select',
									'selected' => $Pdetail['Pdetail']['member']
									)
								); ?>
							</div>
							</td>
							<td>
								<a href="<?php echo h($Pdetail['Pdetail']['issue_link']);?>" target="_blank"><?php echo h($Pdetail['Pdetail']['issue_link']);?></a>
							</td>

							<td>
								 <div class="pull-right sub-menu">
								<?php echo $this->Form->input('status', array(
								'type'=>'select', 
								'label' => '', 
								'empty' => 'Please Select',
								'default' => $Pdetail['Pdetail']['status'],
								'selected' => $Pdetail['Pdetail']['status'],
								'options' => $legendStatusId
									)
								); 

								echo $this->Form->hidden('projID', array('value' => $Pdetail['Pdetail']['project_id'], 'id' => 'projID'));
								echo $this->Form->hidden('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id'], 'id' => 'pID'));
								?>
							</td>
							<td id="<?php echo $Pdetail['Pdetail']['id']; ?>">
							<?php 
								echo $this->Form->input('priority', array(
									'type'=>'select', 
									'label' => '',
									'class' => 'example-pill',
									'selected' => $Pdetail['Pdetail']['priority'],
									'default' => $Pdetail['Pdetail']['priority'],
									'options'=> $priorityBar
									)
								); 
						


								if($Pdetail['Pdetail']['status'] == '4')
								{ ?>
									<input type='button' value='Bug Info' class='btn btn-info sub-menu' id='bug-info' onclick="checkBugInfo('<?php echo $detId; ?>')">
								<?php 
								}

								?>
							</div>
							</td>
							<!-- progress -->
							<td id="<?php echo $Pdetail['Pdetail']['id']; ?>p">
							<?php 
								echo $this->Form->input('progress', array(
									'type'=>'select', 
									'label' => '',
									'class' => 'example-1to10',
									'selected' => $Pdetail['Pdetail']['progress'],
									'default' => $Pdetail['Pdetail']['progress'],
									'options'=> $progressBar
									)
								); 
							?>
							</td>
							<!-- end progress -->
							<script type="text/javascript">
								$(document).ready(function(){
									var id = "<?php echo $Pdetail['Pdetail']['id']; ?>";
									var projID = <?php echo $Pdetail['Pdetail']['id']; ?>;
									var selected =  <?php echo $Pdetail['Pdetail']['priority']; ?>;
									//priority
									for (i = 1; i <= selected; i++) { 
										$("#"+id).find('[href="#"]').attr("gval", id);
									    if(i != selected){
									    	$("#"+id).find('[data-rating-value="'+i+'"]').addClass("br-selected");
									    }else{
									    	$("#"+id).find('[data-rating-value="'+i+'"]').addClass("br-selected br-current");
									    }
									}
									//progressBar
									var progID = "<?php echo $Pdetail['Pdetail']['id']; ?>p";
									var progressBar =  <?php echo $Pdetail['Pdetail']['progress']; ?>;
									for (p = 0; p <= progressBar; p++) { 
										$("#"+progID).find('[href="#"]').attr("gval", id);
									    if(p != progressBar){
									    	$("#"+progID).find('[data-rating-value="'+p+'"]').addClass("br-selected");
									    }else{
									    	$("#"+progID).find('[data-rating-value="'+p+'"]').addClass("br-selected br-current");
									    }
									}
								});
							</script>
							
							<td><?php echo h($Pdetail['Pdetail']['created']); ?></td>
							<!-- <td><?php //echo h($Pdetail['Pdetail']['modified']); ?></td> -->
							<td class="actions">
								 <div class="pull-right sub-menu">
								<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));?>

								<?php echo $this->Form->submit(__('Update Status'), array('class' => 'btn btn-primary btn-xs'),array('action' => 'index')); ?>
								<?php //echo $this->Html->link(__('View'), array('action' => 'view', $Pdetail['Pdetail']['id'])); ?>


								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('data-toggle' => 'modal', 'data-target' => '#editForm')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id'], $Pdetail['Pdetail']['project_id']), array('confirm' => __('Are you sure you want to delete this Project?'))); ?>
							</td>
						</tr>


						<?php
							if($Pdetail['Pdetail']['status'] != $break_row)
							{

								if(!isset($legendStatusId[$break_row]))
									$r = '';
								else
									$r = $legendStatusId[$break_row];

							echo '

									<tr >
									<th colspan=3><br><br><br><h2>'.$r.'</h2></th></tr>

									<tr></tr>
									<tr ><th>Project ID</th>
									<th>Deadline</th>
									<th>Issue Number</th>
									<th>Task Description</th>
									<th>Assignee</th>
									<th>Issue Link</th>
									<th>Status</th>
									<th>Priority</th>	
									<th>Progress</th>
									<th>Modified Date</th>
									<th class="actions">Actions</th><td></td></tr>

									
									
									';
								}
							?>
						
					<?php

						$i= $Pdetail['Pdetail']['status'];
					 endforeach; ?>

				</tbody>
			</table>
		</div>
		<p>
			<?php

				echo $this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>	
		</p>
		<div class="paging">
			<?php
				echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
			?>
		</div>
	</div>	
</div>
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


<div class="bs-example">
 
</div>



   <!-- Button HTML (to Trigger Modal) -->
    
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Legend Settings</h4>
                </div>
                <div class="modal-body">
                	
                	<div id='table-legend'>
                		<?php
							$imploded = implode('|', $selectedStatus);
							$colorArrayImploded = implode('|', $colorArray);
							
                		?>
                		<input type="hidden" value="<?php  echo $imploded; ?>" id="hide-status">
                		<input type="hidden" value="<?php  echo $colorArrayImploded; ?>" id="hide-color">


                	<table class='table table-striped'>
                		<tr>
                			<td colspan='2'><input type='radio' id='radio-legend'>Add Legend

                				<div id='add-legend' style='display:none'>

                					<input type="text" id="legend-add" style='float:left'>
                					 <div class="colorpicker-component demo demo-auto">
					                    <input type="hidden" value="#ffffff" id='color-pick'/>
					                 
					                    <input type='text' class='input-group-addon'>
					                  </div>
                				<input type='button' class='btn btn-primary btn-sm' style='float:left' onclick='insertLegend("insertLegend");' value="ADD" >
                				</div>
                			
                			</td>
                		</tr>
                		<?php
                		  foreach ($legendColorModal as $value): 
                		  	echo $value['Tblcolor']['color'];
                		  	?>
                		<tr>
                			<td>
								<span class="label color-box2" style="background-color:<?php echo $value['Tblcolor']['color'];?>; z-index: 1022;"  id="<?php echo $value['Tblcolor']['color'];?>"><?php echo $value['Tblcolor']['status'];?></span>
							</td>
							<td> 
								<input type='button' class='btn btn-primary btn-sm' onclick='showEdit("<?php echo $value['Tblcolor']['status']; ?>")' value='EDIT'>
								<input type='button' class='btn btn-primary btn-sm' onclick='if(confirm("Are you Sure?") == true)editDeleteLegend("deleteLegend","<?php echo $value['Tblcolor']['status']; ?>","<?php echo $value['Tblcolor']['status_id']; ?>")' value="DELETE" id='legend-delete'>
							</td>
							<?php endforeach;?>
                		
                	</table>
                	</div>	
                	<div id="divEdit" style="display:




                	none">
                		<div id='back'  style='margin-bottom:30px;'><img class='legend-modal' onclick='backFunction()' src='<?php echo $baseUrl; ?>img/back.png' style='width:18px;height=18px'>
                		</div>
                		<input type='text' id='edit-status'>
                		<input type='button' class='btn btn-primary btn-sm' onclick='editLegend("editLegend");' value="SAVE" id='legend-edit'>
                		<input type='hidden' id='edit-hidden'>
                	</div>


                </div>
              
            </div>
        </div>
    </div>



    <div id="myModal3" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Issue Specs</h4>
                </div>
                <div class="modal-body">
                	  <ul class="tabs">
				        <li class="labels">
				            <label for="tab1" id="label1" style='background-color:#3498db' onclick="changeBgcolor('label1','2-3-4');">Specs(link)</label>
			            <label for="tab2" id="label2" onclick="changeBgcolor('label2','1-3-4');">Files Modified</label>
			            <label for="tab3" id="label3" onclick="changeBgcolor('label3','1-2-4');">Files Released</label>
			            <label for="tab4" id="label4" onclick="changeBgcolor('label4','1-2-3');">Files Added</label>
			            <input type='hidden' id='general-issueid'  >
			        </li>
			        <li>
			            <input type="radio" checked name="tabs" id="tab1">
			            <div id="tab-content1" class="tab-content">
			            	<div id="left-column">
							<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('type' => 'file','action' => 'insertFiles'));
									/* create file input */
									?>
									<div id='info'>
									<input id="pdetailsFile" type="file" name="data[pdetails][file][]" multiple="multiple">	
									<?php
								//	echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid'));
									echo $this->Form->input('type',array( 'type' => 'hidden','id' => 'issueid','value' => 'file'));
									echo $this->Form->input('category',array( 'type' => 'hidden','id' => 'issueid','value' => 'specs'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 1));

									?>
								</div>
										 <input type='button' value='Add' id='add' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
									<br />

									<div style='border-top:solid black'>

									<b>LINKS/LIST FILES</b> <br />
									<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('action' => 'insertText'));
									/* create file input */
									?>
									<div id='info1v1'>
									<input id="pdetailsText" type="text" name="data[pdetails][text][]">		
									<?php
									//echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid1v1'));
									echo $this->Form->input('type',array( 'type' => 'hidden','value' => 'link'));
									echo $this->Form->input('categoy',array( 'type' => 'hidden','id' => 'issueid','value' => 'specs'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 1));

									?>
								</div>
										 <input type='button' value='Add' id='add1v1' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
								</div>
							</div>
							<div id="right-column">

							<h4><b>Uploaded Files</b></h4>

									<div id= 'right-column11'>
										<b>PHP FILES</b>
										<div id='php1'></div>
										<br>
										<b>HTML FILES</b>
										<div id='html1'></div>
										<br>
										<b>OTHERS/LINKS</b>
										<div id='links1'></div>

									</div>
							</div>
			                	
			                <!-- Your Content Here -->
			            </div>
			        </li>
			        <li>
			            <input type="radio" name="tabs" id="tab2">
			            <div id="tab-content2" class="tab-content">
			                <div id="left-column">
							<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('type' => 'file','action' => 'insertFiles'));
									/* create file input */
									?>
									<div id='info2'>
									<input id="pdetailsFile" type="file" name="data[pdetails][file][]" multiple="multiple">		
									<?php
									//echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid2'));
									echo $this->Form->input('type',array( 'type' => 'hidden','value' => 'file'));
									echo $this->Form->input('category',array( 'type' => 'hidden','id' => 'issueid','value' => 'modified'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 2));
									echo $this->Form->input('dateModified',array( 'type' => 'hidden','id' => 'dateModified','value' => $todayDate));

									?>
								</div>
									<input type='button' value='Add' id='add2' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
									<br />

									<div style='border-top:solid black'>

									<b>LINKS/LIST FILES</b> <br />
									<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('action' => 'insertText'));
									/* create file input */
									?>
									<div id='info2v1'>
									<input id="pdetailsText" type="text" name="data[pdetails][text][]">		
									<?php
									//echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid2v1'));
									echo $this->Form->input('type',array( 'type' => 'hidden','value' => 'link'));
									echo $this->Form->input('categoy',array( 'type' => 'hidden','id' => 'issueid','value' => 'modified'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 2));
									echo $this->Form->input('dateModified',array( 'type' => 'hidden','id' => 'dateModified','value' => $todayDate));

									?>
								</div>
										 <input type='button' value='Add' id='add2v1' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
								</div>

							</div>

							<div id="right-column2">
								<h4><b>Uploaded Files</b></h4>
								<table id="table-resultsmodified">
								</table>
							

							<div id= 'right-column21'>
								<!-- <b>PHP FILES</b>
										<div id='php2'></div>
										<br>
										<b>HTML FILES</b>
										<div id='html2'></div><br>
										<b>OTHERS/LINKS</b>
										<div id='links2'></div> -->
							</div>
							</div>
			                <!-- Your Content Here -->
			            </div>
			        </li>
			        <li>
			            <input type="radio" name="tabs" id="tab3">  
			            <div id="tab-content3" class="tab-content">
			                 <div id="left-column">
							<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('type' => 'file','action' => 'insertFiles'));
									/* create file input */
									?>
									<div id='info3'>
									<input id="pdetailsFile" type="file" name="data[pdetails][file][]" multiple="multiple">	
									<?php
									//echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid3'));
									echo $this->Form->input('type',array( 'type' => 'hidden','value' => 'file'));
									echo $this->Form->input('category',array( 'type' => 'hidden','id' => 'issueid','value' => 'released'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 3));
									echo $this->Form->input('dateReleased',array( 'type' => 'hidden','id' => 'dateReleased','value' => $todayDate));

									?>
								</div>
										 <input type='button' value='Add' id='add3' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
							</div>

							<div id="right-column3">
							<h4><b>Uploaded Files</b></h4>
								<table id="table-resultsreleased">
								</table>


							<div id= 'right-column31'>
								<!-- 		<b>PHP FILES</b>
										<div id='php3'></div>
										<b>HTML FILES</b>
										<div id='html3'></div> -->
							</div>
							
							
							</div>
			                <!-- Your Content Here -->
			            </div>
			        </li>
			        <li>
			            <input type="radio" name="tabs" id="tab4">  
			            <div id="tab-content4" class="tab-content">
			                <div id="left-column">
							<?php
									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('type' => 'file','action' => 'insertFiles'));
									/* create file input */
									?>
									<div id='info4'>
									<input id="pdetailsFile" type="file" name="data[pdetails][file][]" multiple="multiple">		
									<?php
									//echo $this->Form->input('file',array( 'type' => 'file','multiple'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'issueid4'));
									echo $this->Form->input('type',array( 'type' => 'hidden','value' => 'links'));
									echo $this->Form->input('category',array( 'type' => 'hidden','id' => 'issueid','value' => 'added'));
									echo $this->Form->input('specsid',array( 'type' => 'hidden','id' => 'specsid','value' => 4));

									?>
								</div>
										 <input type='button' value='Add' id='add4' />
									<?php
									/* create submit button and close form */
									echo $this->Form->end('Submit');
									?>
							</div>

							<div id="right-column4">
							<h4><b>Uploaded Files</b></h4>

							<div id= 'right-column41'>
										<b>PHP FILES</b>
										<div id='php4'></div>
										<b>HTML FILES</b>
										<div id='html4'></div>
							</div>
							
							
							
							</div>
			                <!-- Your Content Here -->
			            </div>
			        </li>
			    </ul>  


								
                	
                <div id='issue-details'>
                </div>

                </div>
              
            </div>
        </div>
    </div>



        <div id="myModal4" class="modal modal-wide fade">
        <div class="modal-dialog" >
            <div class="modal-content" style='max-width:900px'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Bug Info</h4>
                </div>
                <div class="modal-body">
                	<center>
                		  <div id='div-bugs'  style='display:none' >	

                	<table class='table table-responsive' style='max-width:900px'>
                		<tbody id='lala'>
                			<tr>
                				<th>Bug Description	</th>
                				<th>Stepds on how bug is produced</th>
                				<th>Status	</th>
                				<th>Status after fix	</th>
                				<th>Who found the bug</th>
                				<th>Reason of Bug</th>
                				<th colspan='2'>ACtion</th>
                			

	


	

                			</tr>
                		</tbody>
                	
                	</table>
                </div>
                		<div id='addBugInfo'>
                	<table class='table table-hovered table-striped'>

                					<tr><!-- <td><label><input type='checkbox' onclick='handleClick(this);'>Edit</label></td> -->
                						<td><label><input type='checkbox' id='show-all' onclick='showBugList(this);'>Show all bugs</label></td>
                					</tr>
                	<?php

									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('action' => 'insertBugInfo'));
									echo $this->Form->input('issueid', array('type' => 'hidden','id' => 'issueid-bug','name' => "data[pdetails][issueid-bug]"));
									echo '<tr><td colspan=2>'.$this->Form->input('Bug Description',array( 'id' => 'bug-desc','class' => 'form-control','type' => 'text','name' => "data[pdetails][bugdescription]")).'</td></tr>';
									echo '<tr><td colspan=2>'.$this->Form->input('Steps on how bug is produced',array( 'id' => 'bug-steps','class' => 'form-control','type' => 'textarea','name' => "data[pdetails][bugsteps]")).'</td></tr>';
									echo '<tr><td colspan=2>'.$this->Form->input('Status',array( 'id' => 'bug-stat','class' => 'form-control', 'type' => 'text','name' => "data[pdetails][bugstatus]")).'</td></tr>';
									echo '<tr><td colspan=2>'.$this->Form->input('Status after fix',array('id' => 'bug-statafter','class' => 'form-control', 'type' => 'text','name' => "data[pdetails][statusAfter]")).'</td></tr>';

									echo '<tr><td colspan=2>'.$this->Form->input('Who found the bug',array('id' => 'bug-whofound','class' => 'form-control', 'type' => 'text','name' => "data[pdetails][whofound]")).'</td></tr>';
									echo '<tr><td colspan=2>'.$this->Form->input('Reason of Bug',array('id' => 'bug-reason','class' => 'form-control',  'type' => 'text','name' => "data[pdetails][bugreason]")).'</td></tr>';

									?>

									<?php
									/* create submit button and close form */

									echo '<tr><td><button type="submit" class="btn btn-primary">Submit</button>'.$this->Form->end().'</td><td><td></tr>';
									?>
								
							       
					</table></div></center>
					<center>
                		<div id='addBugInfo2' style='display:none'>
                	<table class='table table-hovered table-striped'>

                					
                	<?php

									/* create form with proper enctype */
									echo $this->Form->create('pdetails', array('action' => 'updateBugInfo'));
									echo $this->Form->input('issueid',array( 'type' => 'hidden','id' => 'bug-id2','name' => "data[pdetails][issueid-bug]"));
									echo '<tr><td>Bug Description</td><td>'.$this->Form->input('',array( 'id' => 'bug-desc2','type' => 'text','name' => "data[pdetails][bugdescription]")).'</td></tr>';
									echo '<tr><td>Steps on how bug is produced</td><td>'.$this->Form->input('',array( 'id' => 'bug-steps2','type' => 'textarea','name' => "data[pdetails][bugsteps]")).'</td></tr>';
									echo '<tr><td>Status</td><td>'.$this->Form->input('',array( 'id' => 'bug-stat2', 'type' => 'text','name' => "data[pdetails][bugstatus]")).'</td></tr>';
									echo '<tr><td>Status after fix</td><td>'.$this->Form->input('',array('id' => 'bug-statafter2', 'type' => 'text','name' => "data[pdetails][statusAfter]")).'</td></tr>';

									echo '<tr><td>Who found the bug</td><td>'.$this->Form->input('',array('id' => 'bug-whofound2', 'type' => 'text','name' => "data[pdetails][whofound]")).'</td></tr>';
									echo '<tr><td>Reason of Bug</td><td>'.$this->Form->input('',array('id' => 'bug-reason2',  'type' => 'text','name' => "data[pdetails][bugreason]")).'</td></tr>';

									?>

									<?php
									/* create submit button and close form */
									
									echo '<tr><td><button type="submit" class="btn btn-primary">Submit</button>'.$this->Form->end().'</td><td><td></tr>';
									?>
					</table></div></center>


                </div>
              
              
            </div>
        </div>
    </div>



  



<!-- Button to trigger modal -->


<script>

function handleClick(cb) {
	if(cb.checked == true)
		var read = false
	else
		var read = true
	$("#bug-desc").prop("readonly", read);
	$("#bug-steps").prop("readonly", read);
	$("#bug-statafter").prop("readonly", read);
	$("#bug-whofound").prop("readonly", read);
	$("#bug-stat").prop("readonly", read);
	$("#bug-reason").prop("readonly", read);
}

function showBugList(ischecked)
{
	var issue = $('#issueid-bug').val();


	$('#lala').append("<tr><center><th>Bug Description</th><th>Steps on how bug is produced</th><th>Status	</th><th>Status after fix	</th><th>Who found the bug</th><th>Reason of Bug</th><th colspan='2'>Action</th></center></tr>");

	$.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/viewBugInfo',
	            data: { issueId : issue },
	            dataType: 'json', 
	            
	            success: function(rows){

	            	var data = {};
				    var dates = [];
				    $.each(rows, function () {
				        console.log(this.issue_id);
				        $('#lala').append("<tr><td>"+this.bug_description+"</td><td>"+this.bug_steps+"</td><td>"+this.bug_status+"</td><td>"+this.status_after+"</td><td>"+this.who_found+"</td><td>"+this.bug_reason+'</td><td><input type="button" class="btn btn-primary" value="EDIT" onclick="editBug('+"'"+this.id+"'"+')"></td><td><input type="button" class="btn btn-primary" value="DELETE" onclick="deleteBug('+"'"+this.id+"'"+')"></td></tr>')

				    });
	            	

				    $('#div-bugs').show();
				    $('#addBugInfo').hide();
	               
	            },
	            error: function(data){
	        }
	       });

}
function editBug(bugId)
{
	$('#div-bugs').hide();
	$('#addBugInfo').hide();
	$('#addBugInfo2').show();
	$.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/editBugInfo',
	            data: { bugId : bugId },
	            dataType: 'json', 
	            
	            success: function(rows){



	            	var data = {};
				    var dates = [];
				    $.each(rows, function () {

				        console.log(this.issue_id);
				        $("#bug-id2").val(this.id);
				        $("#bug-desc2").val(this.bug_description);
						$("#bug-steps2").val(this.bug_steps);
						$("#bug-statafter2").val(this.status_after);
						$("#bug-whofound2").val(this.who_found);
						$("#bug-stat2").val(this.bug_status);
						$("#bug-reason2").val(this.bug_reason);
				    });
	            	

	         //    window.location.href='http://localhost/pviewer/pdetails/index/1';
	               
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });


}
function checkBugInfo(issueId)
{
	
	$('#issueid-bug').val(issueId);

	$('#addBugInfo').show();
	$('#addBugInfo2').hide();
	$('#div-bugs').hide();

	$( "#show-all" ).prop( "checked", false );

	$('#lala').empty();	


	$("#myModal4").modal('show');
}
function changeBgcolor(label,removeBg)
{

	var removeLabel = label.replace('label', '' );

	$('#specsid').val(removeLabel);
	var genIssue = $('#general-issueid').val();
	$('#'+label).css("background-color","#3498db");

	$('#table-resultsmodified').empty();
	$('#table-resultsreleased').empty();
	if(removeLabel == 2)
		viewModifiedRelease(genIssue,'modified');
	if(removeLabel == 3)
		viewModifiedRelease(genIssue,'released')




	var count = removeBg.split('-');
	for (var i = 0; i < count.length; i++) {
		$('#label'+count[i]).css("background-color","#2c3e50");	
	};
}



function deleteBug(bugId)
{
	 if(confirm("Are you sure?"))
   	 {
   	 	$.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/deleteBugInfo',
	            data: { bugId : bugId },
	            dataType: 'json', 
	            
	            success: function(rows){
	            	alert('Bug Deleted');
	            },
	            error: function(data){
	        }
	       });
   	 }	
   
	
}
function viewIssueDetails(id)
{



	$('#php1').empty();
	$('#html1').empty();
	$('#links1').empty();
	$('#php4').empty();
	$('#html4').empty();

	$.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/getIssueFiles',
	            data: { issueid : id }, 
	            
	            success: function(data){



	            	var implodeRow = data.split('@');

	            	for(var j=0;j<implodeRow.length;j++)
	            	{
	            		var implodeSpecs = implodeRow[j].split('|');
	            		var file = implodeSpecs[0];
	            		var specsId = implodeSpecs[1];
	            		var type = implodeSpecs[2];
	            		var id = implodeSpecs[3];
	            		var extension = file.substr( (file.lastIndexOf('.') +1) );

	            		if(type == 'file')
	            			var appendVal = "<a href='/pviewer/pdetails/downloadFile?id="+id+"'>"+file+"</a><br />"
	            		else
	            			var appendVal = file+'<br />';

	            		if(specsId == 1)
	            		{	
	            			if((extension == 'php') && (type == 'file' || type == 'link'))
	            			$('#php1').append(appendVal);
	            			else if((extension == 'html') && (type == 'file' || type == 'link'))
	            			$('#html1').append(appendVal);
	            			else
	            			$('#links1').append(appendVal);	
	            		}
	            		else
	            		{
	            			if(extension == 'php')

	            			$('#php4').append(appendVal);
	            			else
	            			$('#html4').append(appendVal);
	            		}

	            	}
              
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });
	$('#issue-details').html('.');
	$('#general-issueid').val(id);
	$('#issueid').val(id);
	$('#issueid2').val(id);
	$('#issueid3').val(id);
	$('#issueid4').val(id);
	$('#issueid2v1').val(id);
	$('#issueid1v1').val(id);
	$("#myModal3").modal('show');
	
}
function toggleDate(counter)
{
	$('#'+counter).toggle();;
}
function viewModifiedRelease(genIssue,type)
{

		   $.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/getModifiedFiles',
	            data: { issueId : genIssue, type: type }, 
	            dataType: 'json',
	            success: function(rows){
	            	console.log(rows);
	            	var data = {};
				    var dates = [];
				    $.each(rows, function () {
				        if (typeof data[this.date] == "undefined")
				        {
				            data[this.date] = [];
				        }
				        data[this.date].push(this);
				        if (dates.indexOf(this.date) == -1)
				        {
				            dates.push(this.date);
				        }
				    });
				    dates = dates.sort();
				    var counter = 0;
				    var table = $('#table-results'+type);
				    $.each(dates, function () {
				   // 	alert('dd');
				    	counter++;
				        table.append(
				            $("<tr id='tableRow"+counter+"'>").append('<td><div style="text-decoration: underline;font-weight:bold" onclick = "toggleDate('+"'divCounter"+counter+"'"+')">'+"<< &nbsp;"+this+'<br /></div></td>')
				        );
				        table.append(
				        $("<tr>").append("<div style='display:none' id='divCounter"+counter+"'> </div>")
				        );
				        
				        data[this] = data[this].sort(function (a, b) {
				            return a.file > b.file;
				        });


				        
				        $.each(data[this], function () {
				        	 console.log(this);
				        //	console.log(this.file);
				            $("#divCounter"+counter).append(
				                $("<tr>").append(
				                    $("<td>").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+this.file)
				                )
				            );
				        });
				    });

	        
	               
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });
}
function backFunction()
{
	$("#divEdit").hide();
	$('#table-legend').show();
}
function editDeleteLegend(func,status,status_id)
{

			var hideStatus = $('#hide-status').val();

			var implodeStat = hideStatus.split('|');


			var ifStatIsSelected = jQuery.inArray(status_id, implodeStat);
		
			if(ifStatIsSelected < 0)
			{
	            $.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/'+func,
	            data: { status : status }, 
	            
	            success: function(data){

	             window.location.href='http://localhost/pviewer/pdetails/index/1';
	               
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });
	        	}
	        else
	        {
	        	alert('Status cannot be deleted');
	        }
}
function editLegend(func)
{


	 var statusOld = $('#edit-hidden').val();
	 var statusNew = $('#edit-status').val();

	 if(statusNew == '')
	 {
	 	alert('Status Field should not be empty!');
	 }
	 else
	 {


		 $.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/'+func,
	            data: { 
	            	statusOld : statusOld,
	            	statusNew : statusNew
	             }, 
	            
	            success: function(data){
	            	
	            //	alert(data);
	            	if(data == 0)
	            	alert('Status already exist');
	            	else
	             window.location.href='http://localhost/pviewer/pdetails/index/1';
	               
	            },
	            error: function(data){
	             window.location.href='http://localhost/pviewer/pdetails/index/1';
	            //cannot connect to server
	        }
	       });
	}
}
function showEdit(status)
{
	//alert($('#divEdit').text());
		$("#divEdit").show();
		$('#edit-status').val(status);
		$('#edit-hidden').val(status);	
		$('#table-legend').hide();
}
function insertLegend(func)
{
	var newStatus = $('#legend-add').val();
	var colorStatus =  $('#color-pick').val();


	var hideColor = $('#hide-color').val();
	var implodeColor = hideColor.split('|');


	var ifStatIsSelected = jQuery.inArray(colorStatus, implodeColor);


	if(newStatus == '')
		alert('Status field should not be empty');
	else if(ifStatIsSelected > 0)
	{
		alert('Please choose another color');	
	}
	else
	{
		 $.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/'+func,
	            data: { 
	            	newStatus : newStatus,
	            	colorStatus :colorStatus
	             }, 
	            
	            success: function(data){


	             if(data == 1)
	             {
	             alert('Status Added');
	             window.location.href='http://localhost/pviewer/pdetails/index/1';
	         	 }
	         	 else
	         	 	alert('Status Already Exist');
	               
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });
	}	
}


$(document).ready(function(){



	 $('#tab-click tr').on('click', function(e) {
        
        // The below "if" condition is the ANSWER.
        if (!$(e.target).closest('.sub-menu').length) {
             var id = $(this).attr('id');
      		 viewIssueDetails(id);	
        }
        
    });

	$('#picker').colpick();
	$(".btn-setting").click(function(){
		$("#myModal").modal('show');
	});


	$("#add").click(function(){
       	
		 $('#info').append('<input id="pdetailsFile" type="file" multiple="multiple" name="data[pdetails][file][]">');
 
    });
    $("#add2").click(function(){
       	
		 $('#info2').append('<input id="pdetailsFile" type="file" multiple="multiple" name="data[pdetails][file][]">');
 
    });

    $("#add3").click(function(){
       	
		 $('#info3').append('<input id="pdetailsFile" type="file" multiple="multiple" name="data[pdetails][file][]">');
 
    });
    $("#add4").click(function(){
       	
		 $('#info4').append('<input id="pdetailsFile" type="file" multiple="multiple" name="data[pdetails][file][]">');
 
    }); 

    $("#add2v1").click(function(){
       	
		 $('#info2v1').append('<input id="pdetailsText" type="text"  name="data[pdetails][text][]">');
 
    });
    $("#add1v1").click(function(){
       	
		 $('#info1v1').append('<input id="pdetailsText" type="text"  name="data[pdetails][text][]">');
 
    });
	
	$("#radio-legend").click(function(){
		$('#add-legend').show();
	});

	$('.color-box').colpick({

		colorScheme:'dark',
		layout:'rgbhex',
		color:'ff8800',
		onSubmit:function(hsb,hex,rgb,el) {
			
			$(el).css('background-color', '#'+hex);
			$(el).colpickHide();

			var val = $(el).text();
			var bcolor = '#'+hex;
			$.ajax({
				type: "POST",
				url: "pdetails/",
				data: { 'changeColor' : val, 'color': bcolor},
				success: function (data) {
					//alert(val+'|'+bcolor);
					location.reload();
				}
			});
	
		}
	});


	
	
});




</script>
