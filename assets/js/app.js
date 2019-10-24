/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../css/global.scss');

require('bootstrap');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

window.jQuery = require('jquery');
window.chartJs = require('chart.js');
window.lighBox = require('ekko-lightbox/dist/ekko-lightbox.js');

window.AppTrack = require('./components/appTrack.js');
window.StarRating = require('./components/starRating');

window.MapControlFullScreen =  require('./map/control/fullScreen')
window.jsUpload = require('./components/fileUpload');
window.bsCustomFileInput = require('bs-custom-file-input');


window.geojson = {
    Sofia: require('./map/geojson/Sofia.json'),
    Sofia_Grad: require('./map/geojson/Sofia-City.json'),
};
