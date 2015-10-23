var gulp = require('gulp-help')(require('gulp'));

/**
 * Copy any remaining minified js files
 * 
 * We do this to allow 3rd party minified libs to retain their copyright info
 */
gulp.task('build-scripts/minify', false, function() {
	// Setup Vars
	var
		conf  = require('../../config'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.source_scripts + '/**/*.min.js').
		pipe(gulp.dest(paths.dist_scripts));
});
