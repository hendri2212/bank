import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { useBankStore } from './store'

import App from './App.vue'
import router from './router'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
// import 'bootstrap/dist/js/bootstrap.min.js'
import bootstrap from 'bootstrap/dist/js/bootstrap.min.js'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(useBankStore())
app.use(bootstrap)

app.mount('#app')
