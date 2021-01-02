<template>
    <div class="m-3">
        <button class="rounded bg-blue-500 text-xs px-2 text-white mx-1"
            v-for="(tag, index) in tags" :key="index" >
            {{ tag.name }}
        </button>
    </div>
</template>
<script>
export default {
    props: ['tags']
}
</script>