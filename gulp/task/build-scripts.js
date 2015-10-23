var gulp = require('gulp-help')(require('gulp'));

/**
 * Compile, minify, and concat on-page scripting files.
 */
gulp.task('build-scripts', 'Compile, minify, and concat on-page scripting files.', function() {
	// Setup Vars
	var sequence = require('run-sequence');
	
	return sequence(
		'build-scripts/remove-old',
		'build-scripts/copy',
		'build-scripts/js',
		'build-scripts/minify',
		'build-scripts/concat'
	);
});
