// Setup Vars
var
	gulp     = require('gulp-help')(require('gulp')),
	spawn    = require('child_process').spawn,
	util     = require('gulp-util'),
	conf     = require('./config'),
	// Aliases
	build    = conf.build,
	paths    = build.paths,
	color    = util.colors;

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
		util.log(msg);
	},
	"log_event": function (event) {
		log_type = color.bold.cyan('[' + event.type.toUpperCase() + ']');
		log_path = event.path.substring((this.cwd + '/' + paths.source + '/').length);
		
		this.log(color.bgBlack(log_type + ' ' + log_path));
	}
};

