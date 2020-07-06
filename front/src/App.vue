<template>
  <div id="app">
    <div>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="#">Stechs App</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
          <!-- Right aligned nav items -->
          <!--
          <b-navbar-nav class="ml-auto">
            <b-nav-form>
              <b-form-input size="sm" class="mr-sm-2" placeholder="Type Vendor Name..."></b-form-input>
              <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
            </b-nav-form>
          </b-navbar-nav>
          -->
        </b-collapse>
      </b-navbar>
    </div>
    <div>
      <b-card title="Card Title" no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs>
            <b-nav-item href="/" to="/" exact exact-active-class="active">CableModems</b-nav-item>
            <b-nav-item href="/models" to="/models" exact exact-active-class="active">Models</b-nav-item>
          </b-nav>
        </b-card-header>
        <b-card-body class="text-center">
          <router-view/>
        </b-card-body>
      </b-card>
    </div>
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
export default {
  name: 'App',
  data () {
    return {
      msg: ''
    }
  }
}
</script>

<style scoped>
</style>
