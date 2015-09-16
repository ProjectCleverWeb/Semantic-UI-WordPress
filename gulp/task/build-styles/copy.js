// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Clone the source styles to dist.
 */
gulp.task('build-styles/copy', false, function() {
	return gulp.src(paths.source_styles + '/**/*').
		pipe(gulp.dest(paths.dist_styles));
});
