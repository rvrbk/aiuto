<template>
    <div class="view here">
        <div v-if="loading" class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div v-if="flashes.activate_help || flashes.offer_send || flashes.use_location_service" class="flash">
            <span v-if="flashes.activate_help">{{ translations['activate-help'] }}</span>
            <span v-if="flashes.offer_send">{{ translations['offer-send'] }}</span>
            <span v-if="flashes.use_location_service">{{ translations['provide-location'] }}</span>
        </div>
        <router-link v-if="location" to="/help" class="help"><span class="material-icons">record_voice_over</span></router-link>
        <div id="here" v-bind:class="{ loading: loading }"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                map: null,
                coords: null,
                markers: [],
                location: false,
                loading: true,
                translations: [],
                flashes: {
                    activate_help: false,
                    offer_send: false,
                    use_location_service: true,
                },
                icons: {
                    dog: location.origin + '/icon/dog.png',
                    groceries: location.origin + '/icon/groceries.png',
                    medical: location.origin + '/icon/medical.png',
                    other: location.origin + '/icon/other.png',
                    social: location.origin + '/icon/social.png'
                }
            }
        },
        methods: {
            here() {
                const scope = this;
                
                let platform = new H.service.Platform({
                    'apikey': '3-qCiwF4kxvthUsZX-XFw0Sk0tP3_iWne_lFKSCGobc'
                });
    
                let defaultLayers = platform.createDefaultLayers();
            
                scope.map = new H.Map(document.getElementById('here'), defaultLayers.vector.normal.map, {
                    zoom: 3,
                    center: { 
                        lat: 45.69601, 
                        lng: 9.66721 
                    }
                });

                let mapEvents = new H.mapevents.MapEvents(scope.map);
                let behavior = new H.mapevents.Behavior(mapEvents);

                scope.ui = H.ui.UI.createDefault(scope.map, defaultLayers);

                scope.map.addEventListener('mapviewchangeend', (event) => {
                    scope.mark();
                });
            },
            cluster() {
                const scope = this;

                let dataPoints = scope.markers.map((item) => {
                    return new H.clustering.DataPoint(item.latitude, item.longitude);
                });

                let clusteredDataProvider = new H.clustering.Provider(dataPoints, {
                    clusteringOptions: {
                        eps: 32,
                        minWeight: 2
                    }
                });

                let clusteringLayer = new H.map.layer.ObjectLayer(clusteredDataProvider);

                scope.map.addLayer(clusteringLayer);
            },
            mark() {
                const scope = this;

                let center = scope.map.getCenter();
                let zoom = scope.map.getZoom();

                axios.get('/api/marks/' + center.lat + '/' + center.lng + '/' + zoom + '/').then((response) => {
                    response.data.forEach(item => {
                        if(scope.markers[item.id] == undefined) {
                            scope.addMarker(item);
                        }
                    });
                });

                //scope.cluster();
            },
            addMarker(item) {
                const scope = this;

                let group = new H.map.Group();

                scope.map.addObject(group);

                group.addEventListener('tap', (event) => {
                    let bubble =  new H.ui.InfoBubble(event.target.getGeometry(), {
                        content: event.target.getData()
                    });

                    scope.ui.addBubble(bubble);
                }, false);

                let icon = new H.map.Icon(scope.icons.other, {
                    size: {
                        w: 46,
                        h: 46
                    }
                });

                switch(item.category) {
                    case 'GROCERIES':
                    icon = new H.map.Icon(scope.icons.groceries, {
                        size: {
                            w: 46,
                            h: 46
                        }
                    });
                        
                    break;
                    case 'SOCIAL':
                    icon = new H.map.Icon(scope.icons.social, {
                        size: {
                            w: 46,
                            h: 46
                        }
                    });
                        
                    break;
                    case 'MEDICAL':
                    icon = new H.map.Icon(scope.icons.medical, {
                        size: {
                            w: 46,
                            h: 46
                        }
                    });
                        
                    break;
                    case 'DOG':
                    icon = new H.map.Icon(scope.icons.dog, {
                        size: {
                            w: 46,
                            h: 46
                        }
                    });
                        
                    break;
                    case 'OTHER':
                    default:
                    icon = new H.map.Icon(scope.icons.other, {
                        size: {
                            w: 46,
                            h: 46
                        }
                    });
                        
                    break;
                }

                let marker = new H.map.Marker({
                    lat: item.latitude,
                    lng: item.longitude
                }, {
                    icon: icon
                });
                
                marker.setData('<strong>' + item.title + '</strong><br>' + item.help + '<br><a href="#/offer/' + item.id + '">' + scope.translations['i-want-to-help'] + '</a>');

                scope.markers[item.id] = item;

                group.addObject(marker);
            }
        },
        mounted() {
            const scope = this;

            fetch('locale.json').then(response => response.json()).then((response) => {
                scope.translations = response;
            });

            switch(scope.$route.params.flash) {
                case 'activate-help':
                    scope.flashes.activate_help = true;

                    window.setTimeout(() => {
                        scope.flashes.activate_help = false;
                    }, 8000);

                break;
                case 'offer-send':
                    scope.flashes.offer_send = true;

                    window.setTimeout(() => {
                        scope.flashes.offer_send = false;
                    }, 8000);

                break;
            }

            navigator.geolocation.getCurrentPosition((location) => {
                scope.coords = location.coords;

                scope.location = true;
                scope.flashes.use_location_service = false;

                scope.map.setCenter({
                    lat: scope.coords.latitude, 
                    lng: scope.coords.longitude
                });

                scope.map.setZoom(10);

                window.setTimeout(() => {
                    scope.mark();

                    scope.loading = false;
                }, 1000);
            });

            scope.here();
        }
    }
</script>