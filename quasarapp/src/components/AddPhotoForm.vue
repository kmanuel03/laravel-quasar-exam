<template>
  <div class="q-pa-md" style="max-width: 400px">

    <q-form
      @submit="onSubmit"
      @reset="onReset"
      class="q-gutter-md"
    >
      <q-input
        filled
        v-model="photo.title"
        label="Photo Title"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />

      <q-input
        filled
        v-model="photo.url"
        label="Photo Url"
        lazy-rules
        :rules="[
          val => val !== null && val !== '' || 'Please type something',
        ]"
      />

      <q-input
        filled
        v-model="photo.thumbnail_url"
        label="Photo Thumbnail Url"
        lazy-rules
        :rules="[
          val => val !== null && val !== '' || 'Please type something',
        ]"
      />


      <div>
        <q-btn label="Submit" type="submit" color="primary"/>
        <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
      </div>
    </q-form>
    <q-dialog v-model="alert">
      <q-card>
        <q-card-section>
          <div class="text-h6">Alert</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          {{ message }}
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="OK" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>

  </div>
</template>

<script lang="ts">
import {
  defineComponent, PropType, computed, ref, toRef, Ref
} from '@vue/composition-api'

export default defineComponent({
  name: 'AddPhotoForm',
  data () {
    return {
      photo:{},
      alert: false,
      message: ''
    }
  },

  methods: {
    onSubmit () {
      if(this.$route.params.album_id) {
        this.photo.album_id = this.$route.params.album_id;
        this.$axios.post(process.env.API+'album/photo/store', this.photo).then(response => {
          this.alert = true;
          this.message = 'Photo was successfully created.';
        })
      }
      if(this.$route.params.id) {
        this.photo.id = this.$route.params.id;
        this.$axios.post(process.env.API+'album/photo/edit/'+this.photo.id,this.photo).then(response => {
          this.alert = true;
          this.message = 'Photo was successfully updated.';
        })
      }
    },

    onReset () {
      this.name = null
      this.age = null
      this.accept = false
    },
    populateData() {
      this.$axios.get(process.env.API+'album/photo/details/'+this.$route.params.id).then(response => {
        this.photo = response.data.data;
      })
    }
  },
  mounted() {
    if(this.$route.params.id) {
      this.populateData();
    }
  }
})
</script>

<style scoped>

</style>
