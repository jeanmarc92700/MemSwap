<template>
  <div id="calendar"></div>
</template>

<script>
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'

export default {
  mounted() {
    const calendar = new Calendar(this.$el, {
      plugins: [dayGridPlugin, interactionPlugin],
      initialView: 'dayGridMonth',
      events: '/api/calendar.php',
      dateClick: (info) => {
        const title = prompt("Titre de l'événement :")
        if (title) {
          axios.post('/api/calendar.php', { title, start: info.dateStr }).then(() => calendar.refetchEvents())
        }
      }
    })
    calendar.render()
  }
}
</script>
