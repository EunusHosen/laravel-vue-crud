import axios from 'axios'
import { defineStore } from 'pinia'
import type TaskInterface from '@/types/Task'

const apiRoot = import.meta.env.VITE_APP_API_URL

export const useTasksStore = defineStore('tasks', {
  state: () => ({
    currentTask: {} as TaskInterface,
    tasks: [] as TaskInterface[],
    completedTasks: [] as TaskInterface[]
  }),

  actions: {
    async fetchTasks() {
      const response = await axios.get(`${apiRoot}/tasks`)
      this.tasks = response.data.data
    },

    async fetchCompletedTasks() {
      const response = await axios.get(`${apiRoot}/completed-tasks`)
      this.completedTasks = response.data.data
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

    async deleteTask(id: number) {
      await axios.delete(`${apiRoot}/tasks/${id}`)
      this.tasks = this.tasks.filter((task) => task.id !== id)
      this.completedTasks = this.completedTasks.filter((task) => task.id !== id)
    }
  }
})
