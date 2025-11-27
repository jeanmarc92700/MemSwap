<template>
  <div id="calendar" class="full-calendar-container"></div>
</template>

<script>
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'

export default {
  mounted() {
    const calendarEl = this.$el;
    
    const calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin, interactionPlugin],
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      locale: 'fr', 
      events: '/api/calendar.php', 
      dateClick: (info) => {
        const title = prompt("Titre de l'événement pour " + info.dateStr + " :")
        if (title) {
          axios.post('/api/calendar.php', { title, start: info.dateStr })
            .then(() => {
              calendar.refetchEvents();
            })
            .catch(error => console.error("Erreur lors de l'ajout de l'événement:", error));
        }
      }
    })
    calendar.render()
  }
}
</script>

<style>
.full-calendar-container {
  max-width: 100%;
  margin: 0 auto;
}
</style>