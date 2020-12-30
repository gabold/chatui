<template>
    <div class="w-full p-5 mx-auto">        
        <div> 
            <select 
                v-model="roomSelected"
                @change="$emit('roomchanged', roomSelected)" class="outline-none button">
                
                <option
                    v-for="(room, index) in rooms" 
                    :key="index"                
                    :value="room" >
                    Room: {{ room.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    props: ['rooms','room'],
    data: function(){
        return {
            roomSelected: ''
        }
    },
    created() {
        this.roomSelected = this.room
    }
}
</script>