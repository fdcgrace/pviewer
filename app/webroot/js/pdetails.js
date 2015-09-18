$(document).ready(function(){
	 $('#tab-click').on('click', function(e) {
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
					location.reload();
				}
			});
		}
	});

	function loader(){
		var path = baseUrl+'/app/webroot/img/loading.gif';
  		$('.table-responsive').css('text-align','center');
	  	$('.table-responsive').html('<img id="loader-img" alt="" src="'+path+'" width="100"/>');
	  	setTimeout(hide, 10000);  // 10 seconds
	  	var hide = function(){
		    $('.table-responsive').style.display = "none";
		}
  	}
  	$(function(){ 
		var currDate = $("#selectedDate").val();
		if (currDate == '') {
			currDate = $("#datepicker").val();
		} else {
			currDate = currDate;
		}
		$("#datepicker").datepicker({
			dateFormat : 'yy-mm-dd',
		    defaultDate: currDate
		});
	  	var projID = $(".table-responsive").attr('id');
	  	loader();
	    	$.ajax({
				type: "POST",
				url: baseUrl+"/pdetails/issue/",
				data: { 'getDate' : currDate, 'projID' : projID},
				success: function (data) {
					$(".table-responsive").html(data);
					//$("#selected").val(currDate);
				}
			});
    });

  	$("#view-all").on("click", function() {
	  	var projID = $(".table-responsive").attr('id');
  		$.ajax({
				type: "POST",
				url: baseUrl+"/pdetails/issue/",
				data: {'projID' : projID},
				success: function (data) {
					$(".table-responsive").html(data);
				}
			});
  	});

  	$("#copy-all").on("click", function() {
  		var projID = $(".table-responsive").attr('id');
  		var today = $.datepicker.formatDate('yy-mm-dd', new Date());
    	var currDate = $("#datepicker").val();
  		$.ajax({
				type: "POST",
				url: baseUrl+"/pdetails/copy/",
				data: {'projID' : projID, 'today': today, 'currDate': currDate},
				success: function (data) {
					// $(".table-responsive").html(data);
					// $("#datepicker").val(today);
					location.reload();
					$(".alert-success").show();
				},
				error: function(data) {
					location.reload();
					$(".alert-danger").show();	
				}
			});

  	});
  	
	$("#datepicker").on("change", function () {
        var currDate = $(this).val();
        var projID = $(".table-responsive").attr('id');
        loader();

        $.ajax({
			type: "POST",
			url: baseUrl+"/pdetails/",
			data: { 'getDate' : currDate, 'projID' : projID},
			success: function (data) {
				//$(".table-responsive").html(data);
				//$("#selected").val(currDate);
			}
		});

    	$.ajax({
			type: "POST",
			url: baseUrl+"/pdetails/issue/",
			data: { 'getDate' : currDate, 'projID' : projID},
			success: function (data) {
				$(".table-responsive").html(data);
				$("#selected").val(currDate);
			}
		});
		display();
    });	

    var display = function (callback) {
    	var today = $.datepicker.formatDate('yy-mm-dd', new Date());
    	var currDate = $("#datepicker").val();
		if(currDate < today) {
			$("#copy-all").show();
		} else {
			$("#copy-all").hide();
		}
    }
});

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

