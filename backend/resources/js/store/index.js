import { defineStore } from 'pinia'

// You can name the return value of `defineStore()` anything you want, 
// but it's best to use the name of the store and surround it with `use` 
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
// export const useAlertsStore = defineStore('alerts', {
  // other options...
// })
var host = window.location.origin;
export const useBankStore = defineStore('bank', {
    state: () => ({
        count       : 0,
        name        : 'Eduardo',
        url         : host + "",
        role        : null,
        profileName : null,
        user_id     : localStorage.user_id,
        token       : localStorage.token
    }),
    // state: () => {
    //     return {
    //         count   : 0,
    //         name    : 'Eduardo',
    //         url     : host + ""
    //     }
    // },
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        saveProfileName(profileName, role) {
            this.profileName    = profileName
            this.role           = role
        },
        increment() {
            this.count++
        },
    },

    // return { url }
})