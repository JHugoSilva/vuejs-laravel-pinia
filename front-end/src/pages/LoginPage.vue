<script setup>
    import { useRouter } from 'vue-router'

    const router = useRouter()

    const handleClick = () => {
        router.push({ name: 'tasks'})
    }
</script>

<template>
    <h1>Login</h1>
    <button class="btn btn-primary" @click="handleClick">Login</button>
</template>