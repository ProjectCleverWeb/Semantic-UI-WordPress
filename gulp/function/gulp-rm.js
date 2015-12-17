/**
 * Simple function remove files in pipe
 */
module.exports = function(stream, options) {
	del         = require('del');
	vinyl_paths = require('vinyl-paths');
	return vinyl_paths(del);
};
