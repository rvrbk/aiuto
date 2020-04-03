require('./bootstrap');

import vue from 'vue';
import vuerouter from 'vue-router';
import app from './components/app';
import map from './components/map';
import help from './components/help';
import offer from './components/offer';

vue.use(vuerouter);

const router = new vuerouter({
    routes: [{
        path: '/',
        component: app,
        children: [{
            name: 'map',
            path: '/map/:flash?',
            component: map
        }, {
            name: 'help',
            path: '/help',
            component: help
        }, {
            name: 'offer',
            path: '/offer/:help_id',
            component: offer
        }] 
    }]
});

new vue({
    el: '#vue-app',
    router
});
