<?php if(count($err) > 0) : ?>
	<div class = "error">
		<?php foreach ($err as $error) : ?>
			<p style="color: red;"><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php endif ?>


