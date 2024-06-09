<template>
    <div>
      <h2>{{ isEditMode ? 'Edit' : 'New' }} Appointment</h2>
      <form @submit.prevent="saveAppointment">
        <div>
          <label for="appointment_date">Date:</label>
          <input type="datetime-local" v-model="appointment.appointment_date" required>
        </div>
        <div>
          <label for="reason">Reason:</label>
          <textarea v-model="appointment.reason"></textarea>
        </div>
        <button type="submit">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'AppointmentForm',
    props: ['id'],
    data() {
      return {
        appointment: {
          patient_id: null,
          doctor_id: null,
          appointment_date: '',
          reason: '',
        },
        isEditMode: false,
      };
    },
    methods: {
      async fetchAppointment() {
        try {
          const response = await axios.get(`http://localhost:8000/api/appointments/${this.id}`);
          this.appointment = response.data;
        } catch (error) {
          console.error('Error fetching appointment:', error);
        }
      },
      async saveAppointment() {
        try {
          if (this.isEditMode) {
            await axios.put(`http://localhost:8000/api/appointments/${this.id}`, this.appointment);
          } else {
            this.appointment.patient_id = this.$store.state.user.id; // Assign current user as patient
            await axios.post('http://localhost:8000/api/appointments', this.appointment);
          }
          this.$router.push({ name: 'ManageAppointments' });
        } catch (error) {
          console.error('Error saving appointment:', error);
        }
      },
    },
    created() {
      if (this.id) {
        this.isEditMode = true;
        this.fetchAppointment();
      }
    },
  };
  </script>
  