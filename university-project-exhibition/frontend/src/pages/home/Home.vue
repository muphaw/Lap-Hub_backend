<script setup lang="ts">
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { Search } from "lucide-vue-next";
import {Button} from "@/components/ui/button";

const router = useRouter();

interface TeamMember {
  name: string;
  avatarUrl: string;
}

interface Project {
  id: number;
  title: string;
  description: string;
  studentName: string;
  studentAvatar: string;
  department: string;
  views: number;
  imageUrl: string;
  batch: string;
  major: string;
  teamMembers: TeamMember[];
  liked: boolean;
  externalUrl: string;
}

// Project data
const projects = ref<Project[]>([
  {
    id: 1,
    title: "E-Commerce Project",
    description:
      "Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur....",
    studentName: "Jacob Jones",
    studentAvatar: "/wp11948351.webp",
    department: "Computer Science",
    views: 23,
    imageUrl: "public/code.jpg",
    batch: "2023",
    major: "Computer Science",
    teamMembers: [
      { name: "Sarah Miller", avatarUrl: "/kim tae ri.jpg" },
      { name: "Alex Chen", avatarUrl: "/xavi.webp" },
      { name: "Alex ", avatarUrl: "public/dejong.jpg" },
    ],
    liked: false,
    externalUrl: "https://www.youtube.com",
  },
  {
    id: 2,
    title: "Health Tracker",
    description:
      "Mobile app for Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur. tracking fitness metrics and health data",
    studentName: "Sarah Miller",
    studentAvatar: "public/kim tae ri.jpg",
    department: "Computer Science",
    views: 18,
    imageUrl: "/health.webp",
    batch: "2023",
    major: "Computer Science",
    teamMembers: [
      { name: "Jacob Jones", avatarUrl: "public/raymod.jpg" },
      { name: "Emma Wilson", avatarUrl: "public/aguero.webp" },
      { name: "Alex Chen", avatarUrl: "public/xavi.webp" },
    ],
    liked: false,
    externalUrl: "https://www.youtube.com",
  },
  {
    id: 3,
    title: "Smart Home Controller",
    description:
      "IoT platform for managing home automation devices Mobile app for Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet",
    studentName: "Alex Chen",
    studentAvatar: "public/raymod.jpg",
    department: "Information Technology",
    views: 32,
    imageUrl: "/public/smart home.jpg",
    batch: "2022",
    major: "Information Technology",
    teamMembers: [
      { name: "Sarah Miller", avatarUrl: "public/dimaria.webp" },
      { name: "Jacob Jones", avatarUrl: "public/lu hpring.webp" },
      { name: "Emma Wilson", avatarUrl: "public/kim tae ri.jpg" },
      { name: "Michael Brown", avatarUrl: "public/pedri.webp" },
    ],
    liked: false,
    externalUrl: "https://www.youtube.com",
  },
  {
    id: 4,
    title: "AI Chatbot",
    description:
      "Natural language processing chatbot for customer service Mobile app for Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet",
    studentName: "Emma Wilson",
    studentAvatar: "public/Neymar.jpg",
    department: "Computer Science",
    views: 27,
    imageUrl: "/images/chatbot.jpg",
    batch: "2022",
    major: "Computer Science",
    teamMembers: [
      { name: "Jacob Jones", avatarUrl: "public/yamal.jpg" },
      { name: "Sarah Miller", avatarUrl: "public/tom.jpg" },
      { name: "Alex Chen", avatarUrl: "public/aguero.webp" },
      { name: "Michael Brown", avatarUrl: "public/aguero.webp" },
    ],
    liked: false,
    externalUrl: "https://www.youtube.com",
  },
  // ... other projects
]);

// Filter states
const selectedBatch = ref("Batch");
const selectedMajor = ref("Major");
const searchQuery = ref("");

