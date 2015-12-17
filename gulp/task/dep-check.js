var gulp = require('gulp-help')(require('gulp'));

/**
 * Check all gulp dependencies.
 */
gulp.task('dep-check', 'Check all gulp dependencies.', function() {
	// Setup Vars
	var
		npm_check = require('npm-check'),
		spawn     = require('child_process').spawn,
		util      = require('gulp-util'),
		conf      = require('../config'),
		cli       = require('../cli'),
		get_task  = require('../function/get-task'),
		gulp_rm   = require('../function/gulp-rm'),
		mv        = require('gulp-rename'),
		less      = require('gulp-less'),
		sass      = require('gulp-sass'),
		css_min   = require('gulp-minify-css'),
		js_mim    = require('gulp-uglify'),
		concat    = require('gulp-concat-util'),
		svg2png   = require('gulp-svg2png'),
		img_opt   = require('gulp-image-optimization'),
		insert    = require('gulp-insert'),
		md2html   = require('gulp-markdown'),
		html2pdf  = require('gulp-html-pdf'),
		sequence  = require('run-sequence'),
		yargs     = require('yargs'),
		line_ends = require('gulp-eol'),
		// Aliases
		build     = conf.build,
		paths     = build.paths,
		color     = util.colors;
	
	return npm_check({
		"update": true,
		"skipUnused": true
	}).then(function(data) {
		cli.log(color.yellow('<module>: <installed> == <latest>'));
		for(var index in data) {
			var dep = data[index];
			if (dep.latest == dep.installed) {
				cli.log(dep.moduleName + ': ' + color.green(dep.installed + ' == ' + dep.latest));
			} else {
				cli.log(dep.moduleName + ': ' + color.red(dep.installed + ' != ' + dep.latest));
			}
		}
	});
});
