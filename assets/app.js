/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

const $ = require('jquery');
// create global $ and jQuery variables
global.$ = global.jQuery = $;
//window.$ = $;
//window.jQuery = $;

require('bootstrap');

// var $ = require('jquery');
// window.$ = $;
// window.jQuery = $;

//require('bootstrap-star-rating');
// require 2 CSS files needed
//require('bootstrap-star-rating/css/star-rating.css');
//require('bootstrap-star-rating/themes/krajee-svg/theme.css');

// any CSS you import will output into a single css file (app.css in this case)
//import './styles/app.css';
import './styles/app.scss';
import './styles/custom.scss';
//import './styles/maps/style.css.map';


// start the Stimulus application

// loads the jquery package from node_modules
//import jQuery from 'jquery';

import './scripts';

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
import greet from './greet';
// $(document).ready(function() {
//     $('body').prepend('<h1>'+greet('jill')+'</h1>');
// });

//const $ = require('jquery');
//require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});


//export {$};