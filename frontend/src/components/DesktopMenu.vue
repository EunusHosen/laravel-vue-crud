<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAppStore } from '@/stores/app'

const appStore = useAppStore()
</script>

<template>
  <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
    <RouterLink
      :to="menuItem.to"
      :key="menuItem.to"
      v-for="menuItem in appStore.menuItems"
      class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium"
      :class="{
        'border-indigo-500 text-gray-900': menuItem.to === $route.path,
        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700':
          menuItem.to !== $route.path
      }"
      >{{ menuItem.name }}
    </RouterLink>
  </div>
</template>
