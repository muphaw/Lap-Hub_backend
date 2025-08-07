<!-- src/pages/users/UserDetail.vue -->
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { students } from '@/data/student.ts'
import ProjectCard from '@/components/ProjectCard.vue'
import {Project, projects} from '@/data/Projects'

type Student = {
  id: number
  name: string
  major: string
  year: number
  image: string
  email: string
  popularity: number
}
const route = useRoute()
const router = useRouter()

const user = ref<Student | null>(null)
const userProjects = ref<Project[]>([])

onMounted(() => {
  const userId  = Number(route.params.id)
  user.value = students.find((s) => s.id === userId) ?? null
  if (user.value) {
    userProjects.value = projects
      .filter((p) => p.studentId === user.value!.id)
      .map((p) => ({ ...p })) // shallow copy for reactivity
  }
})

const toggleLike = (project: Project) => {
  project.liked = !project.liked
}

const viewProjectDetails = (id: string) => {
  console.log('View project:', id)
}

const viewUser = (name: string) => {
  console.log('View user:', name)
}

const openExternalLink = (url: string) => {
  window.open(url, '_blank')
}
</script>

<template>
  <div class="min-h-screen bg-[#9ec2cf] p-6">
    <!-- Back Button -->
    <button
      @click="() => router.push({ name: 'Users' })"
      class="mb-6 px-4 py-2 bg-crimson border-2 border-black rounded shadow-[4px_4px_0px_black] hover:bg-amber-300 transition"
    >
      <i class="fa-solid fa-arrow-left text-2xl"></i>
    </button>

    <!-- User Info -->
    <div
      v-if="user"
      class="bg-orange-200 p-8 rounded shadow-[4px_4px_0px_black] border-2 border-black w-full mb-10"
    >
      <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
        <img
          :src="user.image"
          alt="user"
          class="w-[400px] h-[280px] object-cover rounded border-2 border-black shadow-[4px_4px_0px_black]"
        />
        <div class="flex flex-col gap-5 text-left ml-10">
          <h2 class="text-4xl font-bold">{{ user.name }}</h2>
          <p class="text-2xl"><span class="font-medium">Email:</span> {{ user.email }}</p>
          <p class="text-2xl"><span class="font-medium">Student ID:</span> {{ user.id }}</p>
          <p class="text-2xl"><span class="font-medium">Batch:</span> {{ user.year }}</p>
          <p class="text-2xl"><span class="font-medium">Major:</span> {{ user.major }}</p>
          <p class="text-2xl"><span class="font-medium">Popularity:</span> {{ user.popularity }}</p>
        </div>
      </div>
    </div>

    <!-- Project Section -->
    <section>
      <h2 class="text-4xl font-semibold mb-10 text-gray-800 text-center">My Projects</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <ProjectCard
          v-for="project in userProjects"
          :key="project.id + project.liked"
          :project="project"
          :toggleLike="toggleLike"
          :viewProjectDetails="viewProjectDetails"
          :viewUser="viewUser"
          :openExternalLink="openExternalLink"
        />
      </div>

      <div
        v-if="userProjects.length === 0"
        class="text-center text-gray-700 mt-10 border border-dashed border-black p-10 rounded-lg"
      >
        No projects found.
      </div>
    </section>
  </div>
</template>
