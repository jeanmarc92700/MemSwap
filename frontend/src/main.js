import { createApp } from 'vue'
import App from './App.vue'
import TaskList from './components/TaskList.vue'
import CalendarView from './components/CalendarView.vue'

import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  { path: '/', redirect: '/calendar' },
  { path: '/calendar', component: CalendarView },
  { path: '/tasks', component: TaskList }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

createApp(App).use(router).mount('#app')
