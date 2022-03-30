<template>
<section class="hero header">

  <!-- rendre le header responsive -->
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <router-link class="navbar-item coop" to="/"><a href="/"><img src="../img/Reunionou.png"/></a></router-link>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <router-link class="navbar-item" to="/">Mes Events</router-link>
        <router-link class="navbar-item" to="/createConversation">Nouveau event</router-link>
         <router-link class="navbar-item" to="/Invitation">Invitation</router-link>
        <router-link class="navbar-item" to="/Members">Membres</router-link>
      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="navbar-item"><p class="header-item">connecté(e) en tant que <b class="header-item"> {{$store.state.member.fullname}}</b></p></div>
          <div class="buttons">
            <router-link class="navbar-item button is-warning" to="/logOut">Déconnexion</router-link>
          </div>
        </div>
      </div>
    </div>
  </nav>
</section>
</template>

<script>
export default {
}
</script>

<style lang="scss">
.header{
  background-color: rgb(255, 255, 128);;
}
.navbar-item{
  color : rgb(0, 0, 0);
}
.coop{
    font-family: 'Comic Sans Serif', sans-serif;
}
</style>
