<template>
    <app-layout>
        <div class="container py-10 mx-auto">
            <div class="max-w-xl bg-white overflow-hidden shadow-xl sm:rounded-lg mx-3 float-left">
                <conversation-selection class="float-left font-semibold text-xl text-gray-500 leading-tight"
                    v-if="room.id" :rooms="rooms" :room="room" v-on:roomchanged="setRoom( $event )"/>
            </div> 
            <div class="max-w-6xl bg-white overflow-hidden shadow-xl sm:rounded-lg mx-3">
                <header-message :room="room" :tags="tags"/>
                <message-container :messages="messages" />
                <input-message :room="room" v-on:messagesent="getMessages()"/>               
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import MessageContainer from './messageContainer.vue'    
import HeaderMessage from './headerMessage.vue'
import InputMessage from './inputMessage.vue'
import ConversationSelection from './conversationSelection.vue'

export default {
    components: {
        AppLayout,
        MessageContainer,
        HeaderMessage,
        InputMessage,
        ConversationSelection,
    },
    data: function() {
        return {
            rooms: [],
            room: [],
            messages: [],
            tags: []
        }
    },
    watch: {
        currentRoom( val, oldVal) {
            if( oldVal.id ){
                this.disconnect( oldVal );
            }
            this.connect();
        }
    },
    methods: {
        connect(){
            if( this.room.id) {
                let vm = this;
                this.getMessages();
                window.Echo.private("chat." + this.room.id)
                .listen('NewChatMessage', (e) => {
                    vm.getMessages();
                })
            }
        },
        disconnect ( room ) {
            window.Echo.leave("chat." + room.id);
        },
        getRooms() {
            axios.get('/chat/rooms')
            .then( response => {
                this.rooms = response.data;
                this.setRoom(response.data[0]);
            })
            .catch ( error => {
                console.log(error);
            })
        }, 
        setRoom( room ) {
            this.room = room;
            this.getMessages();
            this.getRoomTags();
        },
        getMessages(){
            axios.get('/chat/room/'+ this.room.id + '/messages')
            .then ( response => {
                this.messages = response.data;
            })
            .catch ( error => {
                console.log(error);
            })
        },
        getRoomTags(){
            axios.get('/chat/room/'+ this.room.id + '/tags')
            .then ( response => {
                this.tags = response.data;
            })
            .catch ( error => {
                console.log(error);
            })
        }
    },
    created(){
        this.getRooms();
    }
}
</script>
