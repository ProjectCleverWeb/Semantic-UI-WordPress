module.exports = function() {
	// Setup Vars
	var sequence = require('run-sequence');
	
	return sequence(
		'build-scripts/remove-old',
		'build-scripts/copy',
		'build-scripts/js',
		'build-scripts/minify',
		'build-scripts/concat',
		'fix-line-endings'
	);
};
