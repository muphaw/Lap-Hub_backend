<script setup lang="ts">
import SideBarNav from "@/pages/side/SideBarNav.vue"
import {useRoute} from "vue-router";

const route = useRoute()
</script>

<template>
  <div class="flex h-screen">
    <SideBarNav v-if="route.path !== '/create' && route.path !== '/login' && route.path !== '/register'"  />
    <main class="flex-1  overflow-auto bg-grey-blue">
      <router-view />
    </main>
  </div>
</template>
