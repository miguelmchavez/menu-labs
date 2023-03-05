<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <nav className="navbar" role="navigation" aria-label="main navigation">
      <div className="navbar-brand">
          <a className="navbar-item" href="#">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"/>
          </a>
          <a role="button" className="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
        <div id="navbarBasicExample" className="navbar-menu">
          <div className="navbar-start">
            <RouterLink to="/" class="navbar-item">Home</RouterLink>
          </div>
      </div>
    </nav>
  </header>
  <RouterView />
</template>

<style scoped>

</style>
