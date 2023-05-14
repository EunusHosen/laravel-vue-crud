<script setup lang="ts">
defineProps({
  name: {
    type: String,
    required: true
  },
  modelValue: {
    type: String,
    required: true
  },
  placeholder: {
    type: String,
    required: false
  },
  rows: {
    type: Number,
    required: false,
    default: 3
  }
})

defineEmits(['update:modelValue'])
</script>

<template>
  <textarea
    :id="name"
    :name="name"
    :rows="rows"
    class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
    :placeholder="placeholder"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
