<?php

$sections = array(
	1 => array(
		'Theme Templates' => array(
			'Template Breakdown' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'How Templates Are Fetched' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Designing New Templates' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Making Sub-Templates' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			)
		)
	),
	2 => array(
		'Theme Options Page' => array(
			'Modifying Options' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Modifying Tabs' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Options And The Database' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Security' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			)
		)
	),
	3 => array(
		'The Theme Class' => array(
			'Overview' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Fetching Theme Parts' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Identifier' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Path Manager' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Options Manager' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			)
		)
	),
	4 => array(
		'The Integration Classes' => array(
			'Overview' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'wp-init and wp_integrations' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Theme Support' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Sidebars And Widget Areas' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Enqueue' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Post Editor Styles' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'Other' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			)
		)
	),
	5 => array(
		'Recommendations' => array(
			'rec 1' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'rec 2' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			),
			'rec 3' => array(
				'img'  => 'placeholder.png',
				'text' => ''
			)
		)
	),
);


foreach ($sections as $major => $section) {
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
