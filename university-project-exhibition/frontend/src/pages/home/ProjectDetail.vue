<script setup lang="ts">
import { useRouter, useRoute } from 'vue-router'
import { ref, onMounted } from 'vue'
import { User } from 'lucide-vue-next'


const router = useRouter()
const route = useRoute()

interface TeamMember {
  name: string
  avatarUrl: string
  major: string
}

interface Project {
  id: number
  title: string
  description: string
  studentName: string
  studentAvatar: string
  department: string
  views: number
  imageUrl: string
  batch: string
  major: string
  teamMembers: TeamMember[]
  photos: string[]
  createdDate: string
  externalUrl?: string
}
// Project data with 5 photos (2 up, 3 down) and 3 team members each
const projects: Project[] = [
  {
    id: 1,
    title: 'E-Commerce Project',
    description: 'Lorem ipsum dolor sit amet consectetur. Malesuada mi accumsan id viverra titi we tet mi accumsan id. Malesuada mi accumsan id viverra titi we tet mi accumsan idMalesuada mi accumsan id viverra titi we tet mi accumsan idMalesuada mi accumsan id viverra titi we tet mi accumsan id  Malesuada mi accumsan id viverra titi we tet mi accumsan id. Malesuada mi accumsan id viverra titi we tet mi accumsan id. Malesuada mi accumsan id viverra titi we tet mi accumsan id.. metconsectetur. Malesuada mi accumsan id viverra titi we tet mi accumsan id..',
    studentName: 'Jacob Jones',
    studentAvatar: '/wp11948351.webp',
    department: 'Computer Science',
    views: 23,
    imageUrl: '/health.webp',
    batch: '2023',
    major: 'Computer Science',
    teamMembers: [
      { name: 'Sarah Miller', avatarUrl: '/kim tae ri.jpg', major: 'Computer Science' },
      { name: 'Alex Chen', avatarUrl: '/xavi.webp', major: 'Information Technology' },
      { name: 'Emma Wilson', avatarUrl: '/aguero.webp', major: 'Business' }
    ],
    photos: [
      '/public/g1.jpg',
      '/public/g5.jpg',
      '/public/g2.webp',
      '/public/g4.webp',
      '/public/g6.webp'
    ],
    createdDate: '07 March 2024',
    externalUrl: 'https://www.youtube.com'
  },
  {
    id: 2,
    title: 'Health Tracker',
    description: 'Mobile app for tracking fitness metrics and health data with advanced analytics and user-friendly interface. Features include step counting, heart rate monitoring, sleep analysis, and nutrition tracking with personalized recommendations. Mobile app for tracking fitness metrics and health data with advanced analytics and user-friendly interface. Mobile app for tracking fitness metrics and health data with advanced analytics and user-friendly interface.',
    studentName: 'Sarah Miller',
    studentAvatar: '/kim tae ri.jpg',
    department: 'Computer Science',
    views: 18,
    imageUrl: '/health-app.jpg',
    batch: '2023',
    major: 'Computer Science',
    teamMembers: [
      { name: 'Jacob Jones', avatarUrl: '/wp11948351.webp', major: 'Computer Science' },
      { name: 'Emma Wilson', avatarUrl: '/aguero.webp', major: 'Business' },
      { name: 'Michael Brown', avatarUrl: '/pedri.webp', major: 'Electrical Engineering' }
    ],
    photos: [
      '/public/h5.webp',
      '/public/h2.webp',
      '/public/h-1.webp',
      '/public/h4.webp',
      '/public/h3.webp'
    ],
    createdDate: '15 April 2024',
    externalUrl: 'https://www.youtube.com'
  },
  {
    id: 3,
    title: 'Smart Home Controller',
    description: 'IoT platform for managing home automation devices with real-time monitoring and control. Supports various smart devices including lights, thermostats, security cameras, and voice assistant integration.',
    studentName: 'Alex Chen',
    studentAvatar: '/public/raymod.jpg',
    department: 'Information Technology',
    views: 23,
    imageUrl: '/smart-home.jpg',
    batch: '2022',
    major: 'Information Technology',
    teamMembers: [
      { name: 'Di maria', avatarUrl: '/public/dimaria.webp', major: 'Computer Science' },
      { name: 'Lu Hpring', avatarUrl: '/public/lu hpring.webp', major: 'Electrical Engineering' },
      { name: 'Emma Wilson', avatarUrl: '/aguero.webp', major: 'Business' }
      
    ],
    photos: [
      '/smart-home-dashboard.jpg',
      '/smart-home-lights.jpg',
      '/smart-home-thermostat.jpg',
      '/smart-home-security.jpg',
      '/smart-home-voice.jpg'
    ],
    createdDate: 'February 28 2024',
    externalUrl: 'https://www.youtube.com'
  }
]

