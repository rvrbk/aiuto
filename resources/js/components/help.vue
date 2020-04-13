<template>
    <div class="view center">
        <router-link class="cancel" :to="{ name: 'map' }">x</router-link>
        <span v-if="!location">{{ translations['provide-location'] }}</span>
        <form v-if="location" @submit.prevent="save">
            <p><label><div>{{ translations.name }}</div><input type="text" required v-model="name" v-bind:placeholder="translations.name"></label></p>
            <p><label><div>{{ translations.email }}</div><input type="email" required v-model="email" v-bind:placeholder="translations.email"></label></p>
            <p><label><div>{{ translations.summarize }}</div><input type="text" required v-model="title" v-bind:placeholder="translations.summarize"></label></p>
            <p><label><div>{{ translations.category }}</div><select required v-model="category">
                <option value=""></option>
                <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ translations[category.code] }}</option>
            </select></label></p>
            <p><label><div>{{ translations.description }}</div><textarea required v-model="help" v-bind:placeholder="translations.description"></textarea></label></p>
            <p><input type="submit" v-bind:value="translations.save"></p>
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
                categories: [],
                translations: []
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

            fetch('locale.json').then(response => response.json()).then((response) => {
                scope.translations = response;
            });

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