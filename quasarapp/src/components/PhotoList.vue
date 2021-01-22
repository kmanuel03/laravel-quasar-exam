<template>
  <div class="q-pa-md">
    <q-toolbar class="bg-primary text-white shadow-2">
      <q-toolbar-title>Photos</q-toolbar-title>
    </q-toolbar>

    <q-list bordered>
      <q-item>
        <q-item-section>
          <b>TITLE</b>
        </q-item-section>
        <q-item-section>
          <b>URL</b>
        </q-item-section>
        <q-item-section>
          <b>THUMBNAIL URL</b>
        </q-item-section>
        <q-item-section>
          <b>ACTIONS</b>
        </q-item-section>
      </q-item>
      <q-item v-for="photo in photos" class="q-my-sm" clickable v-ripple>
        <q-item-section>
          <q-item-label>{{ photo.title }}</q-item-label>
        </q-item-section>
        <q-item-section>
          <q-item-label><img :src="photo.url" height="100" width="100"></q-item-label>
        </q-item-section>
        <q-item-section>
          <q-item-label><img :src="photo.thumbnail_url" height="100" width="100"></q-item-label>
        </q-item-section>
        <q-item-section>
          <router-link :to="{ name: 'EditPhoto', params: {id: photo.id } }"> Edit Photo</router-link>
        </q-item-section>
        <q-item-section>
          <q-btn outline style="color: goldenrod;" label="Delete Photo" @click="deletePhoto(photo.id, photo.album_id)" />
        </q-item-section>
      </q-item>
      <q-separator />
    </q-list>
  </div>
</template>

<script>
import {
  defineComponent, PropType, computed, ref, toRef, Ref
} from '@vue/composition-api'
export default defineComponent({
  name: 'PhotoList',
  data: () => {
    return {
      photos: []
    }
  },

  methods: {
    getAllPhotosInAlbum() {
      this.$axios.get(process.env.API+'album/'+this.$route.params.album_id+'/get-photos').then(response => {
        this.photos = response.data.data;
      })
    },
    deletePhoto(id) {
      this.$axios.post(process.env.API+'album/photo/delete/'+id, { album_id: this.$route.params.album_id }).then(response => {
        this.photos = response.data.data;
      })
    }

  },
  mounted() {
    this.getAllPhotosInAlbum();
  }
})
</script>

<style scoped>

</style>
