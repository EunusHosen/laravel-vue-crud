export default interface TaskInterface {
  id: number
  name: string
  description: string
  completed: boolean
  dueDate: string
  overdue?: boolean
}
