<script setup lang="ts">
import { reactive } from 'vue'

interface TeamMember {
  name: string
  avatarUrl: string
}

interface Project {
  id: string
  studentName: string
  studentAvatar: string
  department: string
  teamMembers: TeamMember[]
  imageUrl: string
  title: string
  description: string
  liked: boolean
  views: number
  externalUrl: string
}

const viewProjectDetails = (id: string) => {
  console.log('View project:', id)
}

const viewUser = (name: string) => {
  console.log('View user:', name)
}

const toggleLike = (project: Project) => {
  project.liked = !project.liked
}

const openExternalLink = (url: string) => {
  window.open(url, '_blank')
}

const handleAvatarError = (e: Event) => {
  const target = e.target as HTMLImageElement
  target.src = 'https://via.placeholder.com/150'
}

const handleTeamAvatarError = (e: Event) => {
  const target = e.target as HTMLImageElement
  target.src = 'https://via.placeholder.com/100'
}

const handleImageError = (e: Event) => {
  const target = e.target as HTMLImageElement
  target.src = 'https://via.placeholder.com/300x200'
}

const filteredProjects = reactive<Project[]>([
  {
    id: '1',
    studentName: 'Jacob Jones',
    studentAvatar:
      'https://themindfulsteward.com/wp-content/uploads/2018/10/christopher-evans-chri7z-mindful-steward.jpg',
    department: 'Computer Science',
    teamMembers: [
      { name: 'Ava', avatarUrl: 'https://randomuser.me/api/portraits/women/1.jpg' },
      { name: 'Leo', avatarUrl: 'https://randomuser.me/api/portraits/men/2.jpg' },
      { name: 'Nia', avatarUrl: 'https://randomuser.me/api/portraits/women/3.jpg' }
    ],
    imageUrl: 'https://via.placeholder.com/500x300',
    title: 'Awesome Vue Project',
    description: 'A modern dashboard app built with Vue and Tailwind.',
    liked: false,
    views: 39,
    externalUrl: 'https://example.com'
  },
  {
    id: '2',
    studentName: 'Emily Clark',
    studentAvatar:
      'https://randomuser.me/api/portraits/women/65.jpg',
    department: 'Information Technology',
    teamMembers: [
      { name: 'Max', avatarUrl: 'https://randomuser.me/api/portraits/men/34.jpg' },
      { name: 'Sara', avatarUrl: 'https://randomuser.me/api/portraits/women/22.jpg' }
    ],
    imageUrl: 'https://via.placeholder.com/500x300?text=Project+2',
    title: 'Innovative IT Solution',
    description: 'An innovative project focusing on IT infrastructure and cloud solutions.',
    liked: false,
    views: 27,
    externalUrl: 'https://example2.com'
  }
])
</script>

<template>
  <div class="dashboard-profile min-h-screen bg-blue-100 text-white font-vt323 text-xl">
    <!-- Profile Header -->
    <section class="profile-header mb-8">
      <h1 class="text-5xl font-bold text-gray-800 text-center py-3">Profile</h1>
    </section>

    <!-- Profile Section -->
    <section class="flex flex-col md:flex-row items-center md:items-start justify-center md:space-x-10">
      <!-- Profile Image & Popularity -->
      <div class="flex flex-col items-center text-center md:text-left mb-6">
        <img
          src="https://themindfulsteward.com/wp-content/uploads/2018/10/christopher-evans-chri7z-mindful-steward.jpg"
          alt="Profile picture of Jacob Jones"
          class="w-40 h-40 sm:w-48 sm:h-48 md:w-60 md:h-60 rounded-full object-cover border-2 border-black"
        />
        <div class="flex items-center gap-2 mt-4 text-gray-700">
          <FireIcon class="w-8 h-8 text-red-500" />
          <span class="text-4xl font-bold">39</span>
        </div>
      </div>

      <!-- Profile Info -->
      <div class="text-2xl flex p-4 font-bold ml-12">
        <div class="flex flex-col gap-4 pr-4 text-gray-700">
          <p>Name</p>
          <p>Major</p>
          <p>Batch</p>
          <p>Student ID</p>
          <p>Email</p>
          <p>Popularity</p>
        </div>
        <div class="flex flex-col gap-4 px-4 text-gray-700"> 
          <p>:</p>
          <p>:</p>
          <p>:</p>
          <p>:</p>
          <p>:</p>
          <p>:</p>
        </div>
        <div class="flex flex-col gap-4 pl-4 text-gray-700">
          <p>Jacob Jones</p>
          <p>Computer Science</p>
          <p>2022</p>
          <p>027-123-573</p>
          <p>jacob@gmail.com</p>
          <p>39</p>
        </div>
      </div>
    </section>

    <!-- Divider -->
    <div class="border-t-2 border-black my-6 mx-4"></div>

    <!-- My Projects Section -->
    <section class="my-projects px-4">
      <h2 class="text-4xl font-semibold text-gray-800 mb-10 text-center">My Projects</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div
          v-for="project in filteredProjects"
          :key="project.id"
          @click="viewProjectDetails(project.id)"
          class="bg-[#FFF3DE] hover:bg-[#FFF6E6] active:bg-[#FFECCB] rounded-lg overflow-hidden 
          flex flex-col relative pt-[70px] w-full max-w-5xl mx-auto 
          transition-all duration-200 ease-in-out  hover:translate-y-[-4px] active:shadow-none active:translate-y-[2px] cursor-pointer 
          shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black cursor-pointer"
        >
          <!-- Avatar and Info -->
          <div
            class="absolute top-4 left-7 flex items-center gap-3 z-10"
            @click.stop="viewUser(project.studentName)"
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
            <div
              v-for="(member, index) in project.teamMembers.slice(0, 3)"
              :key="member.name"
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
                src="https://cdn.mos.cms.futurecdn.net/gnG2Z6pK7CTBJmw4pRUy8i.jpg"
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
            <!-- Like Button with Toggleable Heart -->
            <button
              @click.stop="toggleLike(project)"
              class="bg-crimson py-1 px-9 rounded shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black flex items-center gap-2"
              aria-label="Like project"
            >
              <component
                :is="project.liked ? '❤️' : '🤍'"
                :class="project.liked ? 'text-red-500' : 'text-black'"
                class="w-6 h-6"
              />
              <span>{{ project.views }}</span>
            </button>

            <!-- View Link Button -->
            <button
              @click.stop="openExternalLink(project.externalUrl)"
              class="bg-teal-800 py-1 px-12 rounded shadow-[4px_4px_0px_black] text-black text-xl border-2 border-black flex items-center gap-2"
              aria-label="View project details"
            >
              View
            </button>
          </div>
        </div>
      </div>

      <div
        v-if="filteredProjects.length === 0"
        class="col-span-2 text-center py-10 border border-dashed border-gray-200 rounded-lg text-gray-500"
      >
        No projects found
      </div>
    </section>
  </div>
</template>

<style scoped>
.project-card {
  transition: all 0.3s ease;
}
.project-card:hover {
  transform: translateY(-2px);
}
</style>
