var gulp = require('gulp-help')(require('gulp'));

/**
 * Add logo to dist.
 */
gulp.task('build-logo', 'Add logo to dist.', function() {
	// Setup Vars
	var
		conf    = require('../config'),
		cli     = require('../cli'),
		svg2png = require('gulp-svg2png'),
		img_opt = require('gulp-image-optimization'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;
	
	if (build.optimize_images && build.optimize_image_types.indexOf('png') != -1) {
		return gulp.src(cli.cwd + '/logo.png')
			.pipe(img_opt(build.optimize_image_options))
			.pipe(gulp.dest(paths.dist));
	} else {
		return gulp.src(cli.cwd + '/logo.png')
			.pipe(gulp.dest(paths.dist));
	}
});
