// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	sequence = require('run-sequence');

/**
 * Compile the source into a distribution.
 */
gulp.task('build', 'Compile the source into a distribution.', function() {
	return sequence(
		'build/remove-old',
		'build/copy',
		'build-styles/remove-old',
		'build-styles/copy',
		'build-styles/less',
		'build-styles/sass',
		'build-styles/css',
		'build-styles/minify',
		'build-styles/concat',
		'build-scripts/remove-old',
		'build-scripts/copy',
		'build-scripts/js',
		'build-scripts/minify',
		'build-scripts/concat',
		'optimize-images',
		'build-screenshot'
	);
});
