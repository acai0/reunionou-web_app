<template>
  <section class="hero is-fullheight">
    <Header />
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-12-tablet is-11-desktop is-10-widescreen">
            <h4 class="title is-4 has-text-centered">Modifier l'évènement</h4>
            <form class="box" @submit.prevent="editConversation">
                           <div class="field">
                <label class="label">Titre</label>
                <div class="control">
                  <input class="input" v-model="editedConversation.topic" />
                </div>
              </div>
              <div class="field">
                <label class="label">Description</label>
                <div class="control">
                  <input class="input" v-model="editedConversation.label" />
                </div>
              </div>
              <div class="field">
                <label class="label">Lieu</label>
                <div class="control">
                  <input class="input" v-model="editedConversation.place" />
                </div>
              </div>
               <div class="field">
                <label class="label">Date</label>
                <div class="control">
                  <input class="input" v-model="editedConversation.date" />
                </div>
              </div>
               <div class="field">
                <label class="label">Heure</label>
                <div class="control">
                  <input class="input" v-model="editedConversation.heure" />
                </div>
              </div>
              <div class="buttons">
                <button class="button is-info is-outlined">Modifier</button>
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
export default {
  data() {
    return {
        idConversation : this.$route.params.id,
      editedConversation: {
        label: "",
        topic: "",
        place:"",
        date:"",
        heure:"",
      },
    };
  },
  mounted(){
      //Je récupère le label et le sujet avant modification pour les afficher dans le input
      this.$api.get(`channels/${this.idConversation}`).then((response) => {
          this.editedConversation.label = response.data.label;
          this.editedConversation.topic = response.data.topic;
           this.editedConversation.place = response.data.place;
            this.editedConversation.date = response.data.date;
             this.editedConversation.heure = response.data.heure;
      })
  },
  methods: {
      //Si aucune modification n'est faite sur le sujet et label, leurs ancienne valeurs restent ainsi.
    editConversation() {
      this.$api
        .put(`channels/${this.idConversation}`,this.editedConversation)
        .then(() => {
        this.$router.push('/');
        })
        .catch((error) => {
          alert(error.response.data.message);
        });
    },
  },
};
</script>
<style lang="scss">
 @import "../scss/bulma.scss";
</style>
