module.exports = function() {
	// Setup Vars
	var
		gulp    = require('gulp-help')(require('gulp')),
		conf    = require('../config'),
		cli     = require('../cli'),
		img_opt = require('gulp-image-optimization'),
		// Aliases
		build   = conf.build,
		paths   = build.paths;
	
	if (build.optimize_images) {
		return gulp.src(paths.source + '/**/*.+(' + build.optimize_image_types.join('|') + ')', {base:paths.source})
			.pipe(img_opt(build.optimize_image_options))
			.pipe(gulp.dest(paths.dist));
	} else {
		cli.log('Skipping image optimization');
	}
};
