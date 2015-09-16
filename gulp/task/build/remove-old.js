// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	rm       = require('gulp-clean'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Remove the old dist. files
 */
gulp.task('build/remove-old', false, function() {
	return gulp.src(paths.dist, {read: false})
		.pipe(rm());
});
