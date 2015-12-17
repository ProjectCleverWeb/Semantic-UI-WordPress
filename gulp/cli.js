/**
 * Command Line Interface
 */
module.exports = {
	"cwd": process.cwd(),
	"run": function(cmd) {
		require('child_process').exec(cmd, function (err, stdout, stderr) {
			console.log(stdout);
			console.log(stderr);
		});
	},
	"log": function (msg) {
		// Setup Vars
		var util = require('gulp-util');
		util.log(msg);
	},
	"log_event": function (event) {
		// Setup Vars
		var
			conf  = require('./config'),
			util  = require('gulp-util'),
			// Aliases
			build = conf.build,
			paths = build.paths,
			color = util.colors;
		
		log_type = color.bold.cyan('[' + event.type.toUpperCase() + ']');
		log_path = event.path.substring((this.cwd + '/' + paths.source + '/').length);
		
		this.log(color.bgBlack(log_type + ' ' + log_path));
	}
};
