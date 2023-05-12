// @ts-ignore
import TasksView from '@/views/TasksView.vue'
import { createRouter, createWebHistory } from 'vue-router'

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
      name: 'tasks.completed',
      // @ts-ignore
      component: () => import('@/views/CompletedView.vue')
    },
    {
      path: '/tasks/create',
      name: 'tasks.new',
      // @ts-ignore
      component: () => import('@/views/NewTaskView.vue')
    },
    {
      path: '/tasks/:id',
      name: 'tasks.show',
      // @ts-ignore
      component: () => import('@/views/TaskView.vue')
    },
    {
      path: '/tasks/:id/edit',
      name: 'tasks.edit',
      // @ts-ignore
      component: () => import('@/views/EditTaskView.vue')
    }
  ]
})

export default router
