/**
 * JavaScript tasks
 */
"use strict";

module.exports.copy = (gulp, plugins, config) => {
    return () => {
        return gulp
            .src(config.jsSrc + '/vendor/**/*.js')
            .pipe(gulp.dest(config.jsDest + '/vendor'))
    };

};

module.exports.babel = (gulp, plugins, config) => {

    return () => {
        return gulp
            .src(config.jsSrc + '/**/*.js')
            .pipe(plugins.plumber())
            .pipe(plugins.cached('babel'))
            .pipe(plugins.babel({
                "comments": false,
                "presets": ["es2015-without-strict"],
                "ignore": ["vendor", "lib"],
                "plugins": [
                    "syntax-flow",
                    "transform-flow-strip-types",
                    "transform-es3-member-expression-literals", // Use for the limitations of the YUI compressor in AEM client libs see: https://github.com/yui/yuicompressor/issues/234
                    "transform-es3-property-literals" // Use for the limitations of the YUI compressor in AEM client libs see: https://github.com/yui/yuicompressor/issues/234
                ],
            }))
            .pipe(gulp.dest(config.jsDest));
    };

};

module.exports.flowTypeServer = () => {

    return () => {
        var util = require('util'),
            childProcess = require("child_process");

        var process = childProcess.spawn('node', ["node_modules/flow-bin/cli.js", "server"]);

        process.stdout.on('data', function (data) {
            console.log(data.toString());
        });

        process.stderr.on('data', function (data) {
            console.log(data.toString());
        });

        process.on('exit', (code) => {
            if (code > 0) {
                console.log('child process exited with code ' + code.toString());
            }
        });
    };
};

module.exports.flowTypeStopServer = () => {

    return () => {
        var util = require('util'),
            childProcess = require("child_process");

        var process = childProcess.spawn('node', ["node_modules/flow-bin/cli.js", "stop"]);

        process.stdout.on('data', function (data) {
            console.log(data.toString());
        });

        process.stderr.on('data', function (data) {
            console.log(data.toString());
        });

        process.on('exit', (code) => {
            if (code > 0) {
                console.log('child process exited with code ' + code.toString());
            }
        });
    };
};

module.exports.flowTypeStatus = () => {

    return () => {
        var util = require('util'),
            childProcess = require("child_process");

        var process = childProcess.spawn('node', ["node_modules/flow-bin/cli.js", "status", "--no-auto-start"], {stdio: 'inherit'});

        process.on('exit', (code) => {
            if (code > 0) {
                console.log('child process exited with code ' + code.toString());
            }
        });
    };
};

module.exports.clientLibsSourceMaps = (gulp, plugins, config) => {
    return () => {
        return gulp
            .src([config.jsDest + '/!(vendor|plugin)**/*.js'])
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.concat('medica.js'))
            .pipe(plugins.uglify({
                mangle: true,
                compress: true
            }))
            .pipe(plugins.sourcemaps.write('./', {

            }))
            .pipe(gulp.dest(config.jsDest));
    };
};

