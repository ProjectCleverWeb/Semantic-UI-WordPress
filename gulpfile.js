/**
 * Configuration
 * -------------
 * Notes:
 *   * The default config for concat is just for the front-end of the site,
 *       the WordPress dashboard and other pages that may require a specific
 *       stylesheet or script configuration should specify the files they need.
 *   * Concat is always run after LESS/SASS is compiled
 *   * Some tasks are broken down to allow synchronous behavior (important)
 *   * All paths in configuration variables SHOULD NOT have leading or trailing
 *       slashes UNLESS they are absolute paths from PC's root path. Only then
 *       is a leading slash allowed.
 *   * When order is not required to complete a set of actions, the actions are
 *       ordered alphabetically. This means that "LESS" will be compiled before
 *       "SASS" and files starting with "a" will be used before files that
 *       start with "b", "c", etc.
 */

// Optional Config
var
	use_less        = true,
	use_sass        = true,
	use_image_opt   = true,
	concat_css      = false, // output is to "all.min.css" (each file must be specified below)
	concat_css_list = [ // paths are relative to build_styles_dir
		'font-awesome.min.css',
		'webicons.min.css',
		'highlight.js/github.min.css',
		'semantic.min.css',
		'main.min.css'
	],
	concat_js       = false, // output is to "all.min.js" (each file must be specified below)
	concat_js_list  = [ // paths are relative to build_scripts_dir
		'semantic.min.js',
		'highlight.pack.min.js',
		'mousetrap.min.js',
		'main.min.js'
	];

// Paths (no trailing or leading slashes!)
var
	cwd                 = process.cwd(),
	source_dir          = 'src',
	build_dir           = 'build',
	source_styles_dir   = source_dir + '/assets/styles',
	build_styles_dir    = build_dir + '/assets/styles',
	source_scripts_dir  = source_dir + '/assets/scripts',
	build_scripts_dir   = build_dir + '/assets/scripts';

// Utility
var
	spawn       = require('child_process').spawn,
	gulp        = require('gulp'),
	concatJs    = require('gulp-concat'),
	concatCss   = require('gulp-concat-css'),
	imageOpt    = require('gulp-image-optimization'),
	less        = require('gulp-less'),
	minifyCSS   = require('gulp-minify-css'),
	rename      = require('gulp-rename'),
	rimraf      = require('gulp-rimraf'),
	scss        = require('gulp-sass'),
	uglify      = require('gulp-uglify'),
	using       = require('gulp-using'),
	gutil       = require('gulp-util'),
	runSequence = require('run-sequence');

// Make concat paths relative to their respective directories
for (i = 0; i < concat_css_list.length; i++) { 
	concat_css_list[i] = build_styles_dir + '/' + concat_css_list[i];
}
for (i = 0; i < concat_js_list.length; i++) { 
	concat_js_list[i] = build_scripts_dir + '/' + concat_js_list[i];
}

/**
 * Functions
 */

// Run something in the command line
function run_cmd(cmd, args) {
	var
		child = spawn(cmd, args, {cwd: process.cwd()}),
		stdout = '',
		stderr = '';
	
	child.stdout.setEncoding('utf8');
	child.stdout.on('data', function (data) {
		stdout += data;
		gutil.log(data);
	});
	
	child.stderr.setEncoding('utf8');
	child.stderr.on('data', function (data) {
		stderr += data;
		gutil.log(gutil.colors.red(data));
		gutil.beep();
	});
	
	child.on('error', function (data) {
		stderr += data;
		gutil.log(gutil.colors.red('ERROR: ') + "Function '" + cmd + "' doesn't exist (" + data + ")");
		gutil.beep();
	});
	
	child.on('close', function(code) {
		return code;
	});
}

function log(msg) {
	gutil.log(msg);
}

function log_event(event) {
	log_type = gutil.colors.bold.cyan('[' + event.type.toUpperCase() + ']');
	log_path = event.path.substring((cwd + '/' + source_dir + '/').length);
	
	log(gutil.colors.bgBlack(log_type + ' ' + log_path));
}

