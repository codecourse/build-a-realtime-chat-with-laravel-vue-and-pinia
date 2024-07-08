<script setup>
import {useMessagesStore} from "@/Store/useMessagesStore.js";
import { useIntersectionObserver} from "@vueuse/core";
import {ref} from "vue";

const props = defineProps({
    room: Object
})

const messagesStore = useMessagesStore()

const target = ref(null)

const { stop } = useIntersectionObserver(
    target,
    ([{ isIntersecting }], observerElement) => {
        if (!isIntersecting) {
            return
        }

        messagesStore.fetchPreviousState(props.room.slug)
    }
)
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
        <div ref="target" class="translate-y-20"></div>
    </div>
</template>
