<script setup lang="ts">
import { RouterView } from 'vue-router'
import { useAppStore } from '@/stores/app'
import SuccessAlert from '@/components/SuccessAlert.vue'
import { watch } from 'vue'

const appStore = useAppStore()
const close = () => {
  appStore.setSuccessMessage('')
}

watch(
  () => appStore.successMessage,
  (newValue) => {
    if (newValue) {
      setTimeout(() => {
        close()
      }, 3000)
    }
  }
)
</script>

<template>
  <main class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative">
      <SuccessAlert
        @close="close"
        v-show="!!appStore.successMessage"
        :message="appStore.successMessage"
      />
    </div>

    <div class="pt-20 pb-6">
      <RouterView />
    </div>
  </main>
</template>
