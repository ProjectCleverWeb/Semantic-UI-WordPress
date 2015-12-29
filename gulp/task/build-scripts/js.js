module.exports = function() {
	// Setup Vars
	var
		gulp   = require('gulp-help')(require('gulp')),
		conf   = require('../../config'),
		mv     = require('gulp-rename'),
		js_min = require('gulp-uglify'),
		// Aliases
		build  = conf.build,
		paths  = build.paths;
	
	if (build.minify_js) {
		return gulp.src([paths.source_scripts + '/**/*.js', '!' + paths.source_scripts + '/**/*.min.js'])
			.pipe(gulp.dest(paths.dist_scripts))
			.pipe(js_min({outSourceMap: true}))
			.pipe(mv({
				extname: '.min.js'
			}))
			.pipe(gulp.dest(paths.dist_scripts));
	} else {
		return gulp.src([paths.source_scripts + '/**/*.js', '!' + paths.source_scripts + '/**/*.min.js'])
			.pipe(gulp.dest(paths.dist_scripts));
	}
};
