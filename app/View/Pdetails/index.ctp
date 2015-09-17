<?php
	date_default_timezone_set("Asia/Manila"); 
	$todayDate = date("Y-m-d"); 
	$baseUrl= Router::url('/', true);
	$mod = 2;

	$statusArray= array();
	$colorArray = array();
	$selectedStatus = array();
	foreach ($legendStatusId as $statusId => $status) {
		$statusArray[] = $status;
	}
?>
<section class="container-fluid" id="content">
	<div class="alert alert-success" style="display:none">
		<strong>Success!</strong> Issues success
	</div>
	<h3>Project Detail
	</h3>
	<hr>

	<p>To view issues, select date from Calendar. Issue is shown by date and grouped by status.</p>
	<div class="row">
	  <div class="col-md-8">
	  	<div id="datepicker"></div>
	  	<div style="float:left; padding-right:10px; margin: 10px 0 0 0 ">
			<?php echo $this->Html->tag('span',__('View All Issues'), array('class' => 'btn btn-info', 'id' => 'view-all'));?>
		</div>
		<div style="float:left; padding-right:10px; margin: 10px 0 0 0 ">
			<?php echo $this->Html->tag('span',__('Copy to Current Date'),array('class' => 'btn btn-primary', 'id' => 'copy-all', 'style' => 'display:none'));?>
		</div>
	  </div>
	  <div class="col-md-4">
	  	<table class="table table-condensed">
			<tbody>
			<tr><td colspan="<?php echo $mod; ?>" class="fleft">Legend: <a href="#" class="btn-setting"><img class='legend-modal' src='<?php echo $baseUrl; ?>img/setting.png' style='width:18px;height=18px'></a></td></tr>
			<tr>
			   <?php 
			   $i = 0;
			   foreach ($legendColor as $key => $value) {
			      if ($i % $mod === 0) {
			            echo '</tr><tr>';
			        }
			      $background = "<div class='legend' style='background-color: $key;'></div>";
			      $value = "<span class='fleft'>$value</span>";
			      echo "<td class='padd' > $background" . $value . "</td>";
			      $i++;
			   }
			   ?>
			</tr>
			</tbody>
		</table>
	  </div>
	</div>	
	
	<hr>

	<div data-example-id="simple-responsive-table" class="bs-example">
	    <div style="border:none;" class="table-responsive " id="<?php echo $this->Session->read('project_id');?>">
			
	    </div><!-- /.table-responsive -->
	    <p>
		</p>
		<div class="paging">
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
            	<center>
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

                					<input type="text" id="legend-add" style='float:left' >
                					 <div class="colorpicker-component demo demo-auto">
					                    <input type="hidden" value="#ffffff" id='color-pick'/>
					                    <input type='text' class='input-group-addon' style="height:24px;">
					                 </div>
                					<input type='button' class='btn btn-primary btn-sm' style='float:left' onclick='insertLegend("insertLegend");' value="ADD" >
                				</div>
                			</td>
                		</tr>
                		<?php
                		  foreach ($legendColorModal as $value): 
                		  	?>
                		<tr>
                			<td>
								<div class="label color-box2" style="background-color:<?php echo $value['Tblcolor']['color'];?>; z-index: 1022;"  id="<?php echo $value['Tblcolor']['color'];?>"><?php echo $value['Tblcolor']['status'];?></div>
							</td>
							<td> 
							
									
								<button id="btn1" type="button" onclick='showEdit("<?php echo $value['Tblcolor']['status']; ?>")'>
							    <span class="glyphicon glyphicon-pencil"></span>
								</button>

								<button onclick='if(confirm("Are you Sure?") == true)editDeleteLegend("deleteLegend","<?php echo $value['Tblcolor']['status']; ?>","<?php echo $value['Tblcolor']['status_id']; ?>")'id='legend-delete'>
							    <span class="glyphicon glyphicon-trash"></span>
								</button>

								
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


            </center>




            </div>
        </div>
    </div>
</div>

<?php echo $this->element('pdetailsIssueSpecs'); ?> <!--Issue Specs Page -->

<?php echo $this->element('pdetailsBugInfo'); ?> <!--Bug Info Page -->

<?php echo $this->Html->script(array('pdetails')); ?> <!--js -->

