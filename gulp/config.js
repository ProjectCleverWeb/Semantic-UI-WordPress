// Configuration Notes
// -------------------
// * The default config for concat is just for the front-end of the site,
//     the WordPress dashboard and other pages that may require a specific
//     stylesheet or script configuration should specify the files they need.
// * Concat is always run after LESS/SASS is compiled
// * Some tasks are broken down to allow synchronous behavior (important)
// * All paths in configuration variables SHOULD NOT have leading or trailing
//     slashes UNLESS they are absolute paths from PC's root path. Only then
//     is a leading slash allowed.
// * When order is not required to complete a set of actions, the actions are
//     ordered alphabetically. This means that "LESS" will be compiled before
//     "SASS" and files starting with "a" will be used before files that
//     start with "b", "c", etc.

var
	cli   = require('./cli'),
	fs    = require('fs'),
	util  = require('gulp-util');
	// Aliases
	color = util.colors;

// Get Configuration
if (fs.existsSync(cli.cwd + '/build.json')) {
	cli.log('Using build config ' + color.magenta(fs.realpathSync(cli.cwd + '/build.json')));
	var build = require(cli.cwd + '/build.json');
} else if (fs.existsSync(cli.cwd + '/default_build.json')) {
	cli.log('Using build config ' + color.magenta(fs.realpathSync(cli.cwd + '/default_build.json')));
	var build = require(cli.cwd + '/default_build.json');
} else {
	cli.log(color.red('[ERROR] No valid build configuration file found in ' + cli.cwd));
	process.exit();
}

module.exports = {
	"build"    : build,
	"package"  : require('../package.json'),
	"composer" : require('../composer.json')
}
