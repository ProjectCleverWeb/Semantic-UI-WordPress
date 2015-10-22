// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	conf     = require('../config'),
	cli      = require('../cli'),
	insert   = require('gulp-insert'),
	md2html  = require('gulp-markdown'),
	html2pdf = require('gulp-html-pdf'),
	fs = require("fs"),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

/**
 * Generate HTML & PDF "README" from the project's README.md
 */
gulp.task('build-readme', 'Generate HTML & PDF "README" from the project\'s README.md', function() {
	return gulp.src(cli.cwd + '/README.md')
		.pipe(md2html())
		.pipe(insert.prepend(
			'<style type="text/css">' + fs.readFileSync(paths.dist_styles + '/base.concat.min.css', "utf-8") + '</style>'
			+ '<style type="text/css">' + fs.readFileSync(paths.dist_styles + '/main.min.css', "utf-8") + '</style>'
		))
		.pipe(insert.wrap('<html><body>', '</body></html>'))
		.pipe(gulp.dest(paths.dist))
		.pipe(html2pdf({
			"quality": '100',
			"border": "0.5in"
		}))
		.pipe(gulp.dest(paths.dist));
});
