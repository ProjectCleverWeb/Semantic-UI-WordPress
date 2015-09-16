/**
 * Do any prep work here
 */

var conf = require('./config');

// Expand Source & Dist. Paths
conf.build.paths.source_styles  = conf.build.paths.source + '/' + conf.build.paths.styles;
conf.build.paths.source_scripts = conf.build.paths.source + '/' + conf.build.paths.scripts;
conf.build.paths.dist_styles    = conf.build.paths.dist + '/' + conf.build.paths.styles;
conf.build.paths.dist_scripts   = conf.build.paths.dist + '/' + conf.build.paths.scripts;

// Make concat paths relative to their respective directories
for (i = 0; i < conf.build.concat_css_files.length; i++) { 
	conf.build.concat_css_files[i] = conf.build.paths.dist_styles + '/' + conf.build.concat_css_files[i];
}
for (i = 0; i < conf.build.concat_js_files.length; i++) { 
	conf.build.concat_js_files[i] = conf.build.paths.dist_styles + '/' + conf.build.concat_js_files[i];
}
