"use strict"

import { addClassOnClick, clickOutside, removeClassOnScroll } from "./tools/functions.js";

const notificationBar = document.querySelector('.notification-bar'),
    notificationBarModal = notificationBar.querySelector('.notification-bar__modal'),
    notificationBarIcon = notificationBar.querySelector('.notification-bar__icon');

addClassOnClick(notificationBarIcon, 'open', [notificationBarModal, notificationBarIcon]);
clickOutside(notificationBar,'open',[notificationBarModal, notificationBarIcon]);
removeClassOnScroll('open',[notificationBarModal, notificationBarIcon])