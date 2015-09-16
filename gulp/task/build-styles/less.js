// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../../config'),
	cli      = require('../../cli'),
	mv       = require('gulp-rename'),
	less     = require('gulp-less'),
	css_min  = require('gulp-minify-css'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Compile and minify LESS files.
 */
gulp.task('build-styles/less', false, function() {
	if (build.compile_less) {
		if (build.minify_css) {
			return gulp.src(paths.source_styles + '/**/*.less')
				.pipe(less())
				.pipe(gulp.dest(paths.dist_styles))
				.pipe(css_min())
				.pipe(mv({
					extname: '.min.css'
				}))
				.pipe(gulp.dest(paths.dist_styles));
		} else {
			return gulp.src(paths.source_styles + '/**/*.less')
				.pipe(less())
				.pipe(gulp.dest(paths.dist_styles));
		}
	} else {
		cli.log('Skipping LESS files');
	}
});
