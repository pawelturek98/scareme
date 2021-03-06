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

    /*  FIXED NAVIGATION  */
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

    document.getElementsByClassName('vote').forEach(function(item, index) {
        item.addEventListener('click', function(e) {
            let data = `type=${item.dataset.type}&post_id=${item.dataset.post}`;
            console.log("Type: " + item.dataset.type);
            console.log("Post ID" + item.dataset.post);
            fetch("/article/rating", {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: data
            })
                .then(response => {
                    if(!response.ok) {
                        throw Error(response.message);
                    }

                    return response.json()
                })
                .then(data => {
                    item.parentNode.querySelector(".count").textContent = item.dataset.type === "up" ? data.votes.up : data.votes.down;
                })
                .catch(function (error) {
                    alert("Ju?? zag??osowa??e?? !")
                })
        });
    });

    document.getElementById('newsletter_form').addEventListener('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.querySelector('.btn').style.background = "#5c636a";
        let form = this;

        if(this.querySelector('#email').value === "") {
            form.querySelector('.btn').style.background = "#8c0002";

            alert("Email nie mo??e by?? pusty");
            return;
        }

        let regexp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/
        if(!this.querySelector('#email').value.match(regexp)) {
            form.querySelector('.btn').style.background = "#8c0002";

            alert("Nale??y poda?? prawid??owy adres email");
            return;
        }

        fetch('/newsletter', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify({ email: this.querySelector('#email').value } )
        })
            .then(response => {
                if(!response.ok) {
                    throw Error(response.statusText);
                }

                return response.json()
            })
            .then(data => {
                // Temporary solution
                form.querySelector('.btn').style.background = "#8c0002";
                alert("Wpis zosta?? dodany!");
            })
            .catch(function (error) {
                form.querySelector('.btn').style.background = "#8c0002";
                alert(`Co?? posz??o nie tak!`);
            })
    });
};