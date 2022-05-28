require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('plan-selector', require('./components/PlanSelector.vue').default);
Vue.component('meme-viewer', require('./components/MemeViewer.vue').default);



const app = new Vue({
    el: '#app',
});
