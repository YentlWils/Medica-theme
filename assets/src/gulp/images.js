/**
 * Copy images files to releases folder
 */
"use strict";

module.exports.copy = (gulp, plugins, config) => {

  return () => {
    return gulp
      .src(config.imageSrc)
      .pipe(gulp.dest(config.imageDest + '/assets'));
  };

};
