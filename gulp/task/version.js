// Setup Vars
var
	gulp = require('gulp-help')(require('gulp')),
	conf = require('../config'),
	cli  = require('../cli');

/**
 * Display the current version, copyright, and license
 */
gulp.task('version', 'Display the current version, copyright, and license info.', function() {
	cli.log(
		'\nSemantic UI for WordPress: Developer Edition v' + conf.package.version
		+ '\nCopyright: ' + conf.package.author
		+ '\nLicense: '   + conf.package.license.type
	);
});
