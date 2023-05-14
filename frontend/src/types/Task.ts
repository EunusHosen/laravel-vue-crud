export default interface TaskInterface {
  id: number
  name: string
  description: string
  completed: boolean
  dueDate: string
  overdue?: boolean
  createdAt: string
  completedAt: string

  meta: {
    current_page: number
    last_page: number
  }
}
