import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

var host = window.location.hostname=='127.0.0.1' ? 'http://127.0.0.1:8000' : 'https://saijaan.smkn1kotabaru.xyz';

export const useCounterStore = defineStore('counter', {
    state: () => ({
    //     count       : 0,
        // name        : 'Eduardo',
        url         : host + "",
    //     role        : null,
    //     profileName : null,
    //     user_id     : localStorage.user_id,
    //     token       : localStorage.token
    }),
    
    // const count = ref(0)
    // const doubleCount = computed(() => count.value * 2)
    // function increment() {
    //     count.value++
    // }

    // return { count, doubleCount, increment }
})
