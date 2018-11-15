/*
Ext.define('Ext.ux.GMapPanel', {
    extend: 'Ext.panel.Panel',
    
    alias: 'widget.gmappanel',
    
    requires: ['Ext.window.MessageBox'],
    
    initComponent : function(){
        Ext.applyIf(this,{
            plain: true,
            gmapType: 'map',
            border: false
        });
        
        this.callParent();        
    },
    
    afterFirstLayout : function(){
        var center = this.center;
        this.callParent();       
        
        if (center) {
            if (center.geoCodeAddr) {
                this.lookupCode(center.geoCodeAddr, center.marker);
            } else {
                this.createMap(center);
            }
        } else {
            Ext.Error.raise('center is required');
        }
              
    },
    
    createMap: function(center, marker) {
        var options = Ext.apply({}, this.mapOptions);

        options = Ext.applyIf(options, {
            zoom: this.zoom||14,
            center: center,
            mapTypeId: this.gmapType||google.maps.MapTypeId.HYBRID
        });
      
        this.gmap = new google.maps.Map(this.body.dom, options);
        if (marker) {
            this.addMarker(Ext.applyIf(marker, {
                position: center
            }));
        }
        
        Ext.each(this.markers, this.addMarker, this);
        this.fireEvent('mapready', this, this.gmap);
    },
    
    addMarker: function(marker) {
        marker = Ext.apply({
            map: this.gmap
        }, marker);
        
        if (!marker.position) {
            marker.position = new google.maps.LatLng(marker.lat, marker.lng);
        }
        var o =  new google.maps.Marker(marker);
        Ext.Object.each(marker.listeners, function(name, fn){
            google.maps.event.addListener(o, name, fn);    
        });
        return o;
    },
    
    lookupCode : function(addr, marker) {
        this.geocoder = new google.maps.Geocoder();
        this.geocoder.geocode({
            address: addr
        }, Ext.Function.bind(this.onLookupComplete, this, [marker], true));
    },
    
    onLookupComplete: function(data, response, marker){
    	 	if (response != 'OK') {
            Ext.MessageBox.alert('Error', 'Direccion desconocida: "' + response + '"');
            return;
        }
    	this.data = data; 	
    	this.lat = data[0].geometry.location.lat();
    	this.lng = data[0].geometry.location.lng();
        this.createMap(data[0].geometry.location, marker);
    },
    
    afterComponentLayout : function(w, h){
        this.callParent(arguments);
        this.redraw();
    },
    
    redraw: function(){
        var map = this.gmap;
        if (map) {
            google.maps.event.trigger(map, 'resize');
        }
    }
 
}); */

