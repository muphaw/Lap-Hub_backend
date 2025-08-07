<!-- src/components/ui/card/ProjectCard.vue -->
<template>
  <div
    @click="() => viewProjectDetails(project.id)"
    class="bg-[#FFF3DE] hover:bg-[#FFF6E6] active:bg-[#FFECCB] rounded-lg overflow-hidden 
    flex flex-col relative pt-[70px] w-full 
    transition-all duration-200 ease-in-out hover:translate-y-[-4px] active:shadow-none active:translate-y-[2px] cursor-pointer 
    shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black"
  >
    <!-- Avatar and Info -->
    <div
      class="absolute top-4 left-7 flex items-center gap-3 z-10"
      @click.stop="() => viewUser(project.studentName)"
    >
      <div class="w-12 h-12 rounded-full border-2 border-black overflow-hidden">
        <img
          :src="project.studentAvatar"
          :alt="project.studentName"
          class="w-full h-full object-cover"
          @error="handleAvatarError"
        />
      </div>
      <div>
        <h3 class="text-lg font-bold text-gray-800 hover:underline">{{ project.studentName }}</h3>
        <p class="text-sm text-gray-800">{{ project.department }}</p>
      </div>
    </div>

    <!-- Team -->
    <div class="absolute top-4 right-7 h-12 flex justify-end">
      <template v-for="(member, index) in project.teamMembers.slice(0, 3)" :key="member.name">
        <div
          class="w-8 h-8 rounded-full border-2 border-white shadow-sm overflow-hidden bg-gray-200 hover:scale-110 -ml-2.5"
          :style="{ zIndex: 3 - index }"
        >
          <img
            :src="member.avatarUrl"
            :alt="member.name"
            class="w-full h-full object-cover"
            @error="handleTeamAvatarError"
          />
        </div>
      </template>
      <div
        v-if="project.teamMembers.length > 3"
        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-600 border-2 border-black shadow-sm -ml-2.5"
      >
        +{{ project.teamMembers.length - 3 }}
      </div>
    </div>

    <!-- Project Image -->
    <div class="px-4 mt-2">
      <div class="w-full h-48 overflow-hidden rounded shadow-[4px_4px_0px_black] border-2 border-black">
        <img
          :src="project.imageUrl"
          :alt="project.title"
          class="w-full h-full object-cover"
          @error="handleImageError"
        />
      </div>
    </div>

    <!-- Content -->
    <div class="p-4 flex-grow">
      <h2 class="text-3xl font-bold mb-3 text-black">{{ project.title }}</h2>
      <p class="text-base leading-relaxed text-black line-clamp-3">{{ project.description }}</p>
    </div>

    <!-- Footer -->
    <div class="p-4 border-t border-gray-200 flex justify-between">
      <!-- Like Button -->
      <button
        @click.stop="() => toggleLike(project)"
        class="bg-crimson py-1 px-9 rounded shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black flex items-center gap-2"
      >
        <component
          :is="project.liked ? '❤️' : '🤍' "
          :class="project.liked ? 'text-red-500' : 'text-black'"
          class="w-6 h-6"
        />
        <span>{{ project.views }}</span>
      </button>

      <!-- View Button -->
      <button
        @click.stop="() => openExternalLink(project.externalUrl)"
        class="bg-teal-800 py-1 px-12 rounded shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black"
      >
        View
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import {Project} from '@/data/Projects';


defineProps<{
  project: Project
  toggleLike: (project: Project) => void
  viewProjectDetails: (id: string) => void
  viewUser: (name: string) => void
  openExternalLink: (url: string) => void
}>()

const handleAvatarError = (e: Event) => {
  (e.target as HTMLImageElement).src = 'https://via.placeholder.com/150'
}

const handleTeamAvatarError = (e: Event) => {
  (e.target as HTMLImageElement).src = 'https://via.placeholder.com/100'
}

const handleImageError = (e: Event) => {
  (e.target as HTMLImageElement).src = 'https://via.placeholder.com/300x200'
}
</script>
