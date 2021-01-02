<template>
    <div class="bg-white h-300 m-1">        
        <editor v-model="markdownText" height="300px"/>
        <button 
            @click="sendMarkdown()"
            class="float-right bg-gray-500 hover:bg-blue-700   rounded text-white outline-none my-1 py-1 px-3">
            Enviar markdown
        </button>
    </div>
</template>
<script>
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';
 
import { Editor } from '@toast-ui/vue-editor';

export default {
    name: 'MarkdownEditor',
    data() {
        return {
            markdownText: '',
        }
    },
    components: {
        'editor': Editor
    },
    methods: {
        sendMarkdown() {
            if(this.markdownText == '') {
                return;
            }
            axios.post('/chat/room/'+ this.room.id +'/message', {
                message: JSON.stringify(this.markdownText)
            }).then( response => {
                if( response.status == 201) {
                    this.markdownText = '';
                    this.$emit('markdownsent');
                }
            }).catch( error => {
                console.log(error);
            })
        }
    }
}
</script>