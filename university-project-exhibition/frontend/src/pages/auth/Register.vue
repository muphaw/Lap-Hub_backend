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
import { Button } from '@/components/ui/button'
import { authService } from '@/services/auth'

const router = useRouter()
const loading = ref(false)
const error = ref('')

const formData = ref({
  studentId: '',
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

async function handleRegister() {
  try {
    loading.value = true
    error.value = ''
    await authService.register(formData.value)
    router.push('/dashboard')
  } catch (err: any) {
    error.value = err.message || 'Registration failed'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="flex flex-col md:flex-row h-screen">
    <div
      class="hidden md:flex w-1/2 bg-sidebar text-black flex-col justify-center items-start px-8 border-r-2 border-black"
    >
      <h1 class="text-7xl mb-2">Welcome to LAPHUB</h1>
      <p class="text-2xl">Join LAP HUB ---- Share your LAP journey.</p>
      <img
        src="/public/Street Life Class Picture.svg"
        alt="Logo"
        class="mb-4 max-w-full"
      />
    </div>

    <div
      class="w-full md:w-1/2 flex flex-col justify-center items-center px-6 md:px-8 py-8 bg-grey-blue"
    >
      <div class="w-full max-w-xl">
        <div class="block md:hidden mb-6 text-center">
          <h1 class="text-4xl font-bold mb-2">Welcome to LAPHUB</h1>
          <p class="text-base">Join LAP HUB ---- Share your LAP journey.</p>
        </div>

        <h2 class="text-3xl md:text-4xl text-center font-medium mb-6">
          Create your account
        </h2>

        <Form @submit.prevent="handleRegister" class="space-y-6">
          <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ error }}
          </div>
          
          <FormField name="studentId">
            <FormItem>
              <FormLabel class="text-xl">Student ID</FormLabel>
              <FormControl>
                <Input
                  v-model="formData.studentId"
                  type="text"
                  placeholder="Enter student ID..."
                  class="shadow-[4px_4px_0px_black] text-base bg-input border-2 border-black w-full"
                  required
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="email">
            <FormItem>
              <FormLabel class="text-xl">Email</FormLabel>
              <FormControl>
                <Input
                  placeholder="Enter email..."
                  class="shadow-[4px_4px_0px_black] text-base bg-input border-2 border-black w-full"
                  required
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="password">
            <FormItem>
              <FormLabel class="text-xl">Password</FormLabel>
              <FormControl>
                <Input
                  placeholder="Enter password..."
                  type="password"
                  class="shadow-[4px_4px_0px_black] text-base bg-input border-2 border-black w-full"
                  required
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="confirmPassword">
            <FormItem>
              <FormLabel class="text-xl">Confirm Password</FormLabel>
              <FormControl>
                <Input
                  placeholder="Confirm your password..."
                  type="password"
                  class="shadow-[4px_4px_0px_black] text-base bg-input border-2 border-black w-full"
                  required
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <div class="flex justify-center pt-8">
            <Button
              type="submit"
              class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg py-3 text-lg md:text-xl shadow-[4px_4px_0px_black] text-black bg-dark-yellow border-2 border-black active:shadow-[0px_0px_0px_black]"
            >
              Create
            </Button>
          </div>

          <p class="text-center">
            Part of LAP Hub already?
            <router-link to="/login" class="font-semibold ml-1">
              Log In Here
            </router-link>
          </p>
        </Form>
      </div>
    </div>
  </div>
</template>
