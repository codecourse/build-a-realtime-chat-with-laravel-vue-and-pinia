import { defineStore } from "pinia";

export const useUsersStore = defineStore('users', {
    state: () => ({
        users: []
    }),

    actions: {
        setUsers (users) {
            this.users = users
        }
    },

    getters: {
        allUsers (state) {
            return state.users
        },

        count (state) {
            return state.users.length
        }
    }
})
