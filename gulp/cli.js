// Setup Vars
var
	gulp  = require('gulp-help')(require('gulp')),
	spawn = require('child_process').spawn,
	conf  = require('./config'),
	util  = require('gulp-util');

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
		log_type = util.colors.bold.cyan('[' + event.type.toUpperCase() + ']');
		log_path = event.path.substring((this.cwd + '/' + conf.build.paths.source + '/').length);
		
		util.log(util.colors.bgBlack(log_type + ' ' + log_path));
	}
};

