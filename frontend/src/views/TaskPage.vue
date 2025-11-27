<template>
  <div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold mb-4 text-gray-800">Liste des Tâches</h1>
    <TaskList />
  </div>
</template>

<script>
import TaskList from '../components/TaskList.vue'
export default { components: { TaskList } }
</script>