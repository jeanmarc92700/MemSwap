<template>
  <div class="bg-white shadow rounded p-4 max-w-xl mx-auto">
    <input v-model="newTask" @keyup.enter="addTask" placeholder="Nouvelle tâche..." 
           class="w-full p-2 mb-4 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"/>

    <ul class="space-y-2">
      <li v-for="task in tasks" :key="task.id" class="flex items-center justify-between p-2 border rounded hover:bg-gray-50">
        <div class="flex items-center gap-2">
          <input type="checkbox" v-model="task.done" @change="toggleTask(task)" class="w-5 h-5"/>
          <span :class="{ 'line-through text-gray-400': task.done }">{{ task.title }}</span>
        </div>
        <button @click="deleteTask(task.id)" class="text-red-500 hover:text-red-700">🗑️</button>
      </li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'

export default {
  setup() {
    const tasks = ref([])
    const newTask = ref('')

    const fetchTasks = () => axios.get('/api/tasks.php').then(res => tasks.value = res.data)
    const addTask = () => {
      if (!newTask.value.trim()) return
      axios.post('/api/tasks.php', { title: newTask.value }).then(() => {
        newTask.value = ''
        fetchTasks()
      })
    }
    const deleteTask = id => axios.delete(`/api/tasks.php?id=${id}`).then(fetchTasks)
    const toggleTask = task => axios.put(`/api/tasks.php?id=${task.id}`, { done: task.done })

    onMounted(fetchTasks)

    return { tasks, newTask, addTask, deleteTask, toggleTask }
  }
}
</script>
