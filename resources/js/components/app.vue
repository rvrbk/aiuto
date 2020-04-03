<template>
    <router-view></router-view>
</template>

<script>
    export default {
        mounted() {
            if(this.$route.path == '/') {
                this.$router.push({
                    name: 'map'
                });
            }
        }
    }
</script>