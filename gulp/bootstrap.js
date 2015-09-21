/**
 * Do any prep work here
 */

// Setup Vars
var
	conf     = require('./config'),
	// Aliases
	build    = conf.build,
	paths    = build.paths;

// Expand Source & Dist. Paths
paths.source_styles  = paths.source + '/' + paths.styles;
paths.source_scripts = paths.source + '/' + paths.scripts;
paths.dist_styles    = paths.dist + '/' + paths.styles;
paths.dist_scripts   = paths.dist + '/' + paths.scripts;

// Make concat paths relative to their respective directories
for (i = 0; i < build.concat_css_files.length; i++) { 
	build.concat_css_files[i] = paths.dist_styles + '/' + build.concat_css_files[i];
}
for (i = 0; i < build.concat_js_files.length; i++) { 
	build.concat_js_files[i] = paths.dist_scripts + '/' + build.concat_js_files[i];
}
