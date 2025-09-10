<template>
  <div>
    <nav>
      <button @click="tab = 'calendar'" :class="{ active: tab === 'calendar' }">📅 Calendrier</button>
      <button @click="tab = 'tasks'" :class="{ active: tab === 'tasks' }">✅ Tâches</button>
    </nav>

    <div v-if="tab === 'calendar'">
      <CalendarView />
    </div>
    <div v-else>
      <TaskList />
    </div>
  </div>
</template>

<script>
import CalendarView from '@/components/CalendarView.vue'
import TaskList from '@/components/TaskList.vue'

export default {
  data() {
    return { tab: 'calendar' }
  },
  components: { CalendarView, TaskList }
}
</script>
