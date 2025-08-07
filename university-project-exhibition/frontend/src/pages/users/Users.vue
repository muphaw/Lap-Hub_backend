<script setup lang="ts">
import { ref, computed } from 'vue'
import StudentCard from '@/components/StudentCard.vue'
import { students } from '@/data/student.ts'

const selectedBatch = ref('')
const selectedMajor = ref('')
const searchQuery = ref('')

// Extract unique values for filters
const batches = [...new Set(students.map(s => s.year))]
const majors = [...new Set(students.map(s => s.major))]

// Filtered students
const filteredStudents = computed(() => {
  return students.filter(student => {
    const matchesBatch = selectedBatch.value ? student.year === Number(selectedBatch.value) : true
    const matchesMajor = selectedMajor.value ? student.major === selectedMajor.value : true
    const matchesSearch = student.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    return matchesBatch && matchesMajor && matchesSearch
  })
})
</script>

<template>
  <div class="min-h-screen bg-[#9ec2cf] p-6">
    <!-- Filters -->
    <div class="flex flex-wrap mt-5 gap-8 mb-12">
      <!-- Batch Filter -->
      <select
        v-model="selectedBatch"
        class="w-64 py-1 bg-dark-yellow border-2 border-black rounded shadow-[4px_4px_0px_black] 
        text-center text-bold text-xl
        custom-select-arrow"
      >
        <option value="">Batches</option>
        <option v-for="batch in batches" :key="batch" :value="batch">{{ batch }}</option>
      </select>

      <!-- Major Filter -->
      <select
        v-model="selectedMajor"
        class="w-64 py-1 bg-dark-yellow border-2 border-black rounded shadow-[4px_4px_0px_black] 
        text-center text-bold text-xl
        custom-select-arrow"
      >
        <option value="">Majors</option>
        <option v-for="major in majors" :key="major" :value="major">{{ major }}</option>
      </select>

      <!-- Search Bar -->
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search by name..."
        class="flex-1 px-4 py-2 bg-pink-100 border-2 border-black rounded shadow-[4px_4px_0px_black]"
      />
    </div>

    <!-- Student Cards -->
    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <router-link
        v-for="student in filteredStudents"
        :key="student.id"
        :to="{ name: 'UserDetail', params: { id: student.id } }"
        class="block"
      >
        <StudentCard
          :name="student.name"
          :major="student.major"
          :year="student.year"
          :image="student.image"
        />
      </router-link>
    </div>
  </div>
</template>

<style>
.custom-select-arrow {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg fill='black' height='20' viewBox='0 0 20 20' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 7l3 3 3-3z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 3em;
  padding-right: 2.5rem;
}
.triangle-down {
	width: 0;
	height: 0;
	border-left: 25px solid transparent;
	border-right: 25px solid transparent;
	border-top: 50px solid #555;
}
</style>
