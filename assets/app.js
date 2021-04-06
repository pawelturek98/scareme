/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
'use strict';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/bootstrap.css'
import './styles/app.css';


// start the Stimulus application
import './bootstrap';


window.onload = (e) => {
    let menu_item = document.getElementById('main-navigation');
    let menu_item_clone = menu_item.cloneNode(true);
    let fixed_menu = document.getElementById('fixed-navbar');
    
    if(window.innerWidth >= 992) {
        let sticky_loaded = false;
        window.onscroll = () => {
            if(window.pageYOffset > menu_item.offsetTop) {
                if(!sticky_loaded) {
                    fixed_menu.appendChild(menu_item_clone);
                    sticky_loaded = true;
                }
            } else {
                if(sticky_loaded) {
                    menu_item_clone.parentNode.removeChild(menu_item_clone);
                    sticky_loaded = false;
                }
            }
        }
    }
}