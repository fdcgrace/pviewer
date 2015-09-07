<div id="myModal3" class="modal fade">
	<?php
	date_default_timezone_set("Asia/Manila"); 
     				$todayDate = date("Y-m-d"); 
	?>
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
			            <input type='hidden' id='general-issueid'>
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
							?><br />
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
								?><br />
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
								<div id= 'right-column21'></div>
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
								<div id= 'right-column31'></div>
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
			<div id='issue-details'></div>
			</div>
    	</div>
	</div>
</div>