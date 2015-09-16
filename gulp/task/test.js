// Setup Vars
var
	gulp = require('gulp-help')(require('gulp')),
	cli  = require('../cli');

/**
 * Run The Unit Tests
 */
gulp.task('test', 'Run The Unit Tests.', function() {
	cli.run('phpunit');
});