Ext.define(
				'Ext.ux.GMapPanel',
				{
					extend : 'Ext.panel.Panel',

					alias : 'widget.gmappanel',

					requires : [ 'Ext.window.MessageBox' ],

					initComponent : function() {
						Ext.applyIf(this, {
							plain : true,
							gmapType : 'map',
							border : false
						});
						markers = [];
						this.callParent();
						geocoder = new google.maps.Geocoder();
						var contentString = '<div id="content">'
								+ '<div id="siteNotice">'
								+ '</div>'
								+ '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'
								+ '<div id="bodyContent">'
								+ '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large '
								+ 'sandstone rock formation in the southern part of the '
								+ 'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '
								+ 'south west of the nearest large town, Alice Springs; 450&#160;km '
								+ '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '
								+ 'features of the Uluru - Kata Tjuta National Park. Uluru is '
								+ 'sacred to the Pitjantjatjara and Yankunytjatjara, the '
								+ 'Aboriginal people of the area. It has many springs, waterholes, '
								+ 'rock caves and ancient paintings. Uluru is listed as a World '
								+ 'Heritage Site.</p>'
								+ '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'
								+ 'https://en.wikipedia.org/w/index.php?title=Uluru</a> '
								+ '(last visited June 22, 2009).</p>'
								+ '</div>' + '</div>';

						infowindow = new google.maps.InfoWindow({
							content : contentString
						});
					},

					afterFirstLayout : function() {
						var center = this.center;
						this.callParent();

						if (center) {
							if (center.geoCodeAddr) {
								this.lookupCode(center.geoCodeAddr,
										center.marker);
							} else {
								this.createMap(center);
							}
						} else {
							Ext.Error.raise('center is required');
						}

					},

					createMap : function(center, marker) {
						var options = Ext.apply({}, this.mapOptions);

						options = Ext.applyIf(options, {
							zoom : this.zoom || 14,
							center : center,
							mapTypeId : this.gmapType
									|| google.maps.MapTypeId.HYBRID
						});

						this.gmap = new google.maps.Map(this.body.dom, options);

						var mapa = this.gmap;

						if (marker) {
							this.addMarker(Ext.applyIf(marker, {
								position : center
							}));
						}

						var este = this;

						this.fireEvent('mapready', this, this.gmap);
					},

					geocodePosition : function(marker) {
						var mapa = this.gmap;
						var pos = marker.getPosition();
						geocoder.geocode(
										{
											latLng : pos
										},
										function(responses) {
											if (responses && responses.length > 0) {
												marker.formatted_address 	= responses[0].formatted_address;
												mapa.jsonDir 				= responses[0].address_components; 
												mapa.jsonDir.push({types:'latlng',  lat: responses[0].geometry.location.lat(),lng:responses[0].geometry.location.lng()});
												console.log(responses);
											} else {
												marker.formatted_address = 'Cannot determine address at this location.';
											}

											console.log(marker.address_components);

											infowindow.setContent(marker.formatted_address+ "<br>coordinates: "+ marker.getPosition().toUrlValue(6));
											infowindow.open(mapa, marker);
										});
					},

					addMarker : function(marker) {
						var mapa = this.gmap;
						marker = Ext.apply({
							map : mapa
						}, marker);

						if (!marker.position) {
							marker.position = new google.maps.LatLng(
									marker.lat, marker.lng);
						}
						marker.draggable = true;

						if (marker.icon) {
							marker.icon = 'img/icoMaps/' + marker.icon;
						}

						var o = new google.maps.Marker(marker);

						if (marker.animation === 'BOUNCE') {
							o.setAnimation(google.maps.Animation.BOUNCE);
						} else if (marker.animation === 'DROP') {
							o.setAnimation(google.maps.Animation.DROP)
						}

						function toggleBounce() {
							if (o.getAnimation() !== null) {
								o.setAnimation(null);
							} else {
								o.setAnimation(google.maps.Animation.BOUNCE);
							}
						}

						o.addListener('click', toggleBounce);
						Ext.Object.each(marker.listeners, function(name, fn) {
							google.maps.event.addListener(o, name, fn);
						});
						o.tipo = marker.tip;
						markers.push(o);

						var esto = this;
						o.addListener('dragend', function() {
							esto.geocodePosition(o);
						});

						o.addListener('click', function() {
							if (o.formatted_address) {
								infowindow.setContent(o.formatted_address + "<br>coordinates: "+ o.getPosition().toUrlValue(6));
							} else {
								infowindow.setContent(address+ "<br>coordinates: "+ o.getPosition().toUrlValue(6));
							}
							infowindow.open(mapa, o);
						});
						esto.geocodePosition(o);
						return o;
					},

					getMarkers : function() {
						return markers;
					},

					setMapOnAll : function(map) {
						for (var i = 0; i < markers.length; i++) {
							markers[i].setMap(map);
						}
					},

					setMapTip : function(map, tip) {
						for (var i = 0; i < markers.length; i++) {
							if (markers[i].tip === tip) {
								markers[i].setMap(map);
							}
						}
					},

					lookupCode : function(addr, marker) {
						geocoder.geocode({
							address : addr
						}, Ext.Function.bind(this.onLookupComplete, this,
								[ marker ], true));
					},

					onLookupComplete : function(data, response, marker) {
						if (response != 'OK') {
							Ext.MessageBox.alert('Error', 'Direccion desconocida: "'+ response + '"');
							return;
						}
						this.data = data;
						this.lat = data[0].geometry.location.lat();
						this.lng = data[0].geometry.location.lng();
						this.createMap(data[0].geometry.location, marker);
					},

					afterComponentLayout : function(w, h) {
						this.callParent(arguments);
						this.redraw();
					},

					redraw : function() {
						var map = this.gmap;
						if (map) {
							google.maps.event.trigger(map, 'resize');
						}
					}

				});

