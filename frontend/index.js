<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Calendrier & Tâches</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <style>
    nav button {
      padding: 10px;
      margin-right: 10px;
      cursor: pointer;
    }
    .active {
      background: #4a90e2;
      color: white;
    }
  </style>
</head>
<body>
  <div id="app">
    <nav>
      <button @click="tab = 'calendar'" :class="{ active: tab === 'calendar' }">📅 Calendrier</button>
      <button @click="tab = 'tasks'" :class="{ active: tab === 'tasks' }">✅ Tâches</button>
    </nav>

    <div v-if="tab === 'calendar'">
      <h2>Vue Calendrier</h2>
      <p>(Ici tu peux mettre ton composant de calendrier)</p>
    </div>

    <div v-else>
      <h2>Vue Tâches</h2>
      <p>(Ici tu peux mettre ta liste de tâches)</p>
    </div>
  </div>

  <script>
    const { createApp } = Vue

    createApp({
      data() {
        return { tab: 'calendar' }
      }
    }).mount('#app')
  </script>
</body>
</html>
