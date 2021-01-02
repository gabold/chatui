<template>
    <div class="w-full p-5 mx-auto mb-5">        
        <div class="font-semibold text-xl text-gray-500 leading-tight divide-y divide-gray-400 ">                
            <div class="content-center mb-2" v-for="(room, index) in rooms"  :key="index" :value="room" >
                <div v-if="Object.keys(room).length === 0">
                    <span>No se encontraron conversaciones en esta etiqueta</span> 
                </div>  
                <div v-else>
                    <img class="inline rounded-full mx-3 my-1 mt-3" :src="'https://picsum.photos/id/'+room.id+'/40'" alt="img" height="30" width="30">
                    <button @click="changeRoom(room)" class="focus:outline-none content-center">
                        {{ room.name }}
                    </button>   
                    <span class="rounded bg-blue-500 text-xs px-2 text-white mx-1 "
                        v-for="(tag, index) in room.tags" :key="index" >
                        {{ tag.name }}
                    </span>  
                </div>          
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