// Filtered projects
const filteredProjects = computed(() => {
  return projects.value.filter((project) => {
    const matchesSearch =
      project.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      project.description
        .toLowerCase()
        .includes(searchQuery.value.toLowerCase());
    const matchesBatch =
      selectedBatch.value === "Batch" || project.batch === selectedBatch.value;
    const matchesMajor =
      selectedMajor.value === "Major" || project.major === selectedMajor.value;
    return matchesSearch && matchesBatch && matchesMajor;
  });
});

// Utility functions
const getInitials = (name: string) => {
  return name
    .split(" ")
    .map((n) => n[0])
    .join("");
};

// Navigation handlers
const viewProjectDetails = (id: number) => {
  router.push(`/project/${id}`);
};

const viewUser = (username: string) => {
  router.push(`/user/${encodeURIComponent(username)}`);
};

// Action handlers
const toggleLike = (project: Project) => {
  project.liked = !project.liked;
  project.views += project.liked ? 1 : -1;
};

const openExternalLink = (url: string) => {
  window.open(url, "_blank");
};

// Error handlers
const handleImageError = (e: Event) => {
  const img = e.target as HTMLImageElement;
  img.style.display = "none";
  img.parentElement?.classList.add("bg-gray-100");
};

const handleAvatarError = (e: Event, name: string) => {
  const img = e.target as HTMLImageElement;
  img.style.display = "none";
  const parent = img.parentElement!;
  parent.textContent = getInitials(name);
  parent.classList.add(
    "flex",
    "items-center",
    "justify-center",
    "font-semibold",
    "text-base",
    "bg-gray-200"
  );
};

const handleTeamAvatarError = (e: Event, name: string) => {
  const img = e.target as HTMLImageElement;
  img.style.display = "none";
  const parent = img.parentElement!;
  parent.textContent = getInitials(name);
  parent.classList.add(
    "flex",
    "items-center",
    "justify-center",
    "text-xs",
    "font-semibold",
    "bg-gray-200"
  );
};
</script>

