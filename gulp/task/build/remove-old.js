var gulp = require('gulp-help')(require('gulp'));

/**
 * Remove the old dist. files
 */
gulp.task('build/remove-old', false, function() {
	// Setup Vars
	var
		conf    = require('../../config'),
		gulp_rm = require('../../function/gulp-rm'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;
	
	return gulp.src(paths.dist, {read: false})
		.pipe(gulp_rm());
});
