<template>
    <div class="">        
        <div v-if="message.user.id==11">
            <div class="relative rounded bg-white shadow-lg m-5 p-2 m-2 gap-2 h-24">
                <div class="absolute top-10 right-3 text-blue-700">{{message.user.name}}: </div>
                <div class="absolute top-15 right-3"> {{message.message}} </div> 
                <span class="absolute top-3 right-3 flex justify-end mr-0">{{message.created_at}}</span>
            </div>
        </div>
        <div v-else>
            <div class="relative rounded bg-white shadow-lg m-5 p-2 m-2 gap-2">
                <div class="text-blue-700">{{message.user.name}}: </div> {{message.message}} 
                <span class="absolute top-3 right-3 flex justify-end mr-0">{{message.created_at}}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>