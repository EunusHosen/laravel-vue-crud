<script setup lang="ts">
const props = defineProps<{
  currentPage: number
  lastPage: number
  nextPage: () => void
  previousPage: () => void
}>()

const previousPage = () => {
  if (props.currentPage === 1) return
  props.previousPage()
}

const nextPage = () => {
  if (props.currentPage === props.lastPage) return
  props.nextPage()
}
</script>

<template>
  <div class="flex justify-between">
    <button
      @click="previousPage"
      :class="`px-4 py-2 bg-gray-200 text-gray-600 border border-gray-300 rounded-lg ${
        props.currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''
      }`"
    >
      Previous
    </button>

    <button
      @click="nextPage"
      :class="`px-4 py-2 bg-gray-200 text-gray-600 border border-gray-300 rounded-lg ${
        props.currentPage === props.lastPage ? 'opacity-50 cursor-not-allowed' : ''
      }`"
    >
      Next
    </button>
  </div>
</template>
