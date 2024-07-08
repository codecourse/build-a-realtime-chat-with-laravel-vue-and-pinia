<script setup>
import {useMessagesStore} from "@/Store/useMessagesStore.js";

const messagesStore = useMessagesStore()
</script>

<template>
    <div class="h-64 border border-gray-200 rounded-lg px-4 py-3 overflow-y-auto flex flex-col-reverse">
        <div
            v-for="message in messagesStore.allMessages"
            :key="message.id"
            class="flex space-x-3 mb-3"
        >
            <img :src="message.user.avatar" class="size-12 rounded-lg">
            <div>
                <div class="flex items-baseline space-x-2">
                    <div class="font-bold">{{ message.user.name }}</div>
                    <span class="text-xs text-gray-600">{{ message.created_at }}</span>
                </div>
                <p>{{ message.body }}</p>
            </div>
        </div>
    </div>
</template>
