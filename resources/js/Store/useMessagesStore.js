import { defineStore } from "pinia";
import axios from 'axios'

export const useMessagesStore = defineStore('messages', {
    state: () => ({
        page: 1,
        messages: []
    }),

    actions: {
        fetchState (roomSlug, page = 1) {
            axios.get(`/rooms/${roomSlug}/messages`)
                .then(response => {
                    this.page = response.data.meta.current_page
                    this.messages = [...this.messages, ...response.data.data]
                })
        }
    },

    getters: {
        allMessages (state) {
            return state.messages
        }
    }
})
