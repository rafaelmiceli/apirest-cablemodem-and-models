import Vue from 'vue'
import Router from 'vue-router'
import CableModems from '@/components/CableModems'
import Models from '@/components/Models'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'CableModems',
      component: CableModems
    },
    {
      path: '/models',
      name: 'Models',
      component: Models
    }
  ]
})
