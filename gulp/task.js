/**
 * TASK FUNCTION MAPPING
 * =====================
 * Each task function maps to a task file.
 * 
 * Notes:
 * - Function names are camelCase and underscores replace slashes
 * - Require paths are done like URL paths
 */
module.exports = {
	"build":                  require('./task/build'),
	"buildScripts":           require('./task/build-scripts'),
	"buildStyles":            require('./task/build-styles'),
	"buildDocs":              require('./task/build-docs'),
	"buildLogo":              require('./task/build-logo'),
	"buildReadme":            require('./task/build-readme'),
	"buildScreenshot":        require('./task/build-screenshot'),
	"depCheck":               require('./task/dep-check'),
	"fixLineEndings":         require('./task/fix-line-endings'),
	"optimizeImages":         require('./task/optimize-images'),
	"test":                   require('./task/test'),
	"version":                require('./task/version'),
	"watch":                  require('./task/watch'),
	// Sub-Tasks
	"build_copy":             require('./task/build/copy'),
	"build_removeOld":        require('./task/build/remove-old'),
	"buildScripts_concat":    require('./task/build-scripts/concat'),
	"buildScripts_copy":      require('./task/build-scripts/copy'),
	"buildScripts_js":        require('./task/build-scripts/js'),
	"buildScripts_minify":    require('./task/build-scripts/minify'),
	"buildScripts_removeOld": require('./task/build-scripts/remove-old'),
	"buildStyles_concat":     require('./task/build-styles/concat'),
	"buildStyles_copy":       require('./task/build-styles/copy'),
	"buildStyles_css":        require('./task/build-styles/css'),
	"buildStyles_less":       require('./task/build-styles/less'),
	"buildStyles_minify":     require('./task/build-styles/minify'),
	"buildStyles_removeOld":  require('./task/build-styles/remove-old'),
	"buildStyles_sass":       require('./task/build-styles/sass')
};
