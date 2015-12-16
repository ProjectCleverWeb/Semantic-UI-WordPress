<?php
/**
 * Debug Class
 */

namespace semantic;

/**
 * This class carries out all the debug functionality
 */
class debug extends abstract_base {
	
	/**
	 * Current logged checkpoints
	 * @var array
	 */
	public $runtime_checkpoints;
	
	/**
	 * Sets debugging as either enabled or disabled
	 * @var boolean
	 */
	public $active;
	
	/**
	 * Instance of the shutdown class
	 * @var shutdown
	 */
	public $shutdown;
	
	/**
	 * Configures this class as well as the shutdown class and the $debug global
	 */
	public function __construct() {
		// Setup globals and query vars
		global $debug;
		$debug = $this;
		set_query_var('debug',  $this);
		
		// Setup the shutdown class
		$this->shutdown = new shutdown;
		
		$this->runtime_checkpoints = array();
		$this->active = FALSE;
		if (is_user_logged_in() && current_user_can('manage_options')) {
			$this->active = TRUE;
		}
		if (!empty($_SERVER['REQUEST_TIME_FLOAT'])) {
			$this->runtime_checkpoints[] = array(
				'name' => '[PHP] Sent Request To Server',
				'time' => $_SERVER['REQUEST_TIME_FLOAT']
			);
		}
		if (defined('PHP_START_TIME')) {
			$this->runtime_checkpoints[] = array(
				'name' => '[PHP] Started Server-Side Execution',
				'time' => PHP_START_TIME
			);
		}
		
		// Shutdown Actions
		$this->shutdown->register('debug_output', array($this, '_runtime_on_shutdown'));
		$this->shutdown->register('usage_tracker', array($this, 'usage_tracker'));
		
		parent::__construct();
	}
	
	/**
	 * This is a simple way for me to track how many people are using my
	 * development theme. This has no positive or negative effect on SEO.
	 * 
	 * Please only remove this if it causes your application problems.
	 * 
	 * @return void
	 */
	public function usage_tracker() {
		if (php_sapi_name() != 'cli' && (is_front_page() || is_home())) {
			echo '<img id="suiwp-usage-tracker" src="http://i.imgur.com/OZlAOER.png" alt="SUIWP s9kjorYIe54NaD6VIK3TF6C792gIKjY0">';
		}
	}
	
	/**
	 * Checkpoint logger
	 * 
	 * @param  string $message The message to report back to the logger
	 * @return void
	 */
	public function runtime_checkpoint($message = '') {
		$this->runtime_checkpoints[] = array(
			'name' => (string) $message,
			'time' => microtime(TRUE)
		);
	}
	
	/**
	 * Prints the current log as html (Semantic UI modal)
	 * 
	 * @return void
	 */
	public function runtime_print_html_log() {
		$checkpoints   = $this->runtime_checkpoints;
		$first         = array_shift($checkpoints);
		$previous_time = $first['time'];
		?>
		<div class="ui basic modal" id="semantic-debug-log">
			<i class="close icon"></i>
			<h1 class="ui huge icon header">
				<i class="bug icon"></i>
				<div class="content">
					Debug Log
					<div class="sub header">Please Use This Log When Reporting Issues</div>
				</div>
			</h1>
			<div class="content">
				<div class="description">
					<table class="ui very compact selectable celled table">
						<thead>
							<tr>
								<th>Message</th>
								<th>Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
							printf('<tr><td>%1$s</td><td>%2$s</td></tr>'.PHP_EOL , htmlentities($first['name']), $first['time']);
							foreach ($checkpoints as $checkpoint) {
								printf(
									'<tr><td>%1$s</td><td>%2$s/+%3$s</td></tr>'.PHP_EOL,
									htmlentities($checkpoint['name']),
									round(($checkpoint['time'] - $first['time']) * 1000, 2).'ms',
									round(($checkpoint['time'] - $previous_time) * 1000, 2).'ms'
								);
								$previous_time = $checkpoint['time'];
							}
							printf('<tr><td>[PHP] Memory Peak</td><td>%1$s MiB</td></tr>', round(memory_get_peak_usage()/1024/1024, 3));
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="actions">
				<div class="ui red basic inverted cancel button">
					<i class="remove icon"></i>
					Close
				</div>
			</div>
		</div>
		<?php
	}
	
	/**
	 * Runs all the shutdown functionality for this class
	 * 
	 * @return void
	 */
	public function _runtime_on_shutdown() {
		global $wp_styles, $wp_scripts;
		if (!empty($wp_styles->queue)) {
			foreach ($wp_styles->queue as $style) {
				if (wp_style_is($style, 'done')) {
					$this->runtime_checkpoint('[Theme] Style "'.$style.'" Was Printed');
				}
			};
		}
		if (!empty($wp_scripts->queue)) {
			foreach ($wp_scripts->queue as $script) {
				if (wp_style_is($script, 'done')) {
					$this->runtime_checkpoint('[Theme] Script "'.$script.'" Was Printed');
				}
			};
		}
		$this->runtime_checkpoint('[PHP] Stopped Server-Side Execution');
		if ($this->active) {
			if (php_sapi_name() != 'cli') {
				$this->runtime_print_html_log();
			}
		}
	}
}
