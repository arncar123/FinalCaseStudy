<template>
  <div id="app">
    <nav>
      <ul>
        <li><router-link to="/appointments">Manage Appointments</router-link></li>
        <li><router-link to="/appointments/my-doctor">Manage My Appointments</router-link></li>
      </ul>
    </nav>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
/* Add some basic styling */
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

nav li {
  display: inline;
  margin: 0 10px;
}

nav a {
  color: #42b983;
  text-decoration: none;
}

nav a.router-link-exact-active {
  font-weight: bold;
}
</style>
