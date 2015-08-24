

<div class="container-fluid">
	<h3>Project Detail</h3>
	<div class="row">
		<div class="col-md-8">
			<?php 
			$baseUrl= Router::url('/', true);
			echo $this->Html->link(__('Project List'), array('controller' => 'Projects', 'action' => 'index'), array('class' => 'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Create New Issue'), array('action' => 'add', $p_id), array('class' => 'btn btn-success')); ?>
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
									<th>Created Date</th>
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
								); ?>
							</div>
							</td>
							<td><?php echo h($Pdetail['Pdetail']['created']); ?></td>
							<td><?php echo h($Pdetail['Pdetail']['modified']); ?></td>
							<td class="actions">
								 <div class="pull-right sub-menu">
								<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $Pdetail['Pdetail']['id']));?>
								<?php echo $this->Form->submit(__('Update Status'), array('class' => 'btn btn-primary btn-xs'),array('action' => 'index')); ?>
								<?php //echo $this->Html->link(__('View'), array('action' => 'view', $Pdetail['Pdetail']['id'])); ?>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Pdetail['Pdetail']['id']), array('class' => 'btn btn-primary btn-xs')); ?>
								<?php
								

								 echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Pdetail['Pdetail']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $Pdetail['Pdetail']['id']), 'class' => 'btn btn-primary btn-xs')); ?>
							<!-- 	<input type='button' class='btn-primary' value='Details' onclick="viewIssueDetails('<?php echo $detId; ?>')"> -->
								
							</div>
							</td>
							<td>

							</td>
						</tr>
						<?php
							if($Pdetail['Pdetail']['status'] != $break_row)
							{

							echo '

									<tr>
									<th colspan=3><br><br><br><h2>'.$legendStatusId[$break_row].'</h2></th></tr>

									<tr></tr>
									<tr><th>Project ID</th>
									<th>Deadline</th>
									<th>Issue Number</th>
									<th>Task Description</th>
									<th>Assignee</th>
									<th>Issue Link</th>
									<th>Status</th>
									<th>Created Date</th>
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

                					<input type="text" id="legend-add" style='float:left' required>
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
                		<input type='text' id='edit-status' required>
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

							<div id= 'right-column21'>
								<b>PHP FILES</b>
										<div id='php2'></div>
										<br>
										<b>HTML FILES</b>
										<div id='html2'></div><br>
										<b>OTHERS/LINKS</b>
										<div id='links2'></div>
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

							<div id= 'right-column31'>
										<b>PHP FILES</b>
										<div id='php3'></div>
										<b>HTML FILES</b>
										<div id='html3'></div>
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





  

<body>
     
    <!-- Modal -->
   


</body>


<!-- Button to trigger modal -->


<script>
function changeBgcolor(label,removeBg)
{

	var removeLabel = label.replace('label', '' );

	$('#specsid').val(removeLabel);
	$('#'+label).css("background-color","#3498db");

	var count = removeBg.split('-');
	for (var i = 0; i < count.length; i++) {
		$('#label'+count[i]).css("background-color","#2c3e50");	
	};
}
function viewIssueDetails(id)
{
	$('#php1').empty();
	$('#html1').empty();
	$('#links1').empty();

	$('#php2').empty();
	$('#html2').empty();
	$('#links2').empty();

	$('#php3').empty();
	$('#html3').empty();

	$('#php4').empty();
	$('#html4').empty();
	/*$('#right-column21').empty();
	$('#right-column31').empty();
	$('#right-column41').empty();*/

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
	            	//	alert(extension);

	            		if(specsId == 1)
	            		{	
	            			if((extension == 'php') && (type == 'file' || type == 'link'))
	            			$('#php1').append("<a href='/pviewer/pdetails/downloadFile?id="+id+"'>"+file+"</a><br />");
	            			else if((extension == 'html') && (type == 'file' || type == 'link'))
	            			$('#html1').append("<a href='/pviewer/pdetails/downloadFile?id="+id+"'>"+file+"</a><br />");
	            			else
	            			$('#links1').append(file+'<br />');	
	            		}
	            		else if(specsId == 2)
	            		{
	            			if((extension == 'php')  && (type == 'file' || type == 'link'))
	            			$('#php2').append(file+'<br />');
	            			else if(( extension == 'html') && (type == 'file' || type == 'link'))
	            			$('#html2').append(file+'<br />');
	            			else
	            			$('#links2').append(file+'<br />');	
	            		}
	            		else if(specsId == 3)
	            		{
	            			if(extension == 'php')

	            			$('#php3').append(file+'<br />');
	            			else
	            			$('#html3').append(file+'<br />');
	            		}	
	            		else
	            		{
	            			if(extension == 'php')

	            			$('#php4').append(file+'<br />');
	            			else
	            			$('#html4').append(file+'<br />');
	            		}

	            	}
		           /*  var obj = jQuery.parseJSON(data);
		             alert(obj['Issue_spec']);
	                 console.log(obj);
	           		 $.each(obj, function(key, val){ 

	               

	                 var name2 = "'"+val.file+"'";
	                 alert(name2);*/
               

	               
	            },
	            error: function(data){
	            //cannot connect to server
	        }
	       });
	$('#issue-details').html('.');
	$('#issueid').val(id);
	$('#issueid2').val(id);
	$('#issueid3').val(id);
	$('#issueid4').val(id);
	$('#issueid2v1').val(id);
	$('#issueid1v1').val(id);
	$("#myModal3").modal('show');
	
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
	$('.color-box2').colpick({

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
					alert(data);
					//alert(val+'|'+bcolor);
					location.reload();
				}
			});
	
		}
	});

	
	
});




</script>
