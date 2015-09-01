<style>
	table {
		width: 100%;
		height: 100%;
		border-radius: 15px;
		padding: 4px;
		text-align: center;
	}
	th, td {
		padding: 10px;
	}
	th {
		background: linear-gradient(#00CCFF,#008FB2);
		color: #FFFFFF;
		font-size: 14px;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-weight: normal;
		text-align: center;
	}
	th > a {
		color: #FFFFFF;
	}
	.btn {
		color: #00CCFF;
	}
	div.btn-group > .btn{
		background: #E6E6E6;
		border: 1px #E6E6E6;
	}
</style>

<script type="text/javascript">
	/*window.onload = function () {
		var pdf = new PDFObject({
			url: "http://localhost/pviewer/sheets/merechristianitylewis.pdf",
			id: "pdfRenderer",
			pdfOpenParams: {
				view: "FitH"
			}
		}).embed("pdfRenderer");
	}*/
$(document).ready(function() {
	$(".view").each( function() {
		$(this).on("click", function() {
			var filename = $(this).attr('value');
			loadPDF(filename);
		});
	});

	function loadPDF(filename) {
		var pdf = new PDFObject({
			url: "http://localhost/pviewer/sheets/"+filename+".pdf",
			id: "pdfRenderer",
			pdfOpenParams: {
				view: "FitH"
			}
		}).embed("pdfRenderer");
	}
});
</script>

<div class="container-fluid">
	<h3>Member List</h3>
	<div class="col-md-6">
		<div class="row">
		<table class="table-responsive table-striped">
			<thead>
				<th><?php echo $this->Paginator->sort('Member Name'); ?></th>
				<th><?php echo $this->Paginator->sort('Team Name'); ?></th>
				<th><?php echo $this->Paginator->sort('Created'); ?></th>
				<th><?php echo $this->Paginator->sort('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</thead>
			<tbody>
				<?php foreach ($members as $member): ?>
					<tr>
						<td><?php echo h($member['Member']['member']); ?></td>
						<td><?php echo h($member['Member']['team_id']); ?></td>
						<td><?php echo h($member['Member']['created']); ?></td>
						<td><?php echo h($member['Member']['modified']); ?></td>
						<td class="actions">
							<?php echo $this->Html->link(__(''), '#', array('label' => false, 'value' => $member['Member']['id'], 'class' => 'btn glyphicon glyphicon-eye-open view')); ?>
							<?php echo $this->Html->link(__(''), array('action' => 'edit', $member['Member']['id']), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil')); ?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $member['Member']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to delete # %s?', $member['Member']['id']))); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		<div class=" row paging btn-group">
		<?php
			echo $this->Paginator->prev('< ' . __(''), array('tag' => false, 'class' => 'btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn btn-sm btn-primary prev disabled'));
			echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-sm btn-default'));
			echo $this->Paginator->next(__('') . ' >', array('tag' => false, 'class' => 'btn btn-sm btn-primary'), null, array('tag' => false, 'class' => 'btn btn-sm btn-primary next disabled'));
		?>
		</div>
	</div>
	<div class="col-md-6">
		<div id="pdfRenderer" class="panel panel-default" style="height:600px;width:600px;background-color:#E6E6E6;">
		</div>
	</div>
</div>