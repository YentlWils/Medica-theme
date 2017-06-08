/**
 * General config
 */
"use strict";

let config = {};
config.supportedBrowsers = ['last 4 versions'];

config.styleSrc  = 'scss';
config.styleDest = '../dist/css';

config.jsSrc  = 'js';
config.jsDest = '../dist/js';

config.fontSrc  = 'fonts';
config.fontDest = '../dist/fonts';

config.imageSrc  = 'images/assets/**';
config.imageDest = '../dist/images';

module.exports = config;