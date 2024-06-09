import { createRouter, createWebHistory } from 'vue-router';
import ManageAppointments from '@/components/ManageAppointments.vue';
import ManageDoctorAppointments from '@/components/ManageDoctorAppointments.vue';
import AppointmentForm from '@/components/AppointmentForm.vue';

const routes = [
  { path: '/appointments', name: 'ManageAppointments', component: ManageAppointments },
  { path: '/appointments/my-doctor', name: 'ManageDoctorAppointments', component: ManageDoctorAppointments },
  { path: '/appointments/new', name: 'NewAppointment', component: AppointmentForm },
  { path: '/appointments/:id/edit', name: 'EditAppointment', component: AppointmentForm, props: true },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
