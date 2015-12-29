module.exports = function() {
	// Setup Vars
	var
		conf = require('../config'),
		cli  = require('../cli');
	
	cli.log(
		'\nSemantic UI for WordPress: Developer Edition v' + conf.package.version
		+ '\nCopyright: ' + conf.package.author
		+ '\nLicense: '   + conf.package.license.type
	);
};
