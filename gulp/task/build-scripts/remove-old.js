var gulp = require('gulp-help')(require('gulp'));

/**
 * Remove the old scripts from dist.
 */
gulp.task('build-scripts/remove-old', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		rm    = require('gulp-clean'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.dist_scripts, {read: false})
		.pipe(rm());
});
