/**
 * Styling tasks
 */
"use strict";

module.exports.copy = (gulp, plugins, config) => {
    return () => {
        return gulp
            .src('css/vendor/**/*.css')
            .pipe(gulp.dest(config.styleDest + '/vendor'))
    };

};

module.exports.sass = (gulp, plugins, config) => {

  return () => {

    let task = gulp.src([config.styleSrc + '/**/*.scss'])
        .pipe( plugins.sass({ outputStyle: 'compressed' }).on('error', plugins.sass.logError) )
        .pipe( plugins.postcss([
          require('postcss-flexibility'),
          require('postcss-flexboxfixer'),
          require('autoprefixer')({ browsers: config.supportedBrowsers}),
          require('postcss-sprites').default({
            stylesheetPath: config.styleDest,
            spritePath: config.imageDest + '/sprites/',
            spritesmith: {
              padding: 2
            },
            filterBy: (image) => {
              // Allow only files in the sprites folder
              if (!/[\/a-zA-Z-_.0-9]*sprites\/[\/a-zA-Z-_.0-9]*\.png$/.test(image.url)) {
                return Promise.reject();
              }
              return Promise.resolve();
            },
            groupBy: (image) => {
              let folders = image.url.split('/');
              let folderName = folders[folders.length-2];
              if (folderName === 'sprites') {
                return Promise.reject();
              }
              return Promise.resolve(folderName);
            }
          })
        ]) )
        .pipe( gulp.dest(config.styleDest) );

    return task;
  }

};