function help_docs() {
	var
		bgb = gutil.colors.bgBlack,
		w   = gutil.colors.white,
		y   = gutil.colors.yellow,
		g   = gutil.colors.green;
		r   = gutil.colors.red;
	
	gutil.log(
		"Generating Help Docs...\n" +
		bgb(w("Available Tasks:\n  " +
		y('build') + "          Generate All theme files from /" + source_dir + " (recreates /" + build_dir + ")\n  " +
		y('build-styles') + "   Generate stylesheet files [" + g('/' + source_dir + ' => /' + build_dir) + "]\n  " +
		y('build-scripts') + "  Generate JavaScript files [" + g('/' + source_dir + ' => /' + build_dir) + "]\n  " +
		y('build-images') + "   Optimize all images (png|jpg|jpeg|gif) [" + g('/' + source_dir + ' => /' + build_dir) + "]\n  " +
		y('concat') + "         Concatinates the predefined scripts and styles (/" + build_dir + " only)\n  " +
		y('concat-styles') + "  Concatinates the predefined styles (/" + build_dir + " only)\n  " +
		y('concat-scripts') + " Concatinates the predefined scripts (/" + build_dir + " only)\n  " +
		y('watch') + "          Watch /" + source_dir + " for changes, update /" + build_dir + " on change\n  " +
		y('test') + "           Test the current configuration\n  " +
		y('default') + "        Show these help docs" +
		"\n\n" +
		"Usage:\n  " +
		"gulp " + y('<task>') + "\n  " +
		"gulp " + y('<task>') + ':' + y('<sub-task>') +
		"\n\n" +
		"Notes:\n  " +
		"* You should have Composer and PHPUnit installed and in your $path\n  " +
		"* Sub-Tasks should only be used if you know exactly what you are doing."
	)));
}

/**
 * Normal Tasks
 */

gulp.task('default', function() {
	help_docs();
});

gulp.task('test', function() {
	run_cmd('phpunit');
});

gulp.task('build', function() {
	return runSequence(
		'build:remove-old',
		'build:copy',
		'build-styles:remove-old',
		'build-styles:copy',
		'build-styles:less',
		'build-styles:sass',
		'build-styles:normal',
		'build-styles:minified',
		'concat-styles',
		'build-scripts:remove-old',
		'build-scripts:copy',
		'build-scripts:normal',
		'build-scripts:minified',
		'concat-scripts',
		'build-images'
	);
});

gulp.task('build-styles', function() {
	return runSequence(
		'build-styles:remove-old',
		'build-styles:copy',
		'build-styles:less',
		'build-styles:sass',
		'build-styles:normal',
		'build-styles:minified',
		'concat-styles'
	);
});

gulp.task('build-scripts', function() {
	return runSequence(
		'build-scripts:remove-old',
		'build-scripts:copy',
		'build-scripts:normal',
		'build-scripts:minified',
		'concat-scripts'
	);
});

gulp.task('build-images', function() {
	if (use_image_opt) {
		return gulp.src(source_dir + '/**/*.+(gif|jpeg|jpg|png)', {base:source_dir}).
			pipe(imageOpt({
				optimizationLevel: 5,
				progressive: true,
				interlaced: true
			})).
			pipe(gulp.dest(build_dir));
	} else {
		log('use_image_opt must be set to TRUE in your gulpfile in order to optimize images');
	}
});

gulp.task('concat', function() {
	return runSequence(
		'concat-styles',
		'concat-scripts'
	);
});

gulp.task('concat-styles', function() {
	if (concat_css) {
		return gulp.src(concat_css_list).
			pipe(concatCss('all.min.css')).
			pipe(minifyCSS()). // because for some (retarded) reason, concatCss unminifies css
			pipe(gulp.dest(build_styles_dir));
	} else {
		log('concat_css must be set to TRUE in your gulpfile in order to concat styles');
	}
});

gulp.task('concat-scripts', function() {
	if (concat_js) {
		return gulp.src(concat_js_list).
			pipe(concatJs('all.min.js')).
			pipe(gulp.dest(build_scripts_dir));
	} else {
		log('concat_js must be set to TRUE in your gulpfile in order to concat scripts');
	}
});

