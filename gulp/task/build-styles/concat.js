// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	cli      = require('../../cli'),
	concat   = require('gulp-concat-util'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Concatenate stylesheets
 */
gulp.task('build-styles/concat', false, function() {
	if (build.concat_css) {
		return gulp.src(build.concat_css_files)
			.pipe(concat(build.concat_css_output))
			.pipe(gulp.dest(paths.dist_styles));
	} else {
		cli.log('Skipping CSS concat');
	}
});
