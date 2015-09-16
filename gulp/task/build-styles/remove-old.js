// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	rm       = require('gulp-clean'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Remove the old styles from dist.
 */
gulp.task('build-styles/remove-old', false, function() {
	return gulp.src(paths.dist_styles, {read: false})
		.pipe(rm());
});