gulp.task('watch', function() {
	
	// Warn about Gulp/Gaze issues
	log(gutil.colors.bgBlack.white(gutil.colors.bold.red("[IMPORTANT]") + " Watch works very well for MOST things, however it does have some issues, including problems removing directories. (hint: use the 'build' task to compensate) - " + gutil.colors.bold.cyan("https://github.com/gulpjs/gulp/issues/651")));
	// Notice about 3 second save
	log(gutil.colors.bgBlack.white(gutil.colors.bold("[NOTICE]") + " Please avoid saving a file more than once within a 3 second period."));
	
	// General
	gulp.watch([
		source_dir + '/**/*',
		'!' + source_styles_dir + '/**/*',
		'!' + source_scripts_dir + '/**/*',
		'!' + source_dir + '/**/*.+(gif|jpeg|jpg|png)'
	], function(event) {
		log_event(event);
		// gulp.src ignores paths that don't exist, so renaming works as expected.
		gulp.src(event.path, {base:source_dir}).
			pipe(gulp.dest(build_dir));
		if (event.type === 'deleted') { // update the build dir when a file is deleted
			gulp.src(build_dir + '/' + event.path.substring((cwd + '/' + source_dir + '/').length), {read: false}).
				pipe(rimraf());
		}
	});
	
	// Styles
	// NOTE: Avoid saving styles more than once every 3 seconds
	gulp.watch([source_styles_dir + '/**/*', '!' + source_dir + '/**/*.+(gif|jpeg|jpg|png)'], function(event) {
		log_event(event);
		if (event.type !== 'renamed') { // prevents double run on rename
			runSequence(
				'build-styles:remove-old',
				'build-styles:copy',
				'build-styles:less',
				'build-styles:sass',
				'build-styles:normal',
				'build-styles:minified',
				'concat-styles'
			);
		}
	});
	
	// Scripts
	// NOTE: Avoid saving scripts more than once every 3 seconds
	gulp.watch([source_scripts_dir + '/**/*', '!' + source_dir + '/**/*.+(gif|jpeg|jpg|png)'], function(event) {
		log_event(event);
		if (event.type !== 'renamed') { // prevents double run on rename
			runSequence(
				'build-scripts:remove-old',
				'build-scripts:copy',
				'build-scripts:normal',
				'build-scripts:minified',
				'concat-scripts'
			);
		}
	});
	
	// Images
	// NOTE: Avoid re-saving the same image more than once every 3 seconds
	gulp.watch(source_dir + '/**/*.+(gif|jpeg|jpg|png)', function(event) {
		log_event(event);
		if (use_image_opt) {
			// gulp.src ignores paths that don't exist, so renaming works as expected.
			gulp.src(event.path, {base:source_dir}).
				pipe(imageOpt({
					optimizationLevel: 5,
					progressive: true,
					interlaced: true
				})).
				pipe(gulp.dest(build_dir));
		} else {
			// gulp.src ignores paths that don't exist, so renaming works as expected.
			gulp.src(event.path, {base:source_dir}).
				pipe(gulp.dest(build_dir));
		}
		if (event.type === 'deleted') { // update the build dir when a file is deleted
			gulp.src(build_dir + '/' + event.path.substring((cwd + '/' + source_dir + '/').length), {read: false}).
				pipe(rimraf());
		}
	});
});

/**
 * Sub-Tasks
 */

/*** Build ***/

gulp.task('build:remove-old', function() {
	return gulp.src(build_dir, {read: false}).
		pipe(rimraf());
});

gulp.task('build:copy', function() {
	return gulp.src(source_dir + '/**/*').
		pipe(gulp.dest(build_dir));
});

/*** Build Styles ***/

gulp.task('build-styles:remove-old', function() {
	return gulp.src(build_styles_dir, {read: false}).
		pipe(rimraf());
});

gulp.task('build-styles:copy', function() {
	return gulp.src(source_styles_dir + '/**/*').
		pipe(gulp.dest(build_styles_dir));
});

gulp.task('build-styles:less', function() {
	if (use_less) {
		return gulp.src(source_styles_dir + '/**/*.less').
			pipe(less()).
			pipe(gulp.dest(build_styles_dir)).
			pipe(minifyCSS()).
			pipe(rename(function (path) {
				path.extname = '.min.css';
			})).
			pipe(gulp.dest(build_styles_dir));
	} else {
		log('use_less must be set to TRUE in your gulpfile in order to generate CSS files from LESS files');
	}
});

gulp.task('build-styles:sass', function() {
	if (use_sass) {
		return gulp.src(source_styles_dir + '/**/*.+(sass|scss)').
			pipe(scss()).
			pipe(gulp.dest(build_styles_dir)).
			pipe(minifyCSS()).
			pipe(rename(function (path) {
				path.extname = '.min.css';
			})).
			pipe(gulp.dest(build_styles_dir));
	} else {
		log('use_sass must be set to TRUE in your gulpfile in order to generate CSS files from SASS or SCSS files');
	}
});

gulp.task('build-styles:normal', function() {
	return gulp.src([source_styles_dir + '/**/*.css', '!' + source_styles_dir + '/**/*.min.css']).
		pipe(gulp.dest(build_styles_dir)).
		pipe(minifyCSS()).
		pipe(rename(function (path) {
			path.extname = '.min.css';
		})).
		pipe(gulp.dest(build_styles_dir));
});

gulp.task('build-styles:minified', function() {
	return gulp.src(source_styles_dir + '/**/*.min.css').
		pipe(gulp.dest(build_styles_dir));
});

/*** Build Scripts ***/

gulp.task('build-scripts:remove-old', function() {
	return gulp.src(build_scripts_dir, {read: false}).
		pipe(rimraf());
});

gulp.task('build-scripts:copy', function() {
	return gulp.src(source_scripts_dir + '/**/*').
		pipe(gulp.dest(build_scripts_dir));
});

gulp.task('build-scripts:normal', function() {
	return gulp.src([source_scripts_dir + '/**/*.js', '!' + source_scripts_dir + '/**/*.min.js']).
		pipe(gulp.dest(build_scripts_dir)).
		pipe(uglify({outSourceMap: true})).
		pipe(rename(function (path) {
			path.extname = '.min.js';
		})).
		pipe(gulp.dest(build_scripts_dir));
});

gulp.task('build-scripts:minified', function() {
	return gulp.src(source_scripts_dir + '/**/*.min.js').
		pipe(gulp.dest(build_scripts_dir));
});
