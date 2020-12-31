import Vue from 'vue'
import Vuex from 'vuex'

import exam from './exam'
// import theme from './theme'
// import contact from './contact'
// import qr from './qr'

Vue.use(Vuex)
/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
      modules: {
          exam
      },

      // enable strict mode (adds overhead!)
      // for dev mode only
      strict: false
  })

  return Store
}
