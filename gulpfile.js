// Setup Vars
var
	// Alias tasks only need to be registered once, so this is the only place we
	// call gulp/gulp-help like this.
	gulp     = require('gulp-help')(require('gulp'), { aliases: ['default', '?'] }),
	get_task = require('./gulp/function/get-task'),
	get_rm   = require('./gulp/function/gulp-rm');

// Run Bootstrap
require('./gulp/bootstrap')();

// Get Tasks
get_task('build');
get_task('watch');
get_task('build-logo');
get_task('build-readme');
get_task('build-docs');
get_task('build-styles');
get_task('build-scripts');
get_task('build-screenshot');
get_task('optimize-images');
get_task('test');
get_task('version');
get_task('dep-check');

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
