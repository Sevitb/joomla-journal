"use strict"

import { clickOutside } from '../tools/functions.js';

const nav           = document.querySelector('.nav_horizontal'),
    navDropdownBtns = nav.querySelectorAll('.nav__dropdown-btn'),
    navSublists     = nav.querySelectorAll('.nav__sublist');

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
                    }
                });
            });
            
        }
    });

    document.addEventListener('click', (event) => {
        let isClickIside = false;
        navDropdownBtns.forEach(btn => {
            if (btn.contains(event.target) && btn.classList.contains('nav__dropdown-btn_level_1') && btn.classList.contains(className)) {
                isClickIside = true;
            }
        });
        navSublists.forEach(list => {
            if (list.classList.contains('nav__sublist_level_2') && list.contains(event.target)) {
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


if (mobileMenuIcon){
    mobileMenuIcon.onclick = ()=>{
        mobileMenuIcon.classList.toggle('open');
        nav.classList.toggle('open');
    }
}