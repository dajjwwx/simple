<div class="panel panel-default">
	<div class="panel-heading">File System</div>
	<div class="panel-body">
		<?php
			$files = new Files();
			$files->content($_SERVER['DOCUMENT_ROOT']);
		?>
	</div>
</div>
