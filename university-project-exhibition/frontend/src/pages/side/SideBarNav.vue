  <script setup lang="ts">
  import { ref, watch } from "vue"
  import { useRoute } from "vue-router"
  import { Menu } from "lucide-vue-next"
  import Button from "@/components/ui/button/Button.vue"

  const isOpen = ref(false)
  const route = useRoute()

  watch(() => route.path, () => {
    isOpen.value = false
  })

  const items = [
    { title: "Projects", url: "/", iconSrc : "/projects.svg" },
    { title: "Students", url: "/users", iconSrc : "/students.svg"  },
    { title: "Dashboard", url: "/dashboard", iconSrc : "/dashboard.svg"  },
  ]
  </script>

  <template>
    <div class="flex h-screen bg-sidebar">
      <!-- Sidebar -->
      <div
        :class="[
          'fixed z-40 md:relative md:translate-x-0 transform transition-transform duration-300 ease-in-out',
          isOpen ? 'translate-x-0' : '-translate-x-full',
          'w-64 text-white flex flex-col bg-sidebar h-screen shadow-xl '
        ]"
      >
        <div class="p-4 text-4xl text-black font-bold border-b-2 border-black  text-center"> 
          LAP HUB
        </div>

        <div class="flex-1 flex flex-col items-center justify-content-start  px-4 ">
          <Button asChild class="w-full shadow-[4px_4px_0px_black] text-black text-xl bg-dark-yellow my-8 border border-2 border-black active:shadow-[0px_0px_0px_black]">
            <router-link to="/create"> 
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M23 11v2h-1v1h-8v8h-1v1h-2v-1h-1v-8H2v-1H1v-2h1v-1h8V2h1V1h2v1h1v8h8v1z"/></svg>
              Create Project
            </router-link>
        </Button>
          <nav class="w-full mt-20 space-y-4">
            <router-link
              v-for="item in items"
              :key="item.title"
              :to="item.url"
              class="flex items-center text-xl gap-8 p-2 rounded transition px-4 text-black"
              :class="route.path === item.url
                ? 'shadow-[2px_4px_0px_black] border border-2 border-black  button-selected'
                : 'hover:bg-gray-400'"
            >
              <img :src="item.iconSrc" :alt="item.title" class="w-5 h-5" />
              <span>{{ item.title }}</span>
            </router-link>
          </nav>
        </div>

        <div class="p-4 mb-6">
          <router-link to="/login">
            <Button class="w-full shadow-[4px_4px_0px_black] bg-crimson text-black text-xl border border-2 border-black active:shadow-[0px_0px_0px_black]">
            <img src="/logout.svg"  class="w-5 h-5 mr-3" />
            Log Out
          </Button>
          </router-link>
          
        </div>
      </div> 

      <Button
        @click="isOpen = !isOpen"
        :class="[
          'absolute top-4 left-4 z-50 p-2 rounded-md shadow  md:hidden !bg-white',
          isOpen ? 'bg-dark-yellow ' : 'bg-white'
        ]"
      >
        <Menu class="size-5 text-black" />
      </Button>
    </div>
  </template>
