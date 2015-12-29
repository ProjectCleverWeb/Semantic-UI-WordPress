module.exports = function() {
	// Setup Vars
	var
		gulp     = require('gulp-help')(require('gulp')),
		conf     = require('../config'),
		cli      = require('../cli'),
		fs = require("fs"),
		// Aliases
		build    = conf.build,
		paths    = build.paths;
	
	return gulp.src(cli.cwd + '/docs/**/*')
		.pipe(gulp.dest(paths.dist_styles + '/../docs'));
};
