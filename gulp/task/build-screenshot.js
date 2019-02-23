module.exports = function() {
	// Setup Vars
	var
		gulp    = require('gulp-help')(require('gulp')),
		conf    = require('../config'),
		svg2png = require('gulp-svg2png'),
		img_opt = require('gulp-image-optimization'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;

	// if (build.optimize_images && build.optimize_image_types.indexOf('png') != -1) {
	// 	return gulp.src(paths.source + '/screenshot.svg')
	// 		.pipe(svg2png())
	// 		.pipe(img_opt(build.optimize_image_options))
	// 		.pipe(gulp.dest(paths.dist));
	// } else {
	// 	return gulp.src(paths.source + '/screenshot.svg')
	// 		.pipe(svg2png())
	// 		.pipe(gulp.dest(paths.dist));
	// }
};
