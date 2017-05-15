/**
 * Watch task
 */
"use strict";

module.exports.watch = (gulp, plugins, config) => {

  return () => {

    gulp.watch([ config.styleSrc + '/**/*.scss' ], [ 'sass' ]);

    gulp.watch([ config.jsSrc + '/**/*.js' ], ['babel', 'flowTypeStatus']);

    gulp.watch([ config.jsDest + '/!(vendor)/**/*.js' ], ['jsConcatMinifySourceMaps']);

  }

};