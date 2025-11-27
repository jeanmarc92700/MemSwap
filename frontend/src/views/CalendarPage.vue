<template>
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4 text-gray-800">Calendrier des Événements</h1>
    <CalendarView />
  </div>
</template>

<script>
import CalendarView from '../components/CalendarView.vue'
export default { components: { CalendarView } }
</script>