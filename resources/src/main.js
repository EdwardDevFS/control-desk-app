import { createApp } from "vue";
import App from "./App.vue";
import router from './router';
import PrimeVue from 'primevue/config'

import 'primevue/resources/themes/lara-light-blue/theme.css'
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css'


const app = createApp(App);

app.use(router);
app.use(PrimeVue,{
    ripple: true,
    inputStyle: "filled",
    zIndex: {
        modal: 1100,        //dialog, sidebar
        overlay: 1000,      //dropdown, overlaypanel
        menu: 1000,         //overlay menus
        tooltip: 1100       //tooltip
    },
    
});

app.mount('#app');