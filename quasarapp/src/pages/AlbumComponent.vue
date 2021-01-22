<template>
  <q-page>
  <div class="q-pa-md">
    <q-toolbar class="bg-primary text-white shadow-2">
      <q-toolbar-title>Albums</q-toolbar-title>
    </q-toolbar>

    <q-list bordered>

        <q-item>
          <q-item-section>
            <b>TITLE</b>
          </q-item-section>
          <q-item-section>
            <b>OWNER</b>
          </q-item-section>
          <q-item-section>
            <b>ACTIONS</b>
          </q-item-section>
        </q-item>
      <q-item v-for="album in albums" class="q-my-sm" clickable v-ripple>
        <q-item-section>
          <q-item-label>{{ album.title }}</q-item-label>
        </q-item-section>
        <q-item-section>
          <q-item-label>{{ album.users.name }}</q-item-label>
        </q-item-section>
        <q-item-section>
          <router-link :to="{ name: 'PhotoList', params: {album_id: album.id } }"> View Photos</router-link>
        </q-item-section>
        <q-item-section>
          <router-link :to="{ name: 'AddPhotoForm', params: {album_id: album.id } }"> Add Photo</router-link>
        </q-item-section>
      </q-item>
      <q-separator />
    </q-list>
  </div>
  </q-page>
</template>

<script lang="ts">
import {
  defineComponent, PropType, computed, ref, toRef, Ref
} from '@vue/composition-api'
export default defineComponent({
  name: 'UserComponent',
  data: () => {
    return {
      albums: []
    }
  },

  methods: {
    getAlbumsByUser() {
      this.$axios.get(process.env.API+'user/albums/'+this.$route.params.id).then(response => {
        this.albums = response.data.data;
      })
    },
    getAllAlbums() {
      this.$axios.get(process.env.API+'album/list').then(response => {
        this.albums = response.data.data;
      })
    },
  },
  mounted() {
    if(this.$route.params.id) {
      this.getAlbumsByUser();
    } else {
      this.getAllAlbums();

    }
  }
})
</script>

<style scoped>

</style>
