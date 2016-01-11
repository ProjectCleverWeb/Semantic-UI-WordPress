module.exports = function() {
	// Setup Vars
	var
		gulp      = require('gulp-help')(require('gulp')),
		conf      = require('../config'),
		cli       = require('../cli'),
		fs        = require("fs"),
		line_ends = require('gulp-eol'),
		// Aliases
		build     = conf.build,
		paths     = build.paths;
	
	return gulp.src(cli.cwd + '/docs/**/*')
		.pipe(line_ends('\n'))
		.pipe(gulp.dest(paths.dist_styles + '/../docs'));
};
