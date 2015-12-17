var gulp = require('gulp-help')(require('gulp'));

/**
 * Copy and minify CSS files
 */
gulp.task('build-styles/css', false, function() {
	// Setup Vars
	var
		conf    = require('../../config'),
		mv      = require('gulp-rename'),
		css_min = require('gulp-minify-css'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;
	
	if (build.minify_css) {
		return gulp.src([paths.source_styles + '/**/*.css', '!' + paths.source_styles + '/**/*.min.css'])
			.pipe(gulp.dest(paths.dist_styles))
			.pipe(css_min())
			.pipe(mv({
				extname: '.min.css'
			}))
			.pipe(gulp.dest(paths.dist_styles));
	} else {
		return gulp.src([paths.source_styles + '/**/*.css', '!' + paths.source_styles + '/**/*.min.css'])
			.pipe(gulp.dest(paths.dist_styles));
	}
});
