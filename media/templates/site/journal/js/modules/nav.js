"use strict"

import { clickOutside } from '../tools/functions.js';

const nav = document.querySelector('.jnav_horizontal'),
    navDropdownBtns = nav.querySelectorAll('.jnav__dropdown-btn'),
    navSublists = nav.querySelectorAll('.jnav__sublist');

const mobileMenuIcon = document.querySelector('.mobile-menu-icon');

const className = 'show';

if (navDropdownBtns && navSublists) {

    navDropdownBtns.forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                navSublists.forEach(list => {
                    if (list.dataset.navItemId == btn.dataset.navItemId) {
                        list.classList.toggle(className);
                        btn.classList.toggle(className);
                        console.log(list.classList.contains(className));
                    }
                });
            });

        }
    });

    document.addEventListener('click', (event) => {
        let isClickIside = false;
        navDropdownBtns.forEach(btn => {
            if (btn.contains(event.target) && btn.classList.contains('jnav__dropdown-btn_level_1') && btn.classList.contains(className)) {
                isClickIside = true;
            }
        });
        navSublists.forEach(list => {
            if (list.classList.contains('jnav__sublist_level_2') && list.contains(event.target)) {
                isClickIside = true;
            }
        });
        if (!isClickIside) {
            navDropdownBtns.forEach((item) => {
                if (item.classList.contains(className)) {
                    item.classList.remove(className);
                }
            });

            navSublists.forEach((item) => {
                if (item.classList.contains(className)) {
                    item.classList.remove(className);
                }
            });
        }
    });
}


if (mobileMenuIcon) {
    mobileMenuIcon.onclick = () => {
        mobileMenuIcon.classList.toggle('open');
        nav.classList.toggle('open');
        if (nav.classList.contains('open')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'unset';
        }
    }
}