import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

$ = require("jquery");

global.$ = global.jQuery = $;

$(document).ready(function () {
    // Not front-end developer, alpine for some reason isn't co-operating so reverting to olds chool JQuery
    $('#hamburger').on('click', function () {
        let menu = $('#mobile-menu');
        if (menu.hasClass('hidden')) {
            menu.removeClass('hidden');
        } else if (!menu.hasClass('hidden')) {
            menu.addClass('hidden');
        }
    })
})