var gulp = require('gulp-help')(require('gulp'));

/**
 * Clone the source scripts to dist.
 */
gulp.task('build-scripts/copy', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.source_scripts + '/**/*').
		pipe(gulp.dest(paths.dist_scripts));
});
