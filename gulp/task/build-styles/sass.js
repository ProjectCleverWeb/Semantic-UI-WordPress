module.exports = function() {
	// Setup Vars
	var
		gulp    = require('gulp-help')(require('gulp')),
		conf    = require('../../config'),
		cli     = require('../../cli'),
		mv      = require('gulp-rename'),
		sass    = require('gulp-sass'),
		css_min = require('gulp-minify-css'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;
	
	if (build.compile_sass) {
		if (build.minify_css) {
			return gulp.src(paths.source_styles + '/**/*.+(sass|scss)')
				.pipe(sass())
				.pipe(gulp.dest(paths.dist_styles))
				.pipe(css_min())
				.pipe(mv({
					extname: '.min.css'
				}))
				.pipe(gulp.dest(paths.dist_styles));
		} else {
			return gulp.src(paths.source_styles + '/**/*.+(sass|scss)')
				.pipe(sass())
				.pipe(gulp.dest(paths.dist_styles));
		}
	} else {
		cli.log('Skipping SASS/SCSS files');
	}
};
