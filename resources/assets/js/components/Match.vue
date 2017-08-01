<template>
    <div v-if="match">

    </div>
</template>

<script>
    export default {
        mounted() {
            if(this.inimatch)this.match = this.inimatch;
        },
        props:['inimatch'],
        data(){
            return {
                match: null
            }
        },
        methods:{

        }
    }
</script>
