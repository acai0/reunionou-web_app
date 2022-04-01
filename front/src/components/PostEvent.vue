<template>
<form class="box" @submit.prevent="posterEvent">
      <div class="buttons">
          <button class="button is-info is-outlined"> poster </button>
      </div>
    </form>                                                    
</template>
<script>
export default {
props : ["event"],
 data(){
        return {
            event : '',
        }
    },
    methods : {
        posterEvent(){
            this.$api.post(`events/${this.event.id}`,{
                channel_id : this.event.id,
                event : this.event,
                event_id : this.$store.state.member.id}).then(response =>{
                   this.$bus.$emit('newEvent',response.data);
                    this.event = "";
                })
            }
        }
}
</script>

<style lang="scss">
 @import "../scss/bulma.scss";
</style>
