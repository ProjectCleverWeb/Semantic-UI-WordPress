module.exports = function() {
	// Setup Vars
	var
		gulp      = require('gulp-help')(require('gulp')),
		conf      = require('../config'),
		line_ends = require('gulp-eol'),
		// Aliases
		build     = conf.build,
		paths     = build.paths;
	
	return gulp.src(paths.dist + '/**/*.+(php|html|js|css|less|sass|scss|map|txt|svg|md)')
		.pipe(line_ends('\n'))
		.pipe(gulp.dest(paths.dist));
};
