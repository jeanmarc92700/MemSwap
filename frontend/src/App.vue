<template>
  <div class="min-h-screen bg-gray-50">
    <nav class="flex gap-4 p-4 bg-white shadow-md">
      <router-link to="/calendar" class="text-lg font-medium text-gray-600 hover:text-blue-600 transition duration-150" :class="{ 'text-blue-600 font-bold border-b-2 border-blue-600': $route.path === '/calendar' }">
        📅 Calendrier
      </router-link>
      <router-link to="/tasks" class="text-lg font-medium text-gray-600 hover:text-blue-600 transition duration-150" :class="{ 'text-blue-600 font-bold border-b-2 border-blue-600': $route.path === '/tasks' }">
        ✅ Tâches
      </router-link>
    </nav>
    <div class="p-6">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  // Option Vue 3
}
</script>