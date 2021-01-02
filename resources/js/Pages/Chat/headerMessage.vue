<template>
    <div class="border-b-2 border-indigo-500 py-3 pl-8 flex items-center">
        <img class="rounded-full mx-3" :src="'https://picsum.photos/id/'+room.id+'/40'" alt="" height="40" width="40">
        <h2 class="font-bold text-xl">{{ room.name }}</h2>
        <span class="rounded bg-blue-500 text-xs px-2 text-white mx-1 "
            v-for="(tag, index) in roomTags" :key="index" >
            {{ tag.name }}
        </span>
    </div>
    
</template>
<script>
export default {
    props: ['room','roomTags']
}
</script>