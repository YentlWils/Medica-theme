/**
 * POT files tasks
 */
"use strict";

module.exports.generatePOTFiles = (gulp, plugins, config) => {

    return () => {
        return gulp
            .src([config.PHPSrc])
            .pipe(plugins.wpPot({
                domain: 'medica-theme',
                package: 'Medica Website'
            }))
            .pipe(gulp.dest(config.PHPLanguageDest + "medica-theme.pot"));
    };
};

