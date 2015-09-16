// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Clone the source to dist.
 */
gulp.task('build/copy', false, function() {
	return gulp.src(paths.source + '/**/*')
		.pipe(gulp.dest(paths.dist));
});
