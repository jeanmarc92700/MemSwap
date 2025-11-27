<template>
  <div class="min-h-screen">
    <nav class="bg-white shadow-md flex justify-center gap-6 py-4 mb-6">
      <router-link to="/calendar" class="font-semibold px-4 py-2 rounded hover:bg-blue-100"
                   :class="{ 'bg-blue-500 text-white': $route.path === '/calendar' }">
        📅 Calendrier
      </router-link>
      <router-link to="/tasks" class="font-semibold px-4 py-2 rounded hover:bg-green-100"
                   :class="{ 'bg-green-500 text-white': $route.path === '/tasks' }">
        ✅ Tâches
      </router-link>
    </nav>

    <main class="container mx-auto px-4">
      <router-view />
    </main>
  </div>
</template>

<script>
export default {}
</script>
