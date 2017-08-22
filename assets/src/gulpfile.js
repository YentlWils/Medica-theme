"use strict";

let plugins = require('gulp-load-plugins')();
let gulp    = require('gulp');

/*****************
 * CONFIGURATION
 *****************/

let config = require('./gulp/config');


/*******************
 * POT files tasks
 *******************/
// Copy font files to releases folder
gulp.task('generatePOTFiles', require('./gulp/pot').generatePOTFiles(gulp, plugins, config));


/**************
 * Copy tasks
 **************/
// Copy font files to releases folder
gulp.task('copy:fonts', require('./gulp/fonts').copy(gulp, plugins, config));

// Copy image assets files to releases folder
gulp.task('copy:images:assets', require('./gulp/images').copy(gulp, plugins, config));

// Copy vendor css files to releases folder
gulp.task('copy:vendor:css', require('./gulp/styling').copy(gulp, plugins, config));

// Copy vendor js files to releases folder
gulp.task('copy:vendor:js', require('./gulp/javascript').copy(gulp, plugins, config));


/*******************
 * Styling tasks
 *******************/

//Compile SASS files to releases folder
gulp.task('sass', require('./gulp/styling').sass(gulp, plugins, config));



/*******************
 * Build tasks
 *******************/

// Build browser dependencies
gulp.task('build:browser:dependencies', require('./gulp/build').build(gulp, plugins, config));

// Currently not used..
//gulp.task('bower-installer', require('./gulp/build').bower(gulp, plugins, config));


/*******************
 * JavaScript tasks
 *******************/

// Run babel on JS source files (ES6 & ES7 support)
gulp.task("babel", require('./gulp/javascript').babel(gulp, plugins, config));

// Starts a flow type server
gulp.task("flowTypeServer", require('./gulp/javascript').flowTypeServer());

gulp.task("flowTypeStopServer", require('./gulp/javascript').flowTypeStopServer());

// Check flow type status on file change
gulp.task("flowTypeStatus", require('./gulp/javascript').flowTypeStatus());

// Build client clientLibs file
gulp.task('jsConcatMinifySourceMaps', require('./gulp/javascript').clientLibsSourceMaps(gulp, plugins, config));


/**************
 * Watch task
 **************/

// Watch file changes for Babel en SASS compilation
gulp.task('watch', require('./gulp/watch').watch(gulp, plugins, config));

/**
 * Run browser-sync and start watching for file changes
 */
gulp.task('_default', [ 'watch']);

gulp.task('_generatePOTFiles', [ 'generatePOTFiles']);

gulp.task('_clientLibs', [ 'clientLibs' ]);

gulp.task('_flow-server', [ 'flowTypeServer' ]);

/**
 * Stop flow type server if still running for some reason (ex.: gulp task crashed)
 */
gulp.task('_stop-server', [ 'flowTypeStopServer' ]);

/**
 * Install / Update bower dependencies
 */
gulp.task('_install-latest-dependencies', [ 'build:browser:dependencies' ]);