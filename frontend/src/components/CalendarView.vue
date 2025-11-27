<template>
  <div ref="calendar" class="bg-white shadow rounded p-4"></div>
</template>

<script>
import { ref, onMounted } from 'vue'
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'

export default {
  setup() {
    const calendarEl = ref(null)

    onMounted(() => {
      const calendar = new Calendar(calendarEl.value, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: '/api/calendar.php',
        dateClick(info) {
          const title = prompt('Titre de l\'événement :')
          if (title) {
            axios.post('/api/calendar.php', { title, start: info.dateStr })
                 .then(() => calendar.refetchEvents())
          }
        }
      })
      calendar.render()
    })

    return { calendarEl }
  }
}
</script>
