<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatTextarea from "@/Components/Chat/ChatTextarea.vue";
import {useMessagesStore} from "@/Store/useMessagesStore.js";
import ChatMessages from "@/Components/Chat/ChatMessages.vue";
import axios from "axios";
import {useUsersStore} from "@/Store/useUsersStore.js";
import ChatUsers from "@/Components/Chat/ChatUsers.vue";
import {onUnmounted} from "vue";

const props = defineProps({
    room: Object
})

const messagesStore = useMessagesStore()
const usersStore = useUsersStore()

messagesStore.fetchState(props.room.slug)

const storeMessage = (payload) => {
    messagesStore.storeMessage(props.room.slug, payload)
}

onUnmounted(() => {
    Echo.leave(`room.${props.room.id}`)
})

const channel = Echo.join(`room.${props.room.id}`)

channel
    .listen('MessageCreated', (e) => {
        messagesStore.pushMessage(e)
    })
    .here(users => usersStore.setUsers(users))
    .joining(user => usersStore.addUser(user))
    .leaving(user => usersStore.removeUser(user))
    .listenForWhisper('typing', e => usersStore.setTyping(e))
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ room.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-3">
                    <div class="p-6 text-gray-900">
                        <ChatUsers />
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9">
                    <div class="p-6 text-gray-900 space-y-3">
                        <ChatMessages :room="room" />

                        <ChatTextarea
                            class="w-full"
                            placeholder="Say something..."
                            v-on:valid="storeMessage({ body: $event })"
                            v-on:typing="channel.whisper('typing', { id: $page.props.auth.user.id, typing: $event })"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
