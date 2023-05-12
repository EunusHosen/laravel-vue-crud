<script setup lang="ts">
import { reactive } from 'vue'
import FormError from '@/components/form/FormError.vue'
import InputLabel from '@/components/form/InputLabel.vue'
import InputField from '@/components/form/InputField.vue'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import TextAreaField from '@/components/form/TextAreaField.vue'

const props = defineProps({
  name: {
    type: String,
    required: false
  },
  description: {
    type: String,
    required: false
  },
  dueDate: {
    type: String,
    required: false
  },
  errors: {
    type: Object,
    required: false,
    default: () => ({})
  },
  actionText: {
    type: String,
    required: false,
    default: 'Add Task'
  }
})

const task = reactive({
  name: props.name ?? '',
  description: props.description ?? '',
  dueDate: props.dueDate ?? ''
})

let validationErrors = reactive(props.errors)

const dateFormat = {
  date: 'YYYY-MM-DD',
  month: 'MMM'
}

const disabledDate = (date) => {
  const now = new Date()

  if (
    date.getFullYear() === now.getFullYear() &&
    date.getMonth() === now.getMonth() &&
    date.getDate() === now.getDate()
  ) {
    return false
  }

  return date < now
}

const emit = defineEmits(['submit'])
const submit = () => {
  const validations = ['name', 'description', 'dueDate']

  validations.forEach((field) => {
    if (!task[field]) {
      let fieldName = field.replace(/([A-Z])/g, ' $1').toLowerCase()
      validationErrors[field] = [`The ${fieldName} field is required`]
    } else {
      delete validationErrors[field]
    }
  })

  if (Object.keys(validationErrors).length === 0) {
    emit('submit', task)
  }
}
</script>

<template>
  <form @submit.prevent="submit" class="max-w-2xl">
    <div class="mb-6">
      <InputLabel htmlFor="name" label="Task Name" />
      <InputField type="text" name="name" id="name" v-model="task.name" placeholder="Task Name" />

      <FormError v-if="validationErrors && validationErrors.name" :errors="validationErrors.name" />
    </div>

    <div class="mb-6">
      <InputLabel htmlFor="description" label="Task Description" />
      <TextAreaField
        name="description"
        id="description"
        v-model="task.description"
        placeholder="Task Description"
      />
      <FormError
        v-if="validationErrors && validationErrors.description"
        :errors="validationErrors.description"
      />
    </div>

    <div class="mb-6">
      <InputLabel htmlFor="due-date" label="Due Date" />
      <VueTailwindDatepicker
        as-single
        for="due-date"
        placeholder="Due Date"
        :formatter="dateFormat"
        v-model="task.dueDate"
        :disable-date="disabledDate"
      />

      <FormError
        v-if="validationErrors && validationErrors.dueDate"
        :errors="validationErrors.dueDate"
      />
    </div>

    <button
      type="submit"
      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none"
    >
      {{ actionText }}
    </button>
  </form>
</template>
