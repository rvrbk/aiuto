<template>
    <div class="view center">
        <span v-if="!location">Please provide your location by allowing the 'Location' service.</span>
        <form v-if="location" @submit="save">
            <p><label><div>Your name</div><input type="text" required v-model="name" placeholder="Your name..."></label></p>
            <p><label><div>Your e-mail</div><input type="email" required v-model="email" placeholder="Your e-mail..."></label></p>
            <p><label><div>Summarize your call...</div><input type="text" required v-model="title" placeholder="Summarize your call..."></label></p>
            <p><label><div>I need help doing...</div><textarea required v-model="help" placeholder="I need help doing..."></textarea></label></p>
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
                title: '',
                help: '',
                coords: null,
                location: false
            }
        },
        methods: {
            save() {
                const scope = this;
                
                if(scope.name != '' && scope.email != '') {
                    axios.post('/api/help', {
                        name: scope.name,
                        email: scope.email,
                        title: scope.title,
                        help: scope.help,
                        latitude: scope.coords.latitude,
                        longitude: scope.coords.longitude,
                    }).then((response) => {
                        scope.$router.push({
                            name: 'map',
                            params: {
                               flash: 'activate-help'
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