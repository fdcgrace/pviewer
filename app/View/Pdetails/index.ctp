<section class="container-fluid" id="content">

	<h3>Project Detail</h3>
	<div class="row mt">
		<div class="col-md-6">

			<?php 
				date_default_timezone_set("Asia/Manila"); 
			$todayDate = date("Y-m-d"); 
			$baseUrl= Router::url('/', true);
				echo $this->Html->link(__('Create New Issue'), array('action' => 'add',1), array('class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#addForm'));
			?>

		</div>
		<div class="col-md-6" style="text-align:right;">
				Legend: 
				<span class="label color-box" style="background-color:#FF1919;?>"  id="1">
					For Testing
				</span>
				<span class="label color-box" style="background-color:#FFA3D1;?>"  id="1">
					In Progress
				</span>
				<span class="label color-box" style="background-color:#A3FFA3;?>"  id="1">
					Released
				</span>
				<span class="label color-box" style="background-color:#666699;?>"  id="1">
					For Release
				</span>
				<span class="label color-box" style="background-color:#CC33FF;?>"  id="1">
					Pending
				</span>
			<a href="#" class="btn-setting"><img class='legend-modal' src='http://localhost/pviewer-layout/img/setting.png' style='width:18px;height=18px'></a>
		</div>

	</div>	
	<hr>
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading" style="background:#FF1919;color:#FFF;">
					<h4><i class="fa fa-angle-right"></i> For Testing</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-advance table-hover table-responsive" id='tab-click'>
						<thead>
							<th>PID</th>
							<th>Deadline</th>
							<th>Issue Number</th>
							<th>Task Description</th>
							<th>Assignee</th>
							<th>Issue Link</th>
							<th>Status</th>
							<th>Priority</th>	
							<th>Progress</th>
							<th class="actions">Actions</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>2015-08-06</td>
								<td>7875</td>
								<td>Pagination</td>
								<td>
									<select>
										<option>Please Select</option>
									</select>
								</td>
								<td><a>http://redmine.vjsol.jp/issues/7874</a></td>
								<td>
									<select>
										<option>Please Select</option>
									</select>
								</td>
								<td>
									<div class="input select">
										<div class="br-wrapper br-theme-bars-pill">
											<select class="example-pill" style="display: none;" default="default">
												<option>Lowest</option>
												<option>Medium</option>
												<option>Highest</option>
											</select>
										</div>
									</div>
								</td>
								<td>
									<div class="input select">
										<div class="br-wrapper br-theme-bars-1to10">
											<select class="example-1to10" style="display: none;">
												<option>0</option>
												<option>10</option>
												<option>20</option>
												<option>30</option>
												<option>40</option>
												<option>50</option>
												<option>60</option>
												<option>70</option>
												<option>80</option>
												<option>90</option>
												<option>100</option>
											</select>
										</div>
									</div>
								</td>
								<td>
									<?php echo $this->Html->link(__(''), array('controller' => 'pdetails', 'action' => 'index', 1), array('class' => 'glyphicon glyphicon-floppy-disk', 'style' => 'color:#FF1919')); ?>
									<?php echo $this->Html->link(__(''), array('action' => 'edit', 1), array('data-toggle' => 'modal', 'data-target' => '#editProj', 'class' => 'glyphicon glyphicon-pencil', 'style' => 'color:#FF1919')); ?>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', 1), array('confirm' => __('Are you sure you want to delete # %s?', 1), 'class' => 'glyphicon glyphicon-trash', 'style' => 'color:#FF1919')); ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
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

