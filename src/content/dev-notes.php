<?php

global $dev_notes;

foreach ($dev_notes as $major => $section) {
	foreach ($section as $title => $value) {
		printf('<h2 class="ui top attached center aligned header">%2$s.0 - %1$s</h2>', $title, $major);
		?><div class="ui bottom attached secondary segment"><div class="ui two column doubling grid"><?php
		$minor = 1;
		foreach ($value as $subsection => $info) {
			$id = $major.'-'.$minor.'-'.str_replace(' ', '-', strtolower($subsection))
			?>
			<div class="column">
				<?php
				printf('<h3 class="ui dividing header" id="%2$s">%3$s.%4$s - %1$s</h3>', $subsection, $id, $major, $minor);
				?>
				<div class="ui center aligned basic segment">
					<img src="<?php echo theme::$images_uri.'/dev-notes/'.$info['img']; ?>">
				</div>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae asperiores eum facere repellendus sint ut minus, commodi consequatur porro quam praesentium, rerum error quisquam reiciendis blanditiis vel dignissimos maxime animi incidunt non ex consequuntur modi, veniam ducimus.
				<br><br>
				Architecto, obcaecati maxime reprehenderit officia ducimus tenetur, magni.<?php echo $info['text']; ?></p>
			</div>
			<?php
			$minor++;
		}
		?></div></div><?php
	}
}
