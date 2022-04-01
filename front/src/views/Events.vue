<template>
  <div>
    <Header />
    <section class="section">
      <h4 class="title is-4 has-text-centered">Mes évènements</h4>
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-11-tablet is-10-desktop is-9-widescreen">
            <template v-for="event in events">
              <event
                class="box"
                :key="event.id"
                :event="event"
              />
            </template>
            
            <!--
               <posterEvent :event="event" />
      <h4 class="title is-4">Evénenement</h4>
      <template v-for="event in events">
        <event :event="event" :key="event.id" />
      </template>
      -->
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Event from "../components/Event.vue";
import PostEvent from "../components/PostEvent.vue";
export default {
  components: {
    PostEvent,
    Event,
  },
  data() {
    return {
      events: [],
    };
  },
  mounted() {
    this.$api.get("events").then((response) => {
      this.events = response.data;
    });
  },
};
</script>
<style lang="scss">
 @import "../scss/bulma.scss";
</style>
