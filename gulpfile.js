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

// Check All Requirements and Setup Vars
var
	// Alias tasks only need to be registered once, so this is the only place we
	// call gulp/gulp-help like this.
	gulp     = require('gulp-help')(require('gulp'), { aliases: ['default', '?'] }),
	spawn    = require('child_process').spawn,
	util     = require('gulp-util'),
	conf     = require('./gulp/config'),
	cli      = require('./gulp/cli'),
	get_task = require('./gulp/get_task'),
	rm       = require('del'),
	mv       = require('gulp-rename'),
	less     = require('gulp-less'),
	sass     = require('gulp-sass'),
	css_min  = require('gulp-minify-css'),
	js_mim   = require('gulp-uglify'),
	concat   = require('gulp-concat-util'),
	svg2png  = require('gulp-svg2png'),
	img_opt  = require('gulp-image-optimization'),
	delay    = require('gulp-wait'),
	sequence = require('run-sequence'),
	// Aliases
	build    = conf.build,
	paths    = build.paths,
	color    = util.colors;

// Run Bootstrap
require('./gulp/bootstrap');

// Get Tasks
get_task('build');
get_task('watch');
get_task('build-styles');
get_task('build-scripts');
get_task('build-screenshot');
get_task('optimize-images');
get_task('test');
get_task('version');

// Get Sub-Tasks
get_task('build/copy');
get_task('build/remove-old');
get_task('build-styles/remove-old');
get_task('build-styles/copy');
get_task('build-styles/less');
get_task('build-styles/sass');
get_task('build-styles/css');
get_task('build-styles/minify');
get_task('build-styles/concat');
get_task('build-scripts/remove-old');
get_task('build-scripts/copy');
get_task('build-scripts/js');
get_task('build-scripts/minify');
get_task('build-scripts/concat');
