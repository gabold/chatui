<template>
    <div class="h-10 m-1">
        <div class="">
            <input 
                type="text" 
                v-model="message" 
                @keyup.enter="sendMessage()" 
                placeholder="Escribe algo..."
                class="col-span-10 outline-none p-2" />
            <button 
                @click="sendMessage()"
                class="float-right bg-gray-500 hover:bg-blue-700 my-1 py-1 px-3 rounded text-white outline-none">
                Enviar mensaje
            </button>
        </div>
    </div>
</template>

<script>
import Input from '../../Jetstream/Input.vue'
export default {
    components: { Input },
    props: ['room'],
    data: function (){
        return {
            message: ''
        }
    },
    methods: {
        sendMessage() {
            if(this.message == '') {
                return;
            }
            axios.post('/chat/room/'+ this.room.id +'/message', {
                message: this.message
            }).then( response => {
                if( response.status == 201) {
                    this.message = '';
                    this.$emit('messagesent');
                }
            }).catch( error => {
                console.log(error);
            })
        }
    }
}
</script>