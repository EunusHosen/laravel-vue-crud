import { createRouter, createWebHistory } from 'vue-router'
import TasksView from '@/views/TasksView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: TasksView
    },
    {
      path: '/completed',
      name: 'completed',
      component: () => import('@/views/CompletedView.vue')
    },
    {
      path: '/tasks/create',
      name: 'tasks.new',
      component: () => import('@/views/NewTaskView.vue')
    },
    {
      path: '/tasks/:id',
      name: 'tasks.show',
      component: () => import('@/views/TaskView.vue')
    },
    {
      path: '/tasks/:id/edit',
      name: 'tasks.edit',
      component: () => import('@/views/EditTaskView.vue')
    }
  ]
})

export default router
