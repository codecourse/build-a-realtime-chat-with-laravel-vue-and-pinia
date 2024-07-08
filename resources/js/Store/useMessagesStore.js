import { defineStore } from "pinia";

export const useMessagesStore = defineStore('messages', {
    state: () => ({
        page: 1,
        messages: []
    }),

    getters: {
        allMessages (state) {
            return state.messages
        }
    }
})
