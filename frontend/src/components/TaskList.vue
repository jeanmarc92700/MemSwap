<template>
  <div class="task-container">
    <div class="flex mb-4">
      <input 
        v-model="newTask" 
        @keyup.enter="addTask" 
        placeholder="Nouvelle tâche..." 
        class="flex-grow p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
      <button @click="addTask" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition">
        Ajouter
      </button>
    </div>
    
    <ul class="space-y-2">
      <li v-for="task in tasks" :key="task.id" class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-md">
        <div class="flex items-center">
          <input 
            type="checkbox" 
            v-model="task.done" 
            @change="toggleTask(task)" 
            class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
          />
          <span 
            :class="{'line-through text-gray-500': task.done, 'text-gray-800': !task.done}" 
            class="ml-3 text-lg"
          >
            {{ task.title }}
          </span>
        </div>
        <button @click="deleteTask(task.id)" class="text-red-500 hover:text-red-700 transition">
          🗑️
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return { 
      newTask: '', 
      tasks: [] 
    }
  },
  methods: {
    fetchTasks() {
      axios.get('/api/tasks.php')
        .then(res => this.tasks = res.data)
        .catch(error => console.error("Erreur de chargement des tâches:", error));
    },
    addTask() {
      if (!this.newTask.trim()) return
      axios.post('/api/tasks.php', { title: this.newTask })
        .then(() => {
          this.newTask = ''
          this.fetchTasks()
        })
        .catch(error => console.error("Erreur d'ajout de tâche:", error));
    },
    deleteTask(id) {
      axios.delete(`/api/tasks.php?id=${id}`)
        .then(() => this.fetchTasks())
        .catch(error => console.error("Erreur de suppression de tâche:", error));
    },
    toggleTask(task) {
      axios.put(`/api/tasks.php?id=${task.id}`, { done: task.done })
        .catch(error => console.error("Erreur de mise à jour de tâche:", error));
    }
  },
  mounted() {
    this.fetchTasks()
  }
}
</script>