<template>
    <div class="w-full p-5 mx-auto ">        
        <div>                
            <div class="content-center" v-for="(room, index) in rooms"  :key="index" :value="room" >
                <img class="inline rounded-full mx-3 my-1" :src="'https://picsum.photos/id/'+room.id+'/40'" alt="img" height="30" width="30">
                <button @click="changeRoom(room)" class="focus:outline-none">
                    {{ room.name }}
                </button>   
                <span class="rounded bg-blue-500 text-xs px-2 text-white mx-1 "
                    v-for="(tag, index) in room.tags" :key="index" >
                    {{ tag.name }}
                </span>             
            </div>            
        </div>
    </div>
</template>

<script>
export default {
    props: ['rooms','tags'],
    methods: {
        changeRoom(room){
            console.log(room);
            this.$emit('roomchanged', room);
        }
    }
}
</script>