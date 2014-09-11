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
 *       ordered alphabetically. This mean that "LESS" will be compiled before
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
		'highlight.js/github.css',
		'semantic.min.css',
		'main.css'
	],
	concat_js       = false, // output is to "all.min.js" (each file must be specified below)
	concat_js_list  = [ // paths are relative to build_scripts_dir
		'semantic.min.js',
		'highlight.pack.min.js',
		'mousetrap.min.js',
		'main.js'
	];

// Paths (no trailing or leading slashes!)
var
	source_dir   = 'src',
	build_dir   = 'build',
	source_styles_dir   = 'src/assets/styles',
	build_styles_dir    = 'build/assets/styles',
	source_scripts_dir  = 'src/assets/scripts',
	build_scripts_dir   = 'build/assets/scripts';

// Utility
var
	spawn       = require('child_process').spawn,
	gulp        = require('gulp'),
	concat      = require('gulp-concat'),
	concat      = require('gulp-concat-css'),
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

function log_event(event) {
	gutil.log(event.type+': '+event.path);
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
		y('concat-all') + "     " + r('Not implemented') + " (yet)\n  " +
		y('concat-styles') + "  " + r('Not implemented') + " (yet)\n  " +
		y('concat-scripts') + " " + r('Not implemented') + " (yet)\n  " +
		y('watch') + "          Watch /" + source_dir + " for changes, update /" + build_dir + " on change (no image opt)\n  " +
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
		'build-scripts:remove-old',
		'build-scripts:copy',
		'build-scripts:normal',
		'build-scripts:minified',
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
		'build-styles:minified'
	);
});

gulp.task('build-scripts', function() {
	return runSequence(
		'build-scripts:remove-old',
		'build-scripts:copy',
		'build-scripts:normal',
		'build-scripts:minified'
	);
});

gulp.task('build-images', function() {
	if (use_image_opt) {
		return gulp.src([
			source_dir + '/**/*.png',
			source_dir + '/**/*.jpg',
			source_dir + '/**/*.gif',
			source_dir + '/**/*.jpeg'
		], {base:source_dir}).pipe(imageOpt({
			optimizationLevel: 5,
			progressive: true,
			interlaced: true
		})).
			pipe(gulp.dest(build_dir));
	}
});

gulp.task('watch', function() {
	
	// General
	gulp.watch([
		source_dir + '/**/*',
		'!' + source_styles_dir + '/**/*',
		'!' + source_scripts_dir + '/**/*'
	], {on:'all'}, function(event) {
		log_event(event);
		gulp.src(event.path, {base:'src/'}).
			pipe(gulp.dest(build_dir));
	});
	
	// Styles
	gulp.watch(source_styles_dir + '/**/*', {on:'all'}, function(event) {
		log_event(event);
		runSequence(
			'build-styles:remove-old',
			'build-styles:copy',
			'build-styles:less',
			'build-styles:sass',
			'build-styles:normal',
			'build-styles:minified'
		);
	});
	
	// Scripts
	gulp.watch(source_scripts_dir + '/**/*', {on:'all'}, function(event) {
		log_event(event);
		runSequence(
			'build-scripts:remove-old',
			'build-scripts:copy',
			'build-scripts:normal',
			'build-scripts:minified'
		);
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
	}
});

gulp.task('build-styles:sass', function() {
	if (use_sass) {
		return gulp.src([source_styles_dir + '/**/*.scss', source_styles_dir + '/**/*.sass']).
			pipe(scss()).
			pipe(gulp.dest(build_styles_dir)).
			pipe(minifyCSS()).
			pipe(rename(function (path) {
				path.extname = '.min.css';
			})).
			pipe(gulp.dest(build_styles_dir));
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
