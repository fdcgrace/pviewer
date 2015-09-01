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
	
});