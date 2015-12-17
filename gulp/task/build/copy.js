var gulp = require('gulp-help')(require('gulp'));

/**
 * Clone the source to dist.
 */
gulp.task('build/copy', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.source + '/**/*')
		.pipe(gulp.dest(paths.dist));
});
