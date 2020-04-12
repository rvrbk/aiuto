<template>
    <div class="view center">
        <router-link class="cancel" :to="{ name: 'map' }">x</router-link>
        <span v-if="!location">Please provide your location by allowing the 'Location' service.</span>
        <form v-if="location" @submit.prevent="save">
            <p><label><div>Your name</div><input type="text" required v-model="name" placeholder="Your name..."></label></p>
            <p><label><div>Your e-mail</div><input type="email" required v-model="email" placeholder="Your e-mail..."></label></p>
            <p><label><div>Summarize your call...</div><input type="text" required v-model="title" placeholder="Summarize your call..."></label></p>
            <p><label><div>What kind of help do you need?</div><select required v-model="category">
                <option value=""></option>
                <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ category.name }}</option>
            </select></label></p>
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
                category: null,
                coords: null,
                location: false,
                categories: []
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
                        category: scope.category,
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

            axios.get('/api/categories').then((response) => {
                scope.categories = response.data;
            });

            navigator.geolocation.getCurrentPosition((location) => {
                scope.coords = location.coords;

                scope.location = true;
            });
        }
    }
</script>