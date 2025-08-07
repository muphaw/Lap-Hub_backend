<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import {
  FormField,
  FormItem,
  FormLabel,
  FormControl,
  FormMessage,
  Form
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { Button } from '@/components/ui/button'
import { Select, SelectTrigger, SelectContent, SelectItem } from '@/components/ui/select'
import SelectGroup from '@/components/ui/select/SelectGroup.vue'

const router = useRouter()

const title = ref('')
const description = ref('')
const collaborators = ref<string[]>([])
const projectLink = ref('')
const projectDate = ref('')
const allUsers = ['Alice', 'Bob', 'Charlie', 'David','Swan Pyae sone','Mu Phaw Phaw','Myat Lin Maung','Saw Nay Htoo','Nyi Nyi','Alice', 'Bob', 'Charlie', 'David','Swan Pyae sone','Mu Phaw Phaw','Myat Lin Maung','Saw Nay Htoo','Nyi Nyi','San Lin Aung']

function handleSubmit() {
  const payload = {
    title: title.value,
    description: description.value,
    collaborators: collaborators.value,
    link: projectLink.value,
    date: projectDate.value,
  }
  console.log('Submitting:', payload)
}

function goBack() {
  router.back()
}

const selectedUsers = ref<string[]>([]);

function toggleUser(user: string) {
  const index = selectedUsers.value.indexOf(user);
  if (index > -1) {
    selectedUsers.value.splice(index, 1); // Remove
  } else {
    selectedUsers.value.push(user); // Add
  }
}

// function isSelected(user: string) {
//   return selectedUsers.value.includes(user);
// }
</script>

<template >
  <div class="py-6 px-16 min-h-screen bg-sidebar">
    <Button  @click="goBack" class="mb-4 px-3 py-1 shadow-[4px_4px_0px_black] text-black bg-crimson  border border-2 border-black active:shadow-[0px_0px_0px_black]">
        <img src="/pixel--arrow-left.svg"  class="w-4" />
    </Button>

    <h2 class="text-4xl text-center font-medium mb-6">Create Project</h2>

    <Form @submit.prevent="handleSubmit" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <FormField name="'title'">
          <FormItem>
            <FormLabel class="text-xl ">Project Title</FormLabel>
            <FormControl>
              <Input v-model="title" placeholder="Enter project title" class="shadow-[4px_4px_0px_black] text-base bg-input  border border-2 border-black" required />
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <FormField name="collaborators">
          <FormItem>
            <FormLabel class="text-xl">Collaborators</FormLabel>
            <FormControl>
              <Select >
              <SelectTrigger class="w-full shadow-[4px_4px_0px_black]  bg-input !text-black text-base border border-2 border-black">
                {{ selectedUsers.length ? selectedUsers.join(", ") : "Select users" }}
              </SelectTrigger>
              <SelectContent class="w-full shadow-[4px_4px_0px_black] text-black bg-input  border border-2 border-black">
                <SelectGroup>
                  <SelectItem
                  v-for="user in allUsers"
                  :key="user"
                  :value="user"
                  @click.stop.prevent="toggleUser(user)"
          
                >
                  <span class="flex items-center justify-between w-full ">
                    {{ user }}
                    <!-- <span v-if="isSelected(user)" class="">p</span> -->
                  </span>
                </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>
      </div>

      <FormField name="description">
        <FormItem>
          <FormLabel class="text-xl">Project Description</FormLabel>
          <FormControl>
            <Textarea v-model="description" placeholder="Write a description..." rows="4" class="shadow-[4px_4px_0px_black] text-base bg-input  border border-2 border-black" required />
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <FormField name ='link'>
          <FormItem>
            <FormLabel class="text-xl">Project Link</FormLabel>
            <FormControl>
              <Input v-model="projectLink" type="url" placeholder="https://..." class="shadow-[4px_4px_0px_black] text-base bg-input  border border-2 border-black"/>
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>

        <FormField name="date">
          <FormItem>
            <FormLabel class="text-xl">Project Date</FormLabel>
            <FormControl>
              <Input v-model="projectDate" type="date" class="shadow-[4px_4px_0px_black] text-base bg-input  border border-2 border-black" />
            </FormControl>
            <FormMessage />
          </FormItem>
        </FormField>
      </div>
       <div class="flex justify-center pt-10">
  <Button
    type="submit"
    class="px-12 sm:px-24 md:px-32 lg:px-48 py-3 text-lg md:text-xl shadow-[4px_4px_0px_black] text-black bg-dark-yellow border-2 border-black active:shadow-[0px_0px_0px_black]"
  >
    Create
  </Button>
</div>

    </Form>
  </div>
</template>
