<script setup>
import {useMessagesStore} from "@/Store/useMessagesStore.js";

const messagesStore = useMessagesStore()
</script>

<template>
{{ messagesStore.messages }}
</template>
