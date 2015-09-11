
<section class="container-fluid" id="content">
	<div class="alert alert-success" style="display:none">
		<strong>Success!</strong> Issues success
	</div>
	<h3>Project Detail</h3>
	<hr>







	<p>To view issues, select date from Calendar. Issue is shown by date and grouped by status.</p>
	<div id="datepicker"></div>
	<div class="row mt">
		<div class="col-md-5">
			<div style="float:left; padding-right:10px;">
				<?php echo $this->Html->tag('span',__('View All Issues'), array('class' => 'btn btn-info', 'id' => 'view-all'));?>
			</div>
			<div style="float:left;">
				<?php echo $this->Html->tag('span',__('Copy to Current Date'),array('class' => 'btn btn-primary', 'id' => 'copy-all', 'style' => 'display:none'));?>
			</div>
			<?php 
				date_default_timezone_set("Asia/Manila"); 
				$todayDate = date("Y-m-d"); 
				$baseUrl= Router::url('/', true);
				//echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary'));
				//echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
			?>
		</div>
		<div class="col-md-7" style="text-align:right;">
			Legend: 
			<?php
				$statusArray= array();
				$colorArray = array();
				$selectedStatus = array();
				foreach ($legendStatusId as $statusId => $status) {
					$statusArray[] = $status;
				}

				foreach ($legendColor as $key => $value): ?>
					<span class="label color-box" style="background-color:<?php echo $key;?>"  id="<?php echo $key;?>">
						<?php 
							$colorArray[] = $key;
							$selectedStatus[] = $value;
							echo $value;
						?>
					</span> &nbsp;
			<?php endforeach; ?>
			<a href="#" class="btn-setting"><img class='legend-modal' src='<?php echo $baseUrl; ?>img/setting.png' style='width:18px;height=18px'></a>
		</div>
	</div>	
	<hr>
	<div data-example-id="simple-responsive-table" class="bs-example">
	    <div class="table-responsive" id="<?php echo $this->Session->read('project_id');?>">
			
	    </div><!-- /.table-responsive -->
	    <p>
			<?php
				/*echo $this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));*/
			?>	
		</p>
		<div class="paging">
			<?php
				/*echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));*/
			?>
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
                		  //	echo $value['Tblcolor']['color'];
                		  	?>
                		<tr>
                			<td>
								<span class="label color-box2" style="background-color:<?php echo $value['Tblcolor']['color'];?>; z-index: 1022;"  id="<?php echo $value['Tblcolor']['color'];?>"><?php echo $value['Tblcolor']['status'];?></span>
							</td>
							<td> 
								<input type='button' class='btn btn-primary btn-sm' onclick='showEdit("<?php echo $value['Tblcolor']['status']; ?>")' value='EDIT'>
								<input type='button' class='btn btn-primary btn-sm' onclick='if(confirm("Are you Sure?") == true)editDeleteLegend("deleteLegend","<?php echo $value['Tblcolor']['status']; ?>","<?php echo $value['Tblcolor']['status_id']; ?>")' value="DELETE" id='legend-delete'>
							</td>
						</tr>
						<?php endforeach;?>
                	</table>
            	</div>	
            	<div id="divEdit" style="display:none">
            		<div id="back" style='margin-bottom:30px;'>
            			<div onclick='backFunction()'> BACK >> </div>
            		<!-- 	<img class='legend-modal' onclick='backFunction()' src='<?php echo $baseUrl; ?>img/back.png' style='width:18px;height=18px'> -->
            		</div>
            		<input type='text' id='edit-status'>
            		<input type='button' class='btn btn-primary btn-sm' onclick='editLegend("editLegend");' value="SAVE" id='legend-edit'>
            		<input type='hidden' id='edit-hidden'>
            	</div>






            </div>
        </div>
    </div>
</div>
<?php echo $this->element('pdetailsIssueSpecs'); ?> <!--Issue Specs Page -->

<?php echo $this->element('pdetailsBugInfo'); ?> <!--Bug Info Page -->

<?php echo $this->Html->script(array('pdetails')); ?> <!--js -->
