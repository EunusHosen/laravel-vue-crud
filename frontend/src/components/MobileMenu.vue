<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAppStore } from '@/stores/app'
import { DisclosureButton } from '@headlessui/vue'

const appStore = useAppStore()
</script>

<template>
  <div class="space-y-1 pb-4 pt-2">
    <DisclosureButton
      v-for="menuItem in appStore.menuItems"
      :key="menuItem.to"
      :as="RouterLink"
      :to="menuItem.to"
      class="block border-l-4 py-2 pl-3 pr-4 text-base font-medium"
      :class="{
        'bg-indigo-50 border-indigo-500 text-indigo-700': menuItem.to === $route.path,
        'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700':
          menuItem.to !== $route.path
      }"
    >
      {{ menuItem.name }}
    </DisclosureButton>
  </div>
</template>
