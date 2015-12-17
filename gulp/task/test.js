var gulp = require('gulp-help')(require('gulp'));

/**
 * Run The Unit Tests
 */
gulp.task('test', 'Run The Unit Tests.', function() {
	// Setup Vars
	var cli = require('../cli');
	
	cli.run('phpunit');
});
