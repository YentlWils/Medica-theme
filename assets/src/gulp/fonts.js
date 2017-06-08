/**
 * Copy font files to releases folder
 */
"use strict";

module.exports.copy = (gulp, plugins, config) => {

  return () => {
    return gulp
      .src(config.fontSrc + '/**/*')
      .pipe(gulp.dest(config.fontDest));
  };
  
};
