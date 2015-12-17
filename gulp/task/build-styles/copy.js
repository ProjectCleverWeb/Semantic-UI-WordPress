var gulp = require('gulp-help')(require('gulp'));

/**
 * Clone the source styles to dist.
 */
gulp.task('build-styles/copy', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.source_styles + '/**/*').
		pipe(gulp.dest(paths.dist_styles));
});
