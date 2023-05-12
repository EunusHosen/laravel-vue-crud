<script setup lang="ts">
import Logo from '@/components/icons/Logo.vue'
import MobileMenu from '@/components/MobileMenu.vue'
import DesktopMenu from '@/components/DesktopMenu.vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
</script>

<template>
  <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <DisclosureButton
            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
          >
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>

        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <Logo />
          </div>

          <DesktopMenu />
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <MobileMenu />
    </DisclosurePanel>
  </Disclosure>
</template>
