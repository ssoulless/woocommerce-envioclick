<div class="wrap">
	<h1>Envioclick</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php
			settings_fields( 'envioclick_options_group' );
			do_settings_sections( 'envioclick_plugin' );
			submit_button();
		?>
	</form>
</div>