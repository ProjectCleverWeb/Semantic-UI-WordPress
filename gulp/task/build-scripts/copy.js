// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Clone the source scripts to dist.
 */
gulp.task('build-scripts/copy', false, function() {
	return gulp.src(paths.source_scripts + '/**/*').
		pipe(gulp.dest(paths.dist_scripts));
});
