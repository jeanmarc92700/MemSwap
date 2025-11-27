<template>
  <div class="task-container">
    <input v-model="newTask" @keyup.enter="addTask" placeholder="Nouvelle tâche..." />

    <ul>
      <li v-for="task in tasks" :key="task.id">
        <input type="checkbox" v-model="task.done" @change="toggleTask(task)" />
        <span :style="{ textDecoration: task.done ? 'line-through' : 'none' }">
          {{ task.title }}
        </span>
        <button @click="deleteTask(task.id)">🗑️</button>
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
      axios.get('/api/tasks.php').then(res => {
        this.tasks = res.data
      })
    },
    addTask() {
      if (!this.newTask.trim()) return
      axios.post('/api/tasks.php', { title: this.newTask }).then(() => {
        this.newTask = ''
        this.fetchTasks()
      })
    },
    deleteTask(id) {
      axios.delete(`/api/tasks.php?id=${id}`).then(() => this.fetchTasks())
    },
    toggleTask(task) {
      axios.put(`/api/tasks.php?id=${task.id}`, { done: task.done })
    }
  },
  mounted() {
    this.fetchTasks()
  }
}
</script>

<style>
.task-container {
  padding: 20px;
}

.task-container ul {
  list-style: none;
  padding: 0;
}

.task-container li {
  display: flex;
  gap: 10px;
  align-items: center;
  margin-bottom: 8px;
}
</style>
