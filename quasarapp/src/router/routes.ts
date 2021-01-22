import { RouteConfig } from 'vue-router'

// @ts-ignore
const routes: RouteConfig[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: '/users', component: () => import('pages/UserComponent.vue') },
      { path: '/albums/:id', name: 'AlbumComponent', component: () => import('pages/AlbumComponent.vue') },
      { path: '/albums', component: () => import('pages/AlbumComponent.vue') },
      {
        path: '/add-photo/:album_id',
        name: 'AddPhotoForm',
        component: () => import('components/AddPhotoForm')
      },
      {
        path: ':album_id/photos',
        name: 'PhotoList',
        component: () => import('components/PhotoList')
      },
      {
        path: '/edit/:id',
        name: 'EditPhoto',
        component: () => import('components/AddPhotoForm')
      }

    ]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
