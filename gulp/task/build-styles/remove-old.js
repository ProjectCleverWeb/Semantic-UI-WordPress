var gulp = require('gulp-help')(require('gulp'));

/**
 * Remove the old styles from dist.
 */
gulp.task('build-styles/remove-old', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		rm    = require('gulp-clean'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.dist_styles, {read: false})
		.pipe(rm());
});
