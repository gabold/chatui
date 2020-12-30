<template>
    <div class="border-b-2 border-indigo-500 py-3 pl-8 font-bold text-xl ">
        {{ room.name }} <br>
        <span 
            v-for="(tag, index) in tags" 
            :key="index"
            :value="tag">
            {{tag.conversation.name}}
            <div
                v-for="(roomTag, index) in tags.conversations" 
                :key="index"
                :value="roomTag">
                {{ roomTag.name }}
            </div>
        </span>
    </div>
</template>
<script>
export default {
    props: ['room','tags']
}
</script>