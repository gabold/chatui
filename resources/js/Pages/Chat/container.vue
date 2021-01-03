<template>
    <app-layout>
        <div class="container py-3 mx-auto min-h-screen">            
            <div class="float-left max-w-xl bg-white overflow-hidden shadow-xl sm:rounded-lg mx-3 lg:w-96 h-auto border">
                <div v-if="currentTag!=null" class="mt-5 mx-10">
                    <button @click="reset()" class="text-indigo-500">Atras</button> 
                    <h1 class="font-bold text-2xl">{{currentTag.name}}</h1>
                </div>
                <conversation-selection :rooms="rooms" :tags="tags" v-on:roomchanged="setRoom( $event )"/>
                <div class="max-w-xl h-auto m-5">
                    <tags :tags="tags" v-on:getrooms="getRoomsbyTag( $event )"/>
                </div> 
            </div>             
            <div class="float-center max-w-6xl bg-white overflow-hidden shadow-xl sm:rounded-lg mx-3 lg:w-auto h-auto border">
                <header-message :room="room" :roomTags="roomTags"/>
                <message-container :messages="messages"/>
                <input-message :room="room" v-on:messagesent="getMessages()"/>   
                <markdown-editor v-on:markdownsent="getMessages()"/>            
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
import MarkdownEditor from './markdownEditor.vue'
import Tags from './tags.vue'

export default {
    components: {
        AppLayout,
        MessageContainer,
        HeaderMessage,
        InputMessage,
        ConversationSelection,
        MarkdownEditor,
        Tags,
    },
    data: function() {
        return {
            rooms: [],
            room: '',
            messages: [],
            tags: [],
            roomTags: [],
            currentTag: null
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
        getAllTags(){
            axios.get('/chat/tags')
            .then ( response => {
                this.tags = response.data;
                console.log('tags cargadas');
            })
            .catch ( error => {
                console.log(error);
            })
        },
        getRoomTags(){
            axios.get('/chat/room/'+ this.room.id + '/tags')
            .then ( response => {
                this.roomTags = response.data;
            })
            .catch ( error => {
                console.log(error);
            })
        },
        getRoomsbyTag( tag ) {
            axios.get('/chat/rooms/tag/'+ tag.id)
            .then( response => {
                if(response.data.length ===0){
                    this.rooms = response.data;
                    this.currentTag = tag;
                }else{
                    this.rooms = response.data;
                    this.setRoom(response.data[0]);
                    this.currentTag = tag;
                }
            })
            .catch ( error => {
                console.log(error);
            })
        },
        reset(){
            this.getRooms();
            this.currentTag = null;        
        }
    },
    created(){
        this.getRooms();
        this.getAllTags();
    }
}
</script>
