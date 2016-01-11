<?php

$sections = array(
	// ID => Name
	'buttons' => 'Buttons'
);


foreach ($sections as $id => $name) {
	printf('<h2 class="ui dividing header">Buttons</h2>'.PHP_EOL, $name);
	?>
	<div class="ui basic segment">
		<?php
		template_part(sprintf($theme->content_sub_path.'/kitchen-sink/%1$s', $id));
		?>
	</div>
	<?php
}
