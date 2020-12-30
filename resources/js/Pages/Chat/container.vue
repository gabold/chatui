<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <conversation-selection 
                v-if="room.id"
                :rooms="rooms"
                :room="room"
                v-on:roomchanged="setRoom( $event)"/>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container
                        :messages="messages" />
                    <input-message 
                        :room="room"
                        v-on:messagesent="getMessages()" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MessageContainer from './messageContainer.vue'
    import InputMessage from './inputMessage.vue'
    import ConversationSelection from './conversationSelection.vue'

    export default {
        components: {
            AppLayout,
            MessageContainer,
            InputMessage,
            ConversationSelection,
        },
        data: function() {
            return {
                rooms: [],
                room: [],
                messages: []
            }
        },
        watch: {
            room( val, oldVal) {
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
                    .listen('.message.new', e => {
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
            },
            getMessages(){
                axios.get('/chat/room/'+ this.room.id + '/messages')
                .then ( response => {
                    this.messages = response.data;
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
