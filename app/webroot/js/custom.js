$(function() {
	var team="";
	var project="";

	//enable|disable picker for project	
	window.checkTeam = function () {
		if($("#team").val() != "") {
			var value = $("#team").val();
			$("#team_project").removeAttr("disabled");
			$("#team_project option.issue").each(function() {
				if($(this).attr("id") != value){
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		} else {
			$("#team_project").attr("disabled", "disabled");
			$("#team_project").val("");
		}
	}

	window.checkProject = function () {
		if($("#team_project").val() != "") {
			getTeam(function() {
				getProject(function() {
					setSortable();
				});
			});	
		} else {
			if ($("#team_content:visible").length > 0) {
				$("#team_content").remove();
			}
			if ($("#project_content:visible").length > 0) {
				$("#project_content").remove();
			}
		}
	}

	$("#team").change(function() {
		checkTeam();
		team = $(this).val();
	});
	//get team and project
	$("#team_project").change(function() {
		checkProject();
		project = $(this).val();
	});

	function getTeam(callback) {
		var content;
		$.ajax({
			url: "/pviewer/Teams/team/",
			type: "POST",
			data:{
				"team_id": $("#team").val(),
				"project_id": $("#team_project").val()
			},
			success: function(data){
				if ($("#team_content:visible").length > 0) {
					$("#team_content").remove();
				}
				$("#team_body").append(data);
				callback();
			} 
		});
	}

	function getProject(callback) {
		var content;
		$.ajax({
			url: "/pviewer/Teams/project/",
			type: "POST",
			data:{
				"project_id": $("#team_project").val()
			},
			success: function(data) {
				if ($("#project_content:visible").length > 0) {
					$("#project_content").remove();
				}
				$("#project_body").append(data);
				callback();
			} 
		});
	}

	function setSortable() {
		$("tr.info").each(function() {
			if($(this).attr('data') != 0) {
				$(this).addClass("notSortable");
			}else {
				$(this).attr("onmouseover", "");
				$(this).attr("style", "cursor:move");
			} 
		});

		$("tr.success").each(function() {
			$(this).attr("onmouseover", "");
			$(this).attr("style", "cursor:move");
		});

		/*$("td").each(function() {
	        $(this).css('width', $(this).width() +'px').css('height', $(this).height() +'px');
	    });*/

		if($("#team_content:visible").length > 0 && $("#project_content:visible").length > 0) {
			$("#team_issue tbody").sortable({
				connectWith: "#project_table tbody, #team_issue tbody",
				revert: true,
				items:"tr:not(.notSortable)",
				helper: function(e, ui) {
					var original = ui.children();
					var clone = ui.clone();
					clone.children().each(function(index) {
						$(this).width(original.eq(index).width());
					})
					return clone;
				},
				receive: function(e, ui) {
					$.ajax({
						url:"/pviewer/Teams/update/",
						type:"POST",
						data:{
							"team_id":$(this).attr('team'), 
							"member_id":$(this).attr('member'),
							"issue_id":ui.item.attr('id'),
							"status":ui.item.attr('data')
						}
					});
					// ui.item.clone();
				}
			}).disableSelection();

			$("#project_table tbody").sortable({
				connectWith: "#team_issue tbody",
				revert: true,
				items:"tr:not(.notSortable)",
				helper: function(e, ui) {
					var original = ui.children();
					var clone = ui.clone();
					clone.children().each(function(index) {
						$(this).width(original.eq(index).width());
					})
					return clone;
				},
				receive: function(e, ui) {
					$.ajax({
						url:"/pviewer/Teams/update/",
						type:"POST",
						data:{
							"team_id":$(this).attr('team'),
							"issue_id":ui.item.attr('id'),
							"status":ui.item.attr('data')
						}
					});
					// ui.item.clone();
				}
			}).disableSelection();
		}
	}
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


	$('#lala').append("<tr><th>Bug Description</th><th>Steps on how bug is produced</th><th>Status	</th><th>Status after fix	</th><th>Who found the bug</th><th>Reason of Bug</th></tr>");

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

				     /*   $("#bug-desc").val(this.bug_description);
						$("#bug-steps").val(this.bug_steps);
						$("#bug-statafter").val(this.status_after);
						$("#bug-whofound").val(this.who_found);
						$("#bug-stat").val(this.bug_status);
						$("#bug-reason").val(this.bug_reason);*/
				    });
	            	

				    $('#div-bugs').show();
				    $('#addBugInfo').hide();
	         //    window.location.href='http://localhost/pviewer/pdetails/index/1';
	               
	            },
	            error: function(data){
	            //cannot connect to server
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

	if(removeLabel == 2)
		viewModified(genIssue);


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

	            		if(type == 'file')
	            			var appendVal = "<a href='/pviewer/pdetails/downloadFile?id="+id+"'>"+file+"</a><br />"
	            		else
	            			var appendVal = file+'<br />';
	            	//	alert(extension);

	            		if(specsId == 1)
	            		{	
	            			if((extension == 'php') && (type == 'file' || type == 'link'))
	            			$('#php1').append(appendVal);
	            			else if((extension == 'html') && (type == 'file' || type == 'link'))
	            			$('#html1').append(appendVal);
	            			else
	            			$('#links1').append(appendVal);	
	            		}
	            		else if(specsId == 2)
	            		{
	            			if((extension == 'php')  && (type == 'file' || type == 'link'))
	            			$('#php2').append(appendVal);
	            			else if(( extension == 'html') && (type == 'file' || type == 'link'))
	            			$('#html2').append(appendVal);
	            			else
	            			$('#links2').append(appendVal);	
	            		}
	            		else if(specsId == 3)
	            		{
	            			if(extension == 'php')

	            			$('#php3').append(appendVal);
	            			else
	            			$('#html3').append(appendVal);
	            		}	
	            		else
	            		{
	            			if(extension == 'php')

	            			$('#php4').append(appendVal);
	            			else
	            			$('#html4').append(appendVal);
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
function viewModified(genIssue)
{
	$('#table-results').empty();
		   $.ajax({
	            type: "POST",
	            url: 'http://localhost/pviewer/pdetails/getModifiedFiles',
	            data: { issueId : genIssue }, 
	            dataType: 'json',
	            success: function(rows){
	            	//console.log(rows);
	            	var data = {};
				    var dates = [];
				    $.each(rows, function () {
				        if (typeof data[this.date_modified] == "undefined")
				        {
				            data[this.date_modified] = [];
				        }
				        data[this.date_modified].push(this);
				        if (dates.indexOf(this.date_modified) == -1)
				        {
				            dates.push(this.date_modified);
				        }
				    });
				    dates = dates.sort();
				    var counter = 0;
				    var table = $('#table-results');
				    $.each(dates, function () {
				   // 	alert('dd');
				    	counter++;
				        table.append(
				            $("<tr id='tableRow"+counter+"'>").append('<td><div style="text-decoration: underline;font-weight:bold" onclick = "toggleDate('+"'divCounter"+counter+"'"+')">'+"<<"+this+'</div></td>')
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
				                    $("<td>").html(this.file)
				                ).append(
				                    $("<th>").html(this.id)
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
});