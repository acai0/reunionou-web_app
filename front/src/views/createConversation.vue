<template>
  <section class="hero is-fullheight">
    <Header />
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-12-tablet is-11-desktop is-10-widescreen">
            <h4 class="title is-4 has-text-centered">Nouveau event</h4>
            <form class="box" @submit.prevent="createConversation">
              <div class="field">
                <label class="label">Titre</label>
                <div class="control">
                  <input class="input" v-model="conversation.topic" />
                </div>
              </div>
              <div class="field">
                <label class="label">Description</label>
                <div class="control">
                  <input class="input" v-model="conversation.label" />
                </div>
              </div>
              <div class="field">
                <label class="label">Lieu</label>
                <div class="control">
                  <input class="input" v-model="conversation.place" />
                </div>
              </div>
              <div class="field">
                <label class="label">Date</label>
                <div class="control">
                  <input class="input" v-model="conversation.date" />
                </div>
              </div>
              <div class="field">
                <label class="label">Heure</label>
                <div class="control">
                  <input class="input" v-model="conversation.heure" />
                </div>
              </div>
              <l-map
                v-if="showMap"
                :zoom="zoom"
                :center="initialLocation"
                :options="mapOptions"
                style="height: 350px; width: 100%"
                @update:center="centerUpdate"
                @update:zoom="zoomUpdate"
                @click="handleMapClick"
              >
                <l-tile-layer :url="url" :attribution="attribution" />
                <l-marker
                  :key="index"
                  v-for="(m, index) in markers"
                  :lat-lng="m.pos"
                >
                  <l-tooltip
                    :options="{ permanent: true, interactive: true }"
                    >{{ place }}</l-tooltip
                  >
                </l-marker>
              </l-map>

              <div class="buttons">
                <button class="button is-info is-outlined">Créer</button>
                <router-link class="button is-outlined" to="/"
                  >Annuler</router-link
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";
import { Icon } from "leaflet";
export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
  },
  data() {
    return {
      conversation: {
        label: "",
        topic: "",
        place: "",
        date: "",
        heure: "",
      },
      error: false,
      success: false,
      title: "",
      description: "",
      date: "",
      time: "",
      location: "",
      initialLocation: [46.227638, 2.213749],
      markers: [],
      x: false,
      y: false,
      zoom: 15,
      center: latLng(location.x, location.y),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      withPopup: latLng(47.41322, -1.219482),
      showParagraph: false,
      withTooltip: latLng(47.41422, -1.250482),
      currentZoom: 15,
      currentCenter: latLng(location.x, location.y),
      mapOptions: {
        zoomSnap: 0.5,
      },
      showMap: true,
    };
  },
  methods: {
    createConversation() {
      this.$api
        .post("channels", this.conversation)
        .then((response) => {
          this.$router.push({
            name: "Conversation",
            params: { id: response.data.id },
          });
        })
        .catch((error) => {
          alert(error.response.data.message);
        });
    },
     getLocation() {
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(this.updateLocation);
        }
    },
    updateLocation(position) {
        let currentLocation = [position.coords.latitude, position.coords.longitude];
        this.initialLocation = currentLocation;
    },
    
    zoomUpdate(zoom) {
    this.currentZoom = zoom;
    },
    centerUpdate(center) {
      this.currentCenter = center;
    },
    handleMapClick(event) {
        const pos = L.latLng(event.latlng.lat, event.latlng.lng);
        this.markers = [];
        this.markers.push({ pos: pos });
        this.x = event.latlng.lat;
        this.y = event.latlng.lng;
    }
  },
};
</script>
<style lang="scss">
@import "../scss/bulma.scss";
</style>
