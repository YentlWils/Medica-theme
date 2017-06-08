/**
 * Build frontend dependencies
 */
"use strict";

module.exports.build = (gulp, plugins, config) => {

  let exec = require('child_process').exec;

  return () => {

    // Run bower installer for the latest dependencies.
    return exec('bower-installer', (err, stdout, stderr) => {
      console.log(stdout);
      console.log(stderr);

      // Build incremental DOM script
      let script = 'cd bower_components/incremental-dom && npm install --ignore-scripts && gulp js-dist';

      exec(script, (err, stdout, stderr) => {
        console.log(stdout);
        console.log(stderr);

        // Run bower installer again to copy incremental DOM library to the correct place..
        exec('bower-installer', (err, stdout, stderr) => {
          console.log(stdout);
          console.log(stderr);

          gulp.start('sass');
          gulp.start('copy:fonts');
          gulp.start('copy:images:assets');
          gulp.start('copy:vendor:css');
          gulp.start('copy:vendor:js');
        });
      });

    });
  };


};