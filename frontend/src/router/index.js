import { createRouter, createWebHistory } from 'vue-router'
import CalendarPage from '../views/CalendarPage.vue'
import TaskPage from '../views/TaskPage.vue'

const routes = [
  { path: '/', redirect: '/calendar' },
  { path: '/calendar', component: CalendarPage },
  { path: '/tasks', component: TaskPage }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
