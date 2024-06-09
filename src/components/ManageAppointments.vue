<template>
  <div>
    <h2>Manage My Appointments</h2>
    <ul>
      <li v-for="appointment in appointments" :key="appointment.id">
        {{ appointment.appointment_date }} - {{ appointment.reason }}
        <button @click="editAppointment(appointment)">Edit</button>
        <button @click="deleteAppointment(appointment.id)">Delete</button>
      </li>
    </ul>
    <button @click="newAppointment">New Appointment</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ManageAppointments',
  data() {
    return {
      appointments: [],
    };
  },
  methods: {
    async fetchAppointments() {
      try {
        const response = await axios.get('http://localhost:8000/api/appointments/mine');
        this.appointments = response.data;
      } catch (error) {
        console.error('Error fetching appointments:', error);
      }
    },
    editAppointment(appointment) {
      this.$router.push({ name: 'EditAppointment', params: { id: appointment.id } });
    },
    async deleteAppointment(id) {
      if (confirm('Are you sure you want to delete this appointment?')) {
        try {
          await axios.delete(`http://localhost:8000/api/appointments/${id}`);
          this.fetchAppointments();
        } catch (error) {
          console.error('Error deleting appointment:', error);
        }
      }
    },
    newAppointment() {
      this.$router.push({ name: 'NewAppointment' });
    },
  },
  created() {
    this.fetchAppointments();
  },
};
</script>
