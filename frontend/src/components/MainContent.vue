<script setup lang="ts">
defineProps({
  title: {
    type: String,
    required: true
  }
})
</script>

<template>
  <div>
    <div class="flex items-center justify-between">
      <div class="min-w-0 flex-1">
        <h2
          class="text-2xl font-bold leading-7 text-gray-800 sm:truncate sm:text-3xl sm:tracking-tight"
        >
          {{ title }}
        </h2>

        <div v-if="$slots.meta" class="mt-1 truncate text-sm text-gray-500">
          <slot name="meta"></slot>
        </div>
      </div>

      <div v-if="$slots.actions" class="flex md:ml-4 md:mt-0">
        <slot name="actions"></slot>
      </div>
    </div>

    <slot></slot>
  </div>
</template>
