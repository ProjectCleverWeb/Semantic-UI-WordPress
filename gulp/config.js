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

// Get Configuration
module.exports = {
	"build"    : require('../build.json'),
	"package"  : require('../package.json'),
	"composer" : require('../composer.json')
}