const project = ref<Project | null>(null)
const loading = ref(true)
const error = ref<string | null>(null)

onMounted(() => {
  try {
    const projectId = Number(route.params.id)
    if (isNaN(projectId)) {
      throw new Error('Invalid project ID')
    }
    
    const foundProject = projects.find(p => p.id === projectId)
    if (!foundProject) {
      throw new Error('Project not found')
    }
    
    // Validate project data
    if (!foundProject.photos || foundProject.photos.length < 5) {
      console.error('Project photos incomplete')
    }
    if (!foundProject.teamMembers || foundProject.teamMembers.length < 3) {
      console.error('Project team members incomplete')
    }
    
    project.value = foundProject
  } catch (err) {
    error.value = err instanceof Error ? err.message : 'Failed to load project'
  } finally {
    loading.value = false
  }
})

const getInitials = (name: string) => {
  if (!name) return ''
  return name.split(' ').map(n => n[0]).join('').toUpperCase()
}

const handleImageError = (event: Event, fallbackText?: string) => {
  const img = event.target as HTMLImageElement
  img.style.display = 'none'
  const parent = img.parentElement
  if (parent) {
    parent.classList.add(
      'bg-gray-200', 'flex', 'items-center', 
      'justify-center', 'font-bold', 'text-gray-600'
    )
    if (fallbackText) {
      parent.textContent = fallbackText
    }
  }
}

const openExternalLink = (url?: string) => {
  if (!url) {
    console.error('No external URL provided')
    return
  }
  try {
    window.open(url, '_blank', 'noopener,noreferrer')
  } catch (err) {
    console.error('Failed to open external link:', err)
  }
}

const navigateToUser = (username: string) => {
  if (!username) {
    console.error('No username provided')
    return
  }
  try {
    router.push(`/user/${encodeURIComponent(username)}`)
  } catch (err) {
    console.error('Navigation failed:', err)
  }
}
</script>

<template>
  <div v-if="loading" class="p-4 max-w-8xl mx-auto text-center ">
    Loading project...
  </div>
  
  <div v-else-if="error" class="p-4 max-w-8xl mx-auto text-center text-red-600">
    {{ error }}
  </div>
  
  <div v-else-if="project" class="px-6 py-4 max-w-7xl space-y-4">
    <!-- 1. Back Button (Original Design) -->
    <button 
      @click="router.go(-1)"
      class="flex items-center  bg-crimson px-1 py-2 rounded text-sm shadow-[4px_4px_0px_black] text-white border-2 border-black  transition-colors duration-200"
    >
    <img src="/public/back-svgrepo-com.svg" class="w-7 h-5 ml-1" />
      
    </button>
    

    <!-- 2. Photo Gallery (Original Design) -->
    <div class="grid grid-cols-2 gap-5 mb-1">
      <div 
        v-for="(photo, index) in project.photos.slice(0, 2)" 
        :key="'top-'+index"
        class="h-40 rounded-lg overflow-hidden border-2 border-black bg-gray-100"
      >
        <img 
          :src="photo" 
          :alt="`${project.title} screenshot ${index + 1}`"
          class="w-full h-full object-cover"
          @error="(e) => handleImageError(e, `Photo ${index + 1}`)"
        >
      </div>
    </div>
    <div class="grid grid-cols-3 gap-5 mb-4">
      <div 
        v-for="(photo, index) in project.photos.slice(2, 5)" 
        :key="'bottom-'+index"
        class="h-40 rounded-lg overflow-hidden  border-2 border-black bg-gray-100"
      >
        <img 
          :src="photo" 
          :alt="`${project.title} screenshot ${index + 3}`"
          class="w-full h-full object-cover"
          @error="(e) => handleImageError(e, `Photo ${index + 3}`)"
        >
      </div>
    </div>

    <div class="flex items-center gap-3 mb-2">
  <!-- Make avatar clickable -->
  <div 
    class="w-10 h-10 rounded-full overflow-hidden border-2 border-black bg-gray-200 cursor-pointer"
    @click="navigateToUser(project.studentName)"
  >
    <img 
      :src="project.studentAvatar" 
      :alt="project.studentName"
      class="w-full h-full object-cover"
      @error="(e) => handleImageError(e, getInitials(project?.studentName ?? ''))"
    >
  </div>
  <!-- Make name clickable -->
  <div 
    class="cursor-pointer"
    @click="navigateToUser(project.studentName)"
  >
    <h2 class="text-xl font-bold hover:underline">{{ project.studentName }}</h2>
    <p class="text-md">{{ project.major }} • Class of {{ project.batch }}</p>
  </div>
