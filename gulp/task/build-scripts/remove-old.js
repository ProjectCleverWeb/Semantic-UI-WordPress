// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	rm       = require('gulp-clean'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Remove the old scripts from dist.
 */
gulp.task('build-scripts/remove-old', false, function() {
	return gulp.src(paths.dist_scripts, {read: false})
		.pipe(rm());
});
