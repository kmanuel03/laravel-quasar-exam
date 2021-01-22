<template>
    <q-page>
      <div class="q-pa-md">
        <q-toolbar class="bg-primary text-white shadow-2">
          <q-toolbar-title>Users</q-toolbar-title>
        </q-toolbar>

        <q-list bordered>
          <q-item v-for="user in users" class="q-my-sm" clickable v-ripple>
            <q-item-section>
              <q-item-label>{{ user.name }}</q-item-label>
            </q-item-section>
            <q-item-section>
              <q-item-label caption lines="1">{{ user.username }}</q-item-label>
            </q-item-section>
            <q-item-section>
              <q-item-label caption lines="1">{{ user.email }}</q-item-label>
            </q-item-section>
            <q-item-section width="200px">
              <q-item-label caption lines="1">{{ user.phone }}</q-item-label>
            </q-item-section>
            <q-item-section>
              <router-link :to="{ name: 'AlbumComponent', params: {id: user.id } }"> View Albums</router-link>
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
      users: []
    }
  },
  methods: {
    getAllUsers() {
      this.$axios.get(process.env.API+'user/list').then(response => {
        this.users = response.data.data;
      })
    }
  },
  mounted() {
    this.getAllUsers();
  }
})
</script>