</div>
<!-- Project Content + Metadata (updated) -->
<div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-4">
  <!-- Project Description -->
  <div class="lg:col-span-4 bg-[#FFF3DE] rounded-lg p-4 shadow-[4px_4px_0px_black] border-2 border-black">
    <h1 class="text-2xl font-bold mb-2">{{ project.title }}</h1>
    <p class="text-lg leading-relaxed text-lg  line-clamp-4">{{ project.description }}</p>
  </div>

  <!-- Metadata Buttons -->
  <div class="lg:col-span-1 space-y-4">
  <button
    class="w-full bg-[#F4CDB0] hover:bg-[#FFDDC4] active:bg-[#EAC1A3] rounded-lg px-4 py-1 shadow-[4px_4px_0px_black] border-2 border-black  transition-colors duration-200 flex items-center gap-2 min-h-[56px]"
  >
   <img src="/public/calendar-days-svgrepo-com.svg"  class="w-5 h-6 mx-4" />
    <div class="text-left">
      <div class="text-lg font-bold leading-tight">Project Date</div>
      <div class="text-md leading-tight">{{ project.createdDate }}</div>
    </div>
  </button>

  <button
    class="w-full bg-[#E9A7A7] hover:bg-[#FFC9C9] active:bg-[#E6A2A2] rounded-lg px-4 py-3 shadow-[4px_4px_0px_black] border-2 border-black transition-colors duration-200 flex items-center gap-2"
  >
    <img src="/public/love-favorite-heart-svgrepo-com.svg"  class="w-5 h-6 mx-4" />
    <div class="text-lg font-bold">{{ project.views }} likes</div>
  </button>

  <button
    @click="openExternalLink(project.externalUrl)"
    class="w-full bg-[#AFDACC] hover:bg-[#B8E7D8] active:bg-[#A1CEBF] rounded-lg px-4 py-3 shadow-[4px_4px_0px_black] border-2 border-black transition-colors duration-200 flex items-center gap-2"
  >
   <img src="/public/share-04-svgrepo-com (4).svg"  class="w-5 h-6 mx-4" />
    <div class="text-lg font-bold">Live Demo</div>
  </button>
</div>
</div>


    <!-- 5. Collaborators Section -->
<div class="collaborators-section">
  <div class="flex items-center gap-3 mb-3">
    <div class="w-10 h-10 bg-sidebar flex items-center justify-center rounded-full">
      <User color="#000000" class="w-8 h-8 rounded-full " />
    </div>
    
    <h3 class="text-xl font-bold">Collaborators</h3>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
    <!-- Show ALL team members (not just first 3 like home page) -->
    <div 
      v-for="(member, index) in project.teamMembers" 
      :key="index"
      class="bg-[#7885C5] hover:bg-[#909EE2] active:bg-[#6477D6] rounded-lg p-1 shadow-[4px_4px_0px_black] border-2 border-black hover:shadow-[6px_6px_0px_black] transition-all duration-200"
      @click="navigateToUser(member.name)"
    >
      <div class="flex items-center gap-8 cursor-pointer pl-8">
        <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-black bg-gray-200">
          <img 
            :src="member.avatarUrl" 
            :alt="member.name"
            class="w-full h-full object-cover"
            @error="(e) => handleImageError(e, getInitials(member.name))"
          >
        </div>
        <div class="overflow-hidden pl-15">
          <h4 class="text-xl font-bold truncate">{{ member.name }}</h4>
          <p class="text-md  text-black">{{ member.major }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
  
  <div v-else class="p-4 max-w-6xl mx-auto text-center">
    Project not found
  </div>
</template>