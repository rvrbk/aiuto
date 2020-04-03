<template>
    <div class="view here">
        <div v-if="flashes.activate_help || flashes.offer_send" class="flash">
            <span v-if="flashes.activate_help">Your call has been submitted. Check your inbox to activate.</span>
            <span v-if="flashes.offer_send">Thanks for offering your help! Check your inbox.</span>
        </div>
        <router-link to="/help" class="help"><span class="material-icons">record_voice_over</span></router-link>
        <div id="here"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                map: null,
                coords: null,
                markers: [],
                flashes: {
                    activate_help: false,
                    offer_send: false
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
                    zoom: 10,
                    center: { 
                        lat: 52.5, 
                        lng: 13.4 
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

                let marker = new H.map.Marker({
                    lat: item.latitude,
                    lng: item.longitude
                });
                
                marker.setData('<strong>' + item.title + '</strong><br>' + item.help + '<br><a href="#/offer/' + item.id + '">I want to help</a>');

                scope.markers[item.id] = item;

                group.addObject(marker);
            }
        },
        mounted() {
            const scope = this;
            
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

                scope.map.setCenter({
                    lat: scope.coords.latitude, 
                    lng: scope.coords.longitude
                });

                scope.map.setZoom(10);

                window.setTimeout(() => {
                    scope.mark();
                }, 1000);
            });

            scope.here();
        }
    }
</script>