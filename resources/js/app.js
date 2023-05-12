require('./bootstrap')

import './bootstrap';
import '../sass/app.scss'
import Router from './router'
import store from './store'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
// import 'element-plus/lib/theme-chalk/index.css';

import { createApp } from 'vue/dist/vue.esm-bundler';

const app = createApp({})
app.use(Router)
app.use(store)
app.use(ElementPlus, { size: 'medium', zIndex: 3000 })
app.mount('#app')