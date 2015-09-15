

<div id="myModal4" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" max-width=>
            <div class="modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Bug Info</h4>
            </div>
            <div class="modal-body">
               <div id='div-bugs'  style='display:none' > 
               <div class="scroll">
                        <table id='table-bug' style='width:130%;height:140px' >
                            <tbody id='tbody-bug'>
                                <tr>
                                    <th>Bug Description </th>
                                    <th>Stepds on how bug is produced</th>
                                    <th>Status </th>
                                    <th>Status after fix    </th>
                                    <th>Who found the bug</th>
                                    <th>Reason of Bug</th>
                                    <th colspan='2'>ACtion</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div id='addBugInfo'>
                       <table class='table table-hovered table-striped'>
                            <tr>
                                <td>
                                    <label><input type='checkbox' id='show-all' onclick='showBugList(this);'>Show all bugs</label>
                                </td>
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

                                /* create submit button and close form */
                                echo '<tr><td class="fright"><button type="submit" class="btn btn-primary">Submit</button>'.$this->Form->end().'</td><td><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button><td></tr>';
                            ?>
                        </table>
                    </div>
                </center>
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
                            /* create submit button and close form */
                            echo '<tr><td class="fright"><button type="submit" class="btn btn-primary">Submit</button>'.$this->Form->end().'</td><td><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button><td></tr>';
                            ?>
                       </table>
                    </div>
            </div>
        
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
</script>

