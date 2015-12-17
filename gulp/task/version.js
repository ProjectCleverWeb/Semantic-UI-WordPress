var gulp = require('gulp-help')(require('gulp'));

/**
 * Display the current version, copyright, and license
 */
gulp.task('version', 'Display the current version, copyright, and license info.', function() {
	// Setup Vars
	var
		conf = require('../config'),
		cli  = require('../cli');
	
	cli.log(
		'\nSemantic UI for WordPress: Developer Edition v' + conf.package.version
		+ '\nCopyright: ' + conf.package.author
		+ '\nLicense: '   + conf.package.license.type
	);
});