<template>
  <div class="p-6 max-w-12xl mx-auto bg-grey-blue">
    <!-- Filter Bar Component -->
    <div class="mb-12">
      <div class="flex flex-row gap-4">
        <!-- Batch Dropdown -->
        <div class="relative w-1/2">
          <Select class="px-12">
            <SelectTrigger
              class="bg-dark-yellow shadow-[4px_4px_0px_black] !text-black border-black border-2 pl-8 text-lg pr-8"
            >
              <SelectValue placeholder="Batch" class="text-black" />
            </SelectTrigger>
            <SelectContent class="bg-dark-yellow border-black border-2">
              <SelectGroup>
                <SelectLabel>Batch</SelectLabel>
                <SelectItem value="Batch"> 2020 </SelectItem>
                <SelectItem value="Batch"> 2020 </SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
        </div>

        <!-- Major Dropdown -->
        <div class="relative w-1/2">
          <Select>
            <SelectTrigger
              class="bg-dark-yellow shadow-[4px_4px_0px_black] border-black !text-black  border-2 pl-8 text-lg pr-8"
            >
              <SelectValue
                placeholder="Major"
                class="text-black border-black"
              />
            </SelectTrigger>
            <SelectContent class="bg-dark-yellow border-black border-2">
              <SelectGroup>
                <SelectLabel>Major</SelectLabel>
                <SelectItem value="Computer Science">
                  Computer Studies
                </SelectItem>
              </SelectGroup>
            </SelectContent>
          </Select>
        </div>

        <!-- Search Box -->
        <div class="relative w-full">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search"
            class="w-full px-10 h-9 rounded-md text-sm bg-[#FAE7D9] shadow-[4px_4px_0px_black] text-black border border-2 border-black"
          />
          <span class="absolute left-3 top-5 -translate-y-1/2"
            ><Search class="w-5 h-5 pb-1"
          /></span>
        </div>
      </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
      <!-- Project Card Component -->
      <div
        v-for="project in filteredProjects"
        :key="project.id"
        @click="viewProjectDetails(project.id)"
        class="bg-[#FFF3DE] hover:bg-[#FFF6E6] active:bg-[#FFECCB] rounded-lg overflow-hidden flex flex-col relative pt-[70px] w-full max-w-5xl mx-auto transition-transform duration-200 hover:-translate-y-0.5 shadow-[4px_4px_0px_black] text-black text-xl border border-2 border-black cursor-pointer"
      >
        <!-- Main Avatar -->
        <div
          class="absolute top-4 left-7 flex items-center gap-3 z-10"
          @click.stop="viewUser(project.studentName)"
        >
          <div
            class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center font-semibold text-base text-gray-600 border-2 border-black shadow-sm overflow-hidden relative"
          >
            <img
              :src="project.studentAvatar"
              :alt="project.studentName"
              class="w-full h-full object-cover"
              @error="(e) => handleAvatarError(e, project.studentName)"
            />
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-800 hover:underline">
              {{ project.studentName }}
            </h3>
            <p class="text-sm text-gray-800">{{ project.department }}</p>
          </div>
        </div>

        <!-- Team Avatars -->
        <div class="absolute top-4 right-7 h-12 flex justify-end">
          <div
            v-for="(member, index) in project.teamMembers.slice(0, 3)"
            :key="member.name"
            class="w-8 h-8 rounded-full border-2 border-white shadow-sm overflow-hidden bg-gray-200 transition-transform duration-200 hover:scale-110 -ml-2.5 relative"
            :style="{ zIndex: 3 - index }"
          >
            <img
              :src="member.avatarUrl"
              :alt="member.name"
              class="w-full h-full object-cover"
              @error="(e) => handleTeamAvatarError(e, member.name)"
            />
          </div>
          <div
            v-if="project.teamMembers.length > 3"
            class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-600 border-2 border-black shadow-sm -ml-2.5 relative"
            :style="{ zIndex: 0 }"
          >
            +{{ project.teamMembers.length - 3 }}
          </div>
        </div>

        <!-- Project Image -->
        <div class="px-4 mt-2">
          <div
            class="w-full h-40 overflow-hidden rounded shadow-[4px_4px_0px_black] border border-2 border-black"
          >
            <img
              :src="project.imageUrl"
              :alt="project.title"
              class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-103"
              @error="handleImageError"
            />
          </div>
        </div>

        <!-- Project Content -->
        <div class="p-4 flex-grow">
          <h2 class="text-3xl font-bold mb-3 text-black">
            {{ project.title }}
          </h2>
          <p class="text-base leading-relaxed text-black m-0 line-clamp-3">
            {{ project.description }}
          </p>
        </div>

        <!-- Footer Actions -->
        <div class="p-4 px- border-t border-gray-200 flex justify-between">
          <Button
            @click.stop="toggleLike(project)"
            class="bg-crimson py-0.5 w-1/4 rounded text-sm cursor-pointer transition-all duration-200 hover:border-blue-500 shadow-[4px_4px_0px_black] text-black text-xl border border-2 border-black"
          >
            <span class="text-sm w-5 h-5 mr-3">{{
              project.liked ? "❤️" : "🤍"
            }}</span>
            <span class="text-lg">{{ project.views }}</span>
          </Button>
          <Button
            @click.stop="openExternalLink(project.externalUrl)"
            class="bg-teal-blue py-0.5 w-1/4 rounded text-sm cursor-pointer transition-all duration-200  shadow-[4px_4px_0px_black] text-black text-xl border border-2 border-black flex items-center gap-2"
          >
            <img src="/public/share-04-svgrepo-com (4).svg" class="w-5 h-4" />
            <!-- This is your icon -->
            Live
          </Button>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div
      v-if="filteredProjects.length === 0"
      class="col-span-2 text-center py-10 border border-dashed border-gray-200 rounded-lg text-gray-500"
    >
      No projects found
    </div>
  </div>
</template>
