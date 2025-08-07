
<!-- StudentCard.vue -->
<template>
  <div class="flex h-48 bg-amber-100 border-2 border-black rounded shadow-[4px_4px_0px_black] py-7 p-4  gap-4
  transition-all duration-200 ease-in-out  hover:translate-y-[-4px] active:shadow-none active:translate-y-[2px] cursor-pointer
  ">
    <!-- Image on the left -->
    <img
      :src="image"
      :alt="name"
      class="w-40 h-full object-cover rounded border-2 border-black"
    />

    <!-- Text stacked on the right -->
    <div class="flex flex-col gap-5 item-start">
      <h3 class="text-2xl font-bold">{{ name }}</h3>
      <p class="text-xl"> {{ major }}</p>
      <p class="text-xl"> {{ year }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  name: string
  major: string
  year: number
  image: string
}>()
</script>
