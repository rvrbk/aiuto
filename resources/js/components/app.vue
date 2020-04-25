<template>
    <router-view></router-view>
</template>

<script>
    export default {
        data() {
            return {
                translations: []
            }
        },
        mounted() {
            const scope = this;

            switch(navigator.language.toLowerCase()) {
                case 'nl':
                case 'nl-nl':
                case 'be':
                case 'be-nl':
                    fetch('nl.locale.json').then(response => response.json()).then((response) => {
                        scope.translations = response;
                    });

                break;
                case 'en':
                case 'en-en':
                case 'en-us':
                default:
                    fetch('en.locale.json').then(response => response.json()).then((response) => {
                        scope.translations = response;
                    });
                
                break;
            }

            if(this.$route.path == '/') {
                this.$router.push({
                    name: 'map'
                });
            }
        }
    }
</script>