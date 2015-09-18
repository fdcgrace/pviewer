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
			//$('#show-results').hide();
			$("#project_content").remove();
			$("#team_content").remove();
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
		$('#team_project').val("");
		var val = $('#team_project').val();
		if(val == '')
			//$('#show-results').hide();
			$("#project_content").remove();
			$("#team_content").remove();
		checkTeam();
		team = $(this).val();
	});
	//get team and project
	$("#team_project").change(function() {
		checkProject();
		project = $(this).val();
	});


	$('#archive').on('change',function(){
			var vals = $(this).val();
			$('#search-val').val(vals);
			$.ajax({
				type: 'POST',
				'url' : vals,
				data:{

				},
				success : function (data){
					$('#div-history').html(data);
				}

			});
				
		})

	$('#search-archive').on('click',function(){
			var vals = $('#search-val').val();
			var input = $('#search-field').val();
			if(vals == 0)
			{
				alert('Please select Category');
			}
			else
			{
				$.ajax({
					type: 'POST',
					'url' : vals,
					data:{
						search : input
					},
					success : function (data){
						$('#div-history').html(data);
					}

				});
			}
				
		})

	 $("td").dblclick(function () {
        var OriginalContent = $(this).text();
        $('#hidden-cell').val(OriginalContent);

        $(this).addClass("cellEditing");
        $(this).html("<input type='text' value='" + OriginalContent + "' />");
         $(this).children().first().focus();
        $(this).children().first().keyup(function (e) {        	
            var newContent = $(this).val();
            
            if(newContent.toLowerCase() == 'leave')
            {
            	$(this).parent().css('background-color',"red");
            	$(this).parent().css('color',"white");
            	console.log(newContent);
            }else
            {
            	$(this).parent().css('background-color',"");
            	$(this).parent().css('color',"");
            }
            $('#hidden-cell').val(newContent);
            if (e.which == 13) {
                
                $(this).parent().text(newContent);
                $(this).parent().removeClass("cellEditing");
            }
        });
    $(this).children().first().blur(function(){
      
        var cont = $('#hidden-cell').val();
        $(this).parent().text(cont);
        $(this).parent().removeClass("cellEditing");
    });
        $(this).find('input').dblclick(function(e){
            e.stopPropagation(); 
        });
    });


    $('#update-shift').on('click',function(){
        var tabContent = $('#tabid').html();

        $.ajax({
            type: "POST",
            url: baseUrl+"/extras/updateShift/",
            data: { 'content' : tabContent},
            success: function (data) {
               location.reload();
            }
        });
    })

	function getTeam(callback) {
		var content;
		$.ajax({
			url: baseUrl+"/Teams/team/",
			type: "POST",
			data:{
				"team_id": $("#team").val(),
				"project_id": $("#team_project").val()
			},
			success: function(data){
				if ($("#team_content:visible").length > 0) {
					$("#team_content").remove();
				}
				//$("#show-results").show();
				//$("#team_content:first").hide();
				$("#project_content").show();
				$("#team_content").show();
				$("#team_body").append(data);
				callback();
			} 
		});
	}

	function getProject(callback) {
		var content;
		$.ajax({
			url: baseUrl+"/Teams/project/",
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
						url:baseUrl+"/Teams/update/",
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
						url:baseUrl+"/Teams/update/",
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
});