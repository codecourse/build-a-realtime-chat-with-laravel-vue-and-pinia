<script setup>
import {ref} from "vue";

const emit = defineEmits()

const shift = ref(false)
const model = ref('')

const handleEnter = () => {
    if (shift.value && model.value.length) {
        model.value = model.value + '\n'
        return
    }

    if (model.value.length) {
        emit('valid', model.value)
        model.value = ''
    }
}
</script>

<template>
    <textarea
        v-model="model"
        rows="4"
        id="body"
        class="border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-on:keydown.enter.prevent="handleEnter"
        v-on:keydown.shift="shift = true"
        v-on:keyup="shift = false"
    />
</template>
