module.exports = function() {
	// Setup Vars
	var
		gulp     = require('gulp-help')(require('gulp')),
		util     = require('gulp-util'),
		conf     = require('../config'),
		cli      = require('../cli'),
		gulp_rm  = require('../function/gulp-rm'),
		svg2png  = require('gulp-svg2png'),
		img_opt  = require('gulp-image-optimization'),
		sequence = require('run-sequence'),
		// Aliases
		build    = conf.build,
		paths    = build.paths,
		color    = util.colors;
	
	// Warn about Gulp/Gaze issues
	cli.log(color.bgBlack.white(color.bold.red("[IMPORTANT]") + " Watch works very well for MOST things, however it does have some issues, including problems removing directories. (hint: use the 'build' task to compensate) - " + color.bold.cyan("https://github.com/gulpjs/gulp/issues/651")));
	// Notice about 3 second save
	cli.log(color.bgBlack.white(color.bold("[NOTICE]") + " Using Source Directory: " + paths.source));
	cli.log(color.bgBlack.white(color.bold("[NOTICE]") + " Using Dist. Directory: " + paths.dist));
	cli.log(color.bgBlack.white(color.bold("[NOTICE]") + " Please avoid saving a file more than once within a 3 second period."));
	
	// General
	gulp.watch([
		paths.source + '/**/*',
		'!' + paths.source_styles + '/**/*',
		'!' + paths.source_scripts + '/**/*',
		'!' + paths.source + '/**/*.+(' + build.optimize_image_types.join('|') + ')'
	], function(event) {
		cli.log_event(event);
		// gulp.src ignores paths that don't exist, so renaming works as expected.
		gulp.src(event.path, {base:paths.source}).
			pipe(gulp.dest(paths.dist));
		if (event.type === 'deleted') { // update the build dir when a file is deleted
			gulp.src(paths.dist + '/' + event.path.substring((cli.cwd + '/' + paths.source + '/').length), {read: false}).
				pipe(gulp_rm());
		}
	});
	
	// README
	gulp.watch(cli.cwd + '/README.md', ['build-readme']);
	
	// Styles
	// NOTE: Avoid saving styles more than once every 3 seconds
	gulp.watch([paths.source_styles + '/**/*', '!' + paths.source + '/**/*.+(' + build.optimize_image_types.join('|') + ')'], function(event) {
		cli.log_event(event);
		if (event.type !== 'renamed') { // prevents double run on rename
			sequence(
				'build-styles/remove-old',
				'build-styles/copy',
				'build-styles/less',
				'build-styles/sass',
				'build-styles/css',
				'build-styles/minify',
				'build-styles/concat',
				'fix-line-endings'
			);
		}
	});
	
	// Scripts
	// NOTE: Avoid saving scripts more than once every 3 seconds
	gulp.watch([paths.source_scripts + '/**/*', '!' + paths.source + '/**/*.+(' + build.optimize_image_types.join('|') + ')'], function(event) {
		cli.log_event(event);
		if (event.type !== 'renamed') { // prevents double run on rename
			sequence(
				'build-scripts/remove-old',
				'build-scripts/copy',
				'build-scripts/js',
				'build-scripts/minify',
				'build-scripts/concat',
				'fix-line-endings'
			);
		}
	});
	
	// Images
	// NOTE: Avoid re-saving the same image more than once every 3 seconds
	gulp.watch(paths.source + '/**/*.+(' + build.optimize_image_types.join('|') + ')', function(event) {
		cli.log_event(event);
		if (use_image_opt) {
			// gulp.src ignores paths that don't exist, so renaming works as expected.
			gulp.src(event.path, {base:paths.source}).
				pipe(image_opt(build.optimize_image_options)).
				pipe(gulp.dest(paths.dist));
		} else {
			// gulp.src ignores paths that don't exist, so renaming works as expected.
			gulp.src(event.path, {base:paths.source}).
				pipe(gulp.dest(paths.dist));
		}
		if (event.type === 'deleted') { // update the build dir when a file is deleted
			gulp.src(paths.dist + '/' + event.path.substring((cli.cwd + '/' + paths.source + '/').length), {read: false}).
				pipe(gulp_rm());
		}
	});
};
