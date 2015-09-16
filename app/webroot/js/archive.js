
	function toggleRows(id,radio)
	{
		document.getElementById("issue-radio"+radio).checked = true;
		$('#issue-div').html($('#'+id).html());
		$('#issue-div').show();
	}
	function toggleRowsLeader(id,radio)
	{
		$('#leader-history').html($('#'+id).html());
		$('#leader-history').show();
	}
	function toggleRowsMember(id,radio)
	{
		$('#member-history').html($('#'+id).html());
		$('#member-history').show();
	}

	function getProject(id)
	{
		$('#issue-history').html($('#'+id).html());
		$('#issue-history').show();
	}