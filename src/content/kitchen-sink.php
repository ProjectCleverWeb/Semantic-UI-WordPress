<?php

$sections = array(
	// ID => Name
	'element/button' => 'Buttons',
	'element/divider' => 'Dividers'
);


foreach ($sections as $id => $name) {
	printf('<h2 class="ui dividing header">%s</h2>'.PHP_EOL, $name);
	?>
	<div class="ui basic segment">
		<?php
		template_part(sprintf($theme->content_sub_path.'/kitchen-sink/%1$s', $id));
		?>
	</div>
	<?php
}
