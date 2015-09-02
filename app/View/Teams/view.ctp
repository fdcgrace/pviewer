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
		background: linear-gradient(#FF944D,#FF6600);
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
		color: #FF944D;
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
		if($(this).attr("flag") == 1) {
			$(this).on("click", function() {
				var filename = $(this).attr('value');
				loadPDF(filename);
			});
		}
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

	$(".glyphicon").each(function() {
		if ($(this).attr("flag") == 0) {
			$(this).removeAttr("href");
			$(this).attr("disabled", "disabled");
		}
	});
});
</script>

<div class="container-fluid">
	<h3>Team Leader List</h3>
	<div class="col-md-6">
		<div class="row">
		<table class="table-responsive table-striped">
			<thead>
				<th><?php echo $this->Paginator->sort('Team Name'); ?></th>
				<th><?php echo $this->Paginator->sort('Created'); ?></th>
				<th><?php echo $this->Paginator->sort('Modified'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</thead>
			<tbody>
				<?php foreach ($teams as $team): ?>
					<tr>
						<td><?php echo h($team['Team']['team']); ?></td>
						<td><?php echo h($team['Team']['created']); ?></td>
						<td><?php echo h($team['Team']['modified']); ?></td>
						<td><?php echo h($team['Team']['del_flg']); ?></td>
						<td class="actions">
							<?php echo $this->Html->link(__(''), array('#'), array('label' => false, 'class' => 'btn glyphicon glyphicon-eye-open view', 'flag' => $team['Team']['del_flg'])); ?>
							<?php echo $this->Html->link(__(''), array('action' => 'edit', $team['Team']['id']), array('data-toggle' => 'modal', 'data-target' => '#', 'label' => false, 'class' => 'btn glyphicon glyphicon-pencil', 'flag' => $team['Team']['del_flg'])); ?>
							<?php if ($team['Team']['del_flg']) :?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'deactivate', $team['Team']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-trash', 'confirm' => __('Are you sure you want to deactivate # %s?', $team['Team']['id']))); ?>
							<?php else :?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'activate', $team['Team']['id']), array('label' => false, 'class' => 'btn glyphicon glyphicon-user', 'confirm' => __('Are you sure you want to activate # %s?', $team['Team']['id']))); ?>
							<?php endif;?>
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