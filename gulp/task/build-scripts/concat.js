var gulp = require('gulp-help')(require('gulp'));

/**
 * Concatenate Scripts
 */
gulp.task('build-scripts/concat', false, function() {
	// Setup Vars
	var
		conf   = require('../../config'),
		cli    = require('../../cli'),
		concat = require('gulp-concat-util'),
		// Aliases
		build  = conf.build,
		paths  = build.paths;
	
	if (build.concat_js) {
		return gulp.src(build.concat_js_files)
			.pipe(concat(build.concat_js_output))
			.pipe(gulp.dest(paths.dist_scripts));
	} else {
		cli.log('Skipping JS concat');
	}
});
