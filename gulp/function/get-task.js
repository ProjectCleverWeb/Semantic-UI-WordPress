/**
 * Simple function to get tasks
 */
module.exports = function(name) {
	var cli = require('../cli');
	require(cli.cwd + '/gulp/task/' + name);
}
