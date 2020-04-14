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

            switch(navigator.language) {
                case 'nl':
                case 'nl-NL':
                case 'be':
                case 'be-NL':
                    fetch('nl.locale.json').then(response => response.json()).then((response) => {
                        scope.translations = response;
                    });

                break;
                case 'en':
                case 'en-EN':
                case 'en-US':
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