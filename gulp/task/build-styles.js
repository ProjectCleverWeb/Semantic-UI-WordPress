var gulp = require('gulp-help')(require('gulp'));

/**
 * Compile, minify, and concat stylesheets.
 */
gulp.task('build-styles', 'Compile, minify, and concat stylesheets.', function() {
	// Setup Vars
	var sequence = require('run-sequence');
	
	return sequence(
		'build-styles/remove-old',
		'build-styles/copy',
		'build-styles/less',
		'build-styles/sass',
		'build-styles/css',
		'build-styles/minify',
		'build-styles/concat'
	);
});