function showBugList(ischecked){
	var issue = $('#issueid-bug').val();

	$('#tbody-bug').append("<tr><center><th>Bug Description</th><th>Steps on how bug is produced</th><th>Status	</th><th>Status after fix	</th><th>Who found the bug</th><th>Reason of Bug</th><th colspan='2'>Action</th></center></tr>");

	$.ajax({
            type: "POST",
            url: baseUrl+'/pdetails/viewBugInfo',
            data: { issueId : issue },
            dataType: 'json', 
            
            success: function(rows){
            	var data = {};
			    var dates = [];
			    $.each(rows, function () {
			        console.log(this.issue_id);
			        $('#tbody-bug').append("<tr><td>"+this.bug_description+"</td><td>"+this.bug_steps+"</td><td>"+this.bug_status+"</td><td>"+this.status_after+"</td><td>"+this.who_found+"</td><td>"+this.bug_reason+'</td><td><div onclick="editBug('+"'"+this.id+"'"+')"><span class="glyphicon glyphicon-pencil"></span></div></td><td><div  onclick="deleteBug('+"'"+this.id+"'"+')"><span class="glyphicon glyphicon-trash"></span></div></td></tr>')
			    });
            	
			    $('#div-bugs').show();
			    $('#addBugInfo').hide();
            },
            error: function(data){
        }
       });

}
function editBug(bugId){
	$('#div-bugs').hide();
	$('#addBugInfo').hide();
	$('#addBugInfo2').show();
	$.ajax({
            type: "POST",
            url: baseUrl+'/pdetails/editBugInfo',
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
            },
            error: function(data){
            	//cannot connect to server
        	}
       });
}
function checkBugInfo(issueId){
	$('#issueid-bug').val(issueId);
	$('#addBugInfo').show();
	$('#addBugInfo2').hide();
	$('#div-bugs').hide();
	$( "#show-all" ).prop( "checked", false );
	$('#tbody-bug').empty();	
	$("#myModal4").modal('show');
}
function changeBgcolor(label,removeBg){

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

function deleteBug(bugId){
	if(confirm("Are you sure?")){
   	 	$.ajax({
	            type: "POST",
	            url: baseUrl+'/pdetails/deleteBugInfo',
	            data: { bugId : bugId },
	            dataType: 'json', 
	            
	            success: function(rows){
	            	     alert('Bug Deleted');
	            		 location.reload();
	            },
	            error: function(data){
	        }
	       });
   	 }	
}

function viewIssueDetails(id){
	$('#php1').empty();
	$('#html1').empty();
	$('#links1').empty();
	$('#php4').empty();
	$('#html4').empty();

	$.ajax({
            type: "POST",
            url: baseUrl+'/pdetails/getIssueFiles',
            data: { issueid : id }, 
            
            success: function(data){
            	var implodeRow = data.split('@');

            	for(var j=0;j<implodeRow.length;j++){
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

            		if(specsId == 1) {	
            			if((extension == 'php') && (type == 'file' || type == 'link'))
            			$('#php1').append(appendVal);
            			else if((extension == 'html') && (type == 'file' || type == 'link'))
            			$('#html1').append(appendVal);
            			else
            			$('#links1').append(appendVal);	
            		} else {
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

function toggleDate(counter){
	$('#'+counter).toggle();;
}

function viewModifiedRelease(genIssue,type){
   $.ajax({
        type: "POST",
        url: baseUrl+'/pdetails/getModifiedFiles',
        data: { issueId : genIssue, type: type }, 
        dataType: 'json',
        success: function(rows){
        	console.log(rows);
        	var data = {};
		    var dates = [];
		    $.each(rows, function () {
		        if (typeof data[this.date] == "undefined"){
		            data[this.date] = [];
		        }
		        data[this.date].push(this);
		        if (dates.indexOf(this.date) == -1){
		            dates.push(this.date);
		        }
		    });
		    dates = dates.sort();
		    var counter = 0;
		    var table = $('#table-results'+type);
		    $.each(dates, function () {

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
function backFunction() {
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
	            url: baseUrl+'/pdetails/'+func,
	            data: { status : status }, 
	            
	            success: function(data){

	               location.reload();
	               
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
	            url: baseUrl+'/pdetails/'+func,
	            data: { 
	            	statusOld : statusOld,
	            	statusNew : statusNew
	             }, 
	            
	            success: function(data){
	            	
	            
	            	if(data == 0)
	            	alert('Status already exist');
	            	else
	                 location.reload();
	               
	            },
	            error: function(xhr, textStatus, error){
			      console.log(xhr.statusText);
			      console.log(textStatus);
			      console.log(error);
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
	            url: baseUrl+'/pdetails/'+func,
	            data: { 
	            	newStatus : newStatus,
	            	colorStatus :colorStatus
	             }, 
	            
	            success: function(data){


	             if(data == 1)
	             {
	             alert('Status Added');
	              location.reload();
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


