<template>
    <div class="view center">
        <span v-if="!location">Please provide your location by allowing the 'Location' service.</span>
        <form v-if="location" @submit.prevent="save">
            <p><label><div>Your name</div><input type="text" required v-model="name" placeholder="Your name..."></label></p>
            <p><label><div>Your e-mail</div><input type="email" required v-model="email" placeholder="Your e-mail..."></label></p>
            <p><label><div>I offer...</div><textarea required v-model="offer" placeholder="I offer..."></textarea></label></p>
            <p><input type="submit" value="save"></p>
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

            navigator.geolocation.getCurrentPosition((location) => {
                scope.coords = location.coords;

                scope.location = true;
            });
        }
    }
</script>