import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    successMessage: '',

    menuItems: [
      {
        name: 'Tasks',
        to: '/'
      },
      {
        name: 'Completed Tasks',
        to: '/completed'
      }
    ]
  }),

  actions: {
    setSuccessMessage(message: string) {
      this.successMessage = message
    }
  }
})
