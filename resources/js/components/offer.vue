<template>
    <div class="view center">
        <router-link class="cancel" :to="{ name: 'map' }">x</router-link>
        <span v-if="!location">{{ $parent.translations['provide-location'] }}</span>
        <form v-if="location" @submit.prevent="save">
            <p><label><div>{{ $parent.translations.name }}</div><input type="text" required v-model="name" v-bind:placeholder="$parent.translations.name"></label></p>
            <p><label><div>{{ $parent.translations.email }}</div><input type="email" required v-model="email" v-bind:placeholder="$parent.translations.email"></label></p>
            <p><label><div>{{ $parent.translations.offer }}</div><textarea required v-model="offer" v-bind:placeholder="$parent.translations.offer"></textarea></label></p>
            <p><input type="submit" v-bind:value="$parent.translations.save"></p>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                offer: '',
                coords: null,
                location: false
            }
        },
        methods: {
            save() {
                const scope = this;
                
                if(scope.name != '' && scope.email != '') {
                    axios.post('/api/offer/' + this.$route.params.help_id, {
                        name: scope.name,
                        email: scope.email,
                        offer: scope.offer,
                        latitude: scope.coords.latitude,
                        longitude: scope.coords.longitude,
                    }).then((response) => {
                        scope.$router.push({
                            name: 'map',
                            params: {
                               flash: 'offer-send'
                            }
                        });
                    });
                }
            }
        },
        mounted() {
            const scope = this;

            fetch('locale.json').then(response => response.json()).then((response) => {
                scope.translations = response;
            });

            navigator.geolocation.getCurrentPosition((location) => {
                scope.coords = location.coords;

                scope.location = true;
            });
        }
    }
</script>