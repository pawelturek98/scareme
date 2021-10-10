/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
'use strict';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/bootstrap.css'
import './styles/admin.css';

// start the Stimulus application
import './bootstrap';

Array.from(document.getElementsByClassName('delete-item')).forEach(function(item) {
    item.addEventListener('click', function() {
        if(!confirm(this.dataset.delete_message)) {
            return false;
        }

        fetch(item.dataset.delete_url, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                window.location = data.url;
            });
    })
});