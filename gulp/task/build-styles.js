// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	sequence = require('run-sequence');

/**
 * Compile, minify, and concat stylesheets.
 */
gulp.task('build-styles', 'Compile, minify, and concat stylesheets.', function() {
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
