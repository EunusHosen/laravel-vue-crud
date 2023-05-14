import axios from 'axios'
import { defineStore } from 'pinia'
import type TaskInterface from '@/types/Task'

const apiRoot = import.meta.env.VITE_APP_API_URL

export const useTasksStore = defineStore('tasks', {
  state: () => ({
    currentTask: {} as TaskInterface,
    tasks: {
      data: Array as () => TaskInterface[],
      meta: Object as () => { last_page: number; current_page: number }
    },
    completedTasks: {
      data: Array as () => TaskInterface[],
      meta: Object as () => { last_page: number; current_page: number }
    }
  }),

  actions: {
    async fetchTasks(page: number = 1) {
      const response = await axios.get(`${apiRoot}/tasks?page=${page}`)
      this.tasks = response.data
    },

    async fetchNextTasks() {
      if (this.tasks.meta.current_page < this.tasks.meta.last_page) {
        await this.fetchTasks(this.tasks.meta.current_page + 1)
      }
    },

    async fetchPreviousTasks() {
      if (this.tasks.meta.current_page > 1) {
        await this.fetchTasks(this.tasks.meta.current_page - 1)
      }
    },

    async fetchCompletedTasks(page: number = 1) {
      const response = await axios.get(`${apiRoot}/completed-tasks?page=${page}`)
      this.completedTasks = response.data
    },

    async fetchNextCompletedTasks() {
      if (this.completedTasks.meta.current_page < this.completedTasks.meta.last_page) {
        await this.fetchCompletedTasks(this.completedTasks.meta.current_page + 1)
      }
    },

    async fetchPreviousCompletedTasks() {
      if (this.completedTasks.meta.current_page > 1) {
        await this.fetchCompletedTasks(this.completedTasks.meta.current_page - 1)
      }
    },

    async addTask(task: TaskInterface) {
      await axios.post(`${apiRoot}/tasks`, task)
    },

    async fetchTask(id: number) {
      const response = await axios.get(`${apiRoot}/tasks/${id}`)
      this.currentTask = response.data.data
    },

    async updateTask(task: TaskInterface) {
      await axios.put(`${apiRoot}/tasks/${task.id}`, task)
    },

    async toggleComplete(id: number) {
      await axios.put(`${apiRoot}/tasks/${id}/complete`)
    },

    async deleteTask(task: TaskInterface) {
      await axios.delete(`${apiRoot}/tasks/${task.id}`)
      if (task.completed) {
        await this.fetchCompletedTasks()
      } else {
        await this.fetchTasks()
      }
    }
  }
})
