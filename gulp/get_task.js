/**
 * Simple function to get tasks
 */
module.exports = function(name) {
	require('./task/' + name);
}
