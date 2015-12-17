<?php
/**
 * Shutdown Class
 */

namespace semantic;

/**
 * Shutdown Class
 * 
 * This class helps handle what happens when PHP exits. This is very useful for
 * doing last second tasks.
 */
class shutdown extends abstract_base {
	
	/**
	 * The current list of jobs to run on shutdown
	 * @var array
	 */
	private $jobs;
	
	/**
	 * Configure this class and the function to run on PHP shutdown
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->jobs = array();
		register_shutdown_function(array($this, '_run_shutdown'));
		parent::__construct();
	}
	
	/**
	 * Register a shutdown action with a callback function and optional arguments.
	 * 
	 * NOTE: The callback must already be callable by the time it is registered!
	 * 
	 * @param  string $id         The id to register under
	 * @param  callable $callback The callback to run when PHP exits
	 * @param  array  $args       Associative array of arguments to send on shutdown
	 * @return boolean            TRUE when registration is successful, FALSE otherwise
	 */
	public function register($id, $callback, $args = array()) {
		global $debug;
		$status = FALSE;
		if (!isset($this->jobs[$id])) {
			if (is_callable($callback)) {
				$debug->runtime_checkpoint(sprintf('[Theme] Shutdown - Registered "%s"', $id));
				$this->jobs[$id] = array(
					'callback' => $callback,
					'args'     => $args
				);
				$status = TRUE;
			}
		} else {
			$debug->runtime_checkpoint(sprintf('[Theme] Shutdown - Registration failed for "%s"', $id));
		}
		return $status;
	}
	
	/**
	 * Remove a job from the job queue
	 * 
	 * @param  string $id The id to remove
	 * @return void
	 */
	public function unregister($id) {
		global $debug;
		if (isset($this->jobs[$id])) {
			$debug->runtime_checkpoint(sprintf('[Theme] Shutdown - Unregistered "%s"', $id));
			unset($this->jobs[$id]);
		}
	}
	
	/**
	 * Check if a job is registered
	 * 
	 * @param  string $id The id to check
	 * @return boolean    TRUE if job exists, FALSE otherwise
	 */
	public function exists($id) {
		return isset($this->jobs[$id]);
	}
	
	/**
	 * Loops through and runs each job. Resets job queue after it finishes.
	 */
	public function _run_shutdown() {
		global $debug;
		foreach ($this->jobs as $id => $job) {
			$debug->runtime_checkpoint(sprintf('[Theme] Shutdown - Running "%s"...', $id));
			call_user_func_array($job['callback'], $job['args']);
		}
		$this->jobs = array();
	}
}
