module.exports = function() {
	// Setup Vars
	var sequence = require('run-sequence');
	
	return sequence(
		'build-styles/remove-old',
		'build-styles/copy',
		'build-styles/less',
		'build-styles/sass',
		'build-styles/css',
		'build-styles/minify',
		'build-styles/concat',
		'fix-line-endings'
	);
};
