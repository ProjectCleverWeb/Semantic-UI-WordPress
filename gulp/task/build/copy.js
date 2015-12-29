module.exports = function() {
	// Setup Vars
	var
		gulp  = require('gulp-help')(require('gulp')),
		conf  = require('../../config'),
		// Aliases
		build = conf.build,
		paths = build.paths;
	
	return gulp.src(paths.source + '/**/*')
		.pipe(gulp.dest(paths.dist));
};
