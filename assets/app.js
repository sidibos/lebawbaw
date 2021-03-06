/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
//import './styles/app.css';
import './styles/app.scss';
import './styles/custom.scss';
//import './styles/maps/style.css.map';


// start the Stimulus application
import './bootstrap';

// loads the jquery package from node_modules
import jquery from 'jquery';

import './scripts';

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
import greet from './greet';
$(document).ready(function() {
    $('body').prepend('<h1>'+greet('jill')+'</h1>');
});

const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});