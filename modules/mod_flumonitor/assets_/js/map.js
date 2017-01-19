var promos = [];
var areaTags = [];
var areaDatadb = {};
var objectMap = { //map object
    init: function(){ //call this property to instantiate your map object

        objectMap.mapOptions.zoom = 9;
        objectMap.mapOptions.center = new google.maps.LatLng(objectMap.centerLat, objectMap.centerLng);
        objectMap.map = new google.maps.Map(document.getElementById('map-canvas'), objectMap.mapOptions);

        objectMap.layMarker(objectMap.markerPos, objectMap.map);
        
        var input = document.getElementById('pac-input');
        objectMap.searchBox = new google.maps.places.SearchBox(input);
        objectMap.map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        objectMap.map.addListener('bounds_changed', function() {
            objectMap.searchBox.setBounds(objectMap.map.getBounds());
        });
        
        objectMap.map.addListener('zoom_changed', function() {
            console.log(objectMap.map.getZoom());
        });

        objectMap.searchBox.addListener('places_changed', function() {
            // console.log("asdasdasd");
            var places = objectMap.searchBox.getPlaces();
            if (places.length == 0) {
              return;
            }

            // // Clear out the old markers.
            // // markers.forEach(function(marker) {
            // //   marker.setMap(null);
            // // });
            // // markers = [];
            // console.log(places);
            // console.log(places.geometry);
            // // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };

              // Create a marker for each place.
              // markers.push(new google.maps.Marker({
              //   map: map,
              //   icon: icon,
              //   title: place.name,
              //   position: place.geometry.location
              // }));

              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                bounds.extend(place.geometry.location);
              }
            });
            objectMap.map.fitBounds(bounds);
        });

    },
    centerLat: 14.6090537,  //latitude property to set for initial center point for the map object
    centerLng: 121.0222565, //longitude property to set for initial center point for the map object
    markerPos: {},  //set of marker position. set this property dynamically using return object from your server side. you can loop through the set of values
    tweetMPos:{},
    tweetRPos:{},
    storeMPos:{},
    hosMPos:{},
    areaMPos:{},
    storePromo:{}, // promo marks to be displayed
    markers: [],
    storeMarks:[],
    promoMarks:[], // promo markers to be hidden
    hosMarks:[],
    infoContents: [],
    infoTweetsContents: [],
    areaMarkers:[],
    areaMarkersInfo:[],
    count: 1,
    mapOptions: { //map options. default zoom level is 4 and center is not yet set
        zoom: 4,
        center: null,
        panControl: false,
        zoomControl: false,
        streetViewControl: false,
        maxZoom:14
        // minZoom:11
    },

    map: null, //the map object
    searchBox:null, //searchbox
    layMarker: function(tagsArr, map){ //lay down markers on the map
        
        for(var key in tagsArr)
        {
            var user_name = tagsArr[key].user_name;
            // var latlng = tagsArr[key].geocode.location;
            var latitude = tagsArr[key].latitude;
            var longitude = tagsArr[key].longitude;
            var latlng = new google.maps.LatLng(latitude,longitude);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: user_name
            });

            objectMap.markers[key] = marker;
        }

    },
    twitterlayMarker: function(twitterData, map){ //lay down markers on the map
        
        // for(var key in arrMarkerPos2 ){
        //     if(arrMarkerPos2[key].media_type == 'twitter'){
        //         if(arrMarkerPos2[key].geometry){
        //             var myLatlng = new google.maps.LatLng(parseFloat(arrMarkerPos2[key].geometry.coordinates[0]),parseFloat(arrMarkerPos2[key].geometry.coordinates[1]));
        //             var myTitle = arrMarkerPos2[key].text;
        //             var numSymptoms = 0;
        //             var profilePic = arrMarkerPos2[key].profile_image;
        //             var userName = arrMarkerPos2[key].name;
        //             var iconMarker = arrMarkerPos2[key].icon_marker;

        //             var marker = new google.maps.Marker({
        //                 position: myLatlng,
        //                 map: map,
        //                 title: myTitle,
        //                 icon:iconMarker,
        //                 optimized: false
        //             });

        //             objectMap.markers[key] = marker;
        //             objectMap.count++;

        //             var contentData2 = '<div id="content" style="width: auto;"><div class="col-md-4"><img src="'+profilePic+'" class="" alt="'+profilePic+'" style="margin-top: 8px;"></div>';
        //                 contentData2 += '<div class="col-md-8"><div class="row"><h4 id="firstHeading" class="firstHeading" >'+myTitle+'</h4><p>'+userName+'</p></div><div class="row">';
        //                 contentData2 +='<div id="bodyContent"  style="width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></div></div></div>';
          
        //             objectMap.infoTweetsContents[key] = contentData2;
                        
        //             var infowindow = new google.maps.InfoWindow({
        //             });

        //             google.maps.event.addListener(marker, 'click', (function(marker, key) {
        //                 return function() {
        //                 objectMap.map.setZoom(17);
        //                 objectMap.map.setCenter(marker.getPosition());
        //                 infowindow.setContent(objectMap.infoTweetsContents[key]);
        //                 infowindow.open(marker.get('map'), marker);
        //               }
        //             })(marker, key));
        //        }
        //     }
        // }
        // console.log(twitterData);
    },
    clearMarkers: function(){
        var len = objectMap.markers.length;
        for (var i = 0; i < len; i++) {
            if(typeof objectMap.markers[i] !== 'undefined'){
                objectMap.markers[i].setMap(null);
            }
        }
        objectMap.markers = [];
    },
    storeMarkers: function (storeMarkerPos,map)
    {   
       
        for(var key in storeMarkerPos ){
            // console.log(storeMarkerPos[key]);
            if(storeMarkerPos[key].latitude != "" || storeMarkerPos[key].longitude !=""){

                // var myLatlng = storeMarkerPos[key].latlng.location;
                var myLatlng = new google.maps.LatLng(storeMarkerPos[key].latitude,storeMarkerPos[key].longitude);
                var myTitle = storeMarkerPos[key].store_name;
                var icon_marker = storeMarkerPos[key].marker;
                var pro_name = storeMarkerPos[key].pro_name;
                var pro_desc = storeMarkerPos[key].pro_desc;
                var pro_id = storeMarkerPos[key].pro_id;
          
                var icon2 = {
                    url: storeMarkerPos[key].marker, // url
                    scaledSize: new google.maps.Size(45, 45), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(22.5, 45) // anchor
                };

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: myTitle,
                    icon: icon2
                    // optimized: false

                });

                objectMap.storeMarks[key] = marker;
                // objectMap.count++;
                if(pro_id != null){
                    promos[key] = storeMarkerPos[key];
                }
                
            }
        }

        
    },
    hospitalMarkers: function(hosArrMar,map)
    {
        for(var key in hosArrMar ){
            if(hosArrMar[key].latlng){
                var myLatlng = hosArrMar[key].latlng.location;
                var myTitle = hosArrMar[key].name;
                var icon_marker = hosArrMar[key].marker;
                var address = hosArrMar[key].address;
                var icon2 = {
                        url: hosArrMar[key].marker, // url
                        scaledSize: new google.maps.Size(20, 20), // scaled size
                        origin: new google.maps.Point(0,0), // origin
                        anchor: new google.maps.Point(0, 0) // anchor
                    };

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: address,
                    icon: icon2,
                    optimized: false,
                    zIndex: 200 
                });

                //mouseover
                google.maps.event.addListener(marker, 'mouseover', (function(marker,address) {
                    return function(){
                        // console.log(address);
                        showStoreDetails(marker,address);

                    }
                })(marker,address));

                objectMap.hosMarks[key] = marker;
                objectMap.count++;
            }
        }
    },
    currentLocation: function(map)
    {   

        var initialLocation;
        var browserSupportFlag =  new Boolean();
        var map = map;
        var check_clicker = false;
        var len = objectMap.markers.length;
        var lat;
        var lng;
        var R = 6371; // radius of earth in km
        var distances = [];
        var closest = -1;
        var set_km = 5;
        var counter = 0;
        var new_markers = [];
        if(navigator.geolocation) {
            browserSupportFlag = true;
            navigator.geolocation.getCurrentPosition(function(position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                map.setCenter(initialLocation);
                objectMap.map.setZoom(13);
                
                lat = position.coords.latitude;
                lang = position.coords.longitude;
     //            var new_marker = new google.maps.Marker({
                    // position: myLatlng,
                    // map: map,
                    // title: myTitle
              //   });

                for (var i = 0; i < len; i++) {
                    if(typeof objectMap.markers[i] !== 'undefined'){
                    //     // objectMap.markers[i].setMap(null);
                        // var mlat = objectMap.markers[i].position.lat();
                        // var mlng = objectMap.markers[i].position.lng();
                        var near_infra = new google.maps.LatLng(objectMap.markers[i].position.lat(),objectMap.markers[i].position.lng());
                        
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(near_infra, initialLocation)/1000;
                        if(distance <= set_km)
                        {   
                            counter ++;
                            new_markers[i] = objectMap.markers[i];
                            //console.log(objectMap.markers[i].title+" "+(google.maps.geometry.spherical.computeDistanceBetween(near_infra, initialLocation))/1000+"km");    
                            // console.log(new_markers[i].title);
                        }


                        
                        
                        

                        //console.log(objectMap.markers[i].title+" "+near_infra);
                        
                        // var dLat  = rad(mlat - lat);
                        // var dLong = rad(mlng - lng);
                        // var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
                        // var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                        // var d = R * c;
                        // distances[i] = d;
                        // if ( closest == -1 || d < distances[closest] ) {
                        //     closest = i;
                        // }
                        

                    }
                    // console.log(distances[i]);
                }

                objectMap.clearMarkers();
                objectMap.markers = [];
                objectMap.count = 0;
                for(var key in new_markers ){
                    var new_lat_lang = new google.maps.LatLng(new_markers[key].position.lat(),new_markers[key].position.lng());
                    //console.log(new_lat_lang);
                    var new_marker = new google.maps.Marker({
                        position: new_lat_lang,
                        map: map,
                        title: new_markers[key].title,
                    });

                    objectMap.markers[key] = new_marker;
                    objectMap.count++;

                }
                    
     //            var new_marker = new google.maps.Marker({
                    // position: myLatlng,
                    // map: map,
                    // title: myTitle
              //   });


              //   objectMap.markers[key] = new_marker;

                // console.log("objectMap.markers: "+ objectMap.markers);
                // console.log("new_markers: "+new_markers);

                // objectMap.clearMarkers();
                // objectMap.markers = [];
              //   for (var i = 0; i < new_markers; i++) {
                    // console.log(new_markers[i].title);   
              //   }
                //console.log(objectMap.markers[i].title);
                // setAllMap(null);
                //console.log(new_markers);
                //console.log(counter);
                // for (var i = 1; i < len; i++) {
                //     if(typeof objectMap.markers[i] !== 'undefined'){
                //     //     // objectMap.markers[i].setMap(null);
                //         var mlat = objectMap.markers[i].position.lat();
                //         var mlng = objectMap.markers[i].position.lng();
                //         var dLat  = rad(mlat - lat);
                //         var dLong = rad(mlng - lng);
                //         var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
                //         var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                //         var d = R * c;
                //         distances[i] = d;
                //         if ( closest == -1 || d < distances[closest] ) {
                //             closest = i;
                //         }
                        

                //     }
                //     // console.log(distances[i]);
                // }

                //console.log(objectMap.markers[closest].title);
                // var marker = new google.maps.Marker({
                //     position: initialLocation,
                //     map: map,
                //     title: "Your location"
                // });
                // check_clicker = true;
                // if(!check_clicker)
                // {   
                //     objectMap.markers[len++] = marker;
                //     objectMap.count = len++;
                // }
                //alert(len);

            }, function() {
                handleNoGeolocation(browserSupportFlag);
            });


        }
        // Browser doesn't support Geolocation
        else {
            browserSupportFlag = false;
            handleNoGeolocation(browserSupportFlag);
        }
    },
    clearStoreMarkers:function(){
        var len = objectMap.storeMarks.length;
        // var promolength = objectMap.drugstoreInfowindos.length;
        for (var i = 0; i < len; i++) {
            if(typeof objectMap.storeMarks[i] !== 'undefined'){
                objectMap.storeMarks[i].setMap(null);       
            }
        }
        objectMap.storeMarks = [];
        // objectMap.drugstoreInfowindos = [];
    },
    clearHospitalMarkers:function()
    {
        var len = objectMap.hosMarks.length;
        for (var i = 0; i < len; i++) {
            if(typeof objectMap.hosMarks[i] !== 'undefined'){
                objectMap.hosMarks[i].setMap(null);
            }
        }
        objectMap.hosMarks = [];
    },
    closeInfowindows:function()
    {
        var len = objectMap.promoMarks.length;
        // var promolength = objectMap.drugstoreInfowindos.length;
        for (var i = 0; i < len; i++) {
            if(typeof objectMap.promoMarks[i] !== 'undefined'){
                objectMap.promoMarks[i].setMap(null);       
            }
        }
        objectMap.promoMarks = [];
    },
    showInfoWindows:function(map)
    {   
        //set values
        objectMap.drugstoreInfowindos = promos;
        // console.log(promos);
        var promo_img = './images/bioflu/drugstore/promotions2.png';
        for(var key in objectMap.drugstoreInfowindos){
            // console.log(objectMap.drugstoreInfowindos[key].latlng.location);
            // var myLatlng = objectMap.drugstoreInfowindos[key].latlng.location;
            var myLatlng = new google.maps.LatLng(objectMap.drugstoreInfowindos[key].latitude,objectMap.drugstoreInfowindos[key].longitude);
            var myTitle = objectMap.drugstoreInfowindos[key].store_name;
            var icon_marker = objectMap.drugstoreInfowindos[key].marker;
            var pro_name = objectMap.drugstoreInfowindos[key].pro_name;
            var pro_desc = objectMap.drugstoreInfowindos[key].pro_desc;
            var pro_id = objectMap.drugstoreInfowindos[key].pro_id;

            var promo_icon = {
                url: promo_img, // url
                scaledSize: new google.maps.Size(20, 20), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(-10, 50) // anchor
            };

            var promo_marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: pro_desc,
                icon: promo_icon,
                zIndex: 100000
                // optimized: false
            });

            google.maps.event.addListener(promo_marker, 'mouseover', (function(promo_marker,pro_desc) {
                return function(){
                   showProDetails(promo_marker,pro_desc);
                }
            })(promo_marker,pro_desc));


            objectMap.promoMarks[key] = promo_marker;

        }
    },
    areaMode:function(tData,map)
    {

        var bluemarker = './images/bioflu/pins/bluemarker.png';
        var redmarker = './images/bioflu/pins/redmarker.png';
        for(var key in tData ){
            var a = tData[key];
            var count =0;
            for(var b in a)
            {
                var size = getSize(a[b]);
                // console.log(a[b][0]);
                var myLatlng = a[b][0].territory_latlng.location;
                var myTitle = "There are "+size+" person/people who has multiple symptoms";
                var icon_marker = bluemarker;
                if(size >= 6)
                {
                    var icon_marker = redmarker;
                }
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: myTitle,
                    icon: icon_marker,
                    optimized: false
                });
                objectMap.areaMarkers[b] = marker;
            }
        }
        hideMarkers(objectMap.markers);
    },
    areaMarker:function(tData,map)
    {
        var many_symp_img = './images/bioflu/pins/areamarker_many_big.png';
        var few_symp_img ='./images/bioflu/pins/areamarker_few_small.png';

        for(var key in tData ){

            var a = tData[key];
            areaDatadb[key] = a;
            var count = 0;

            for(var b in a)
            {
                var size = getSize(a[b]);
                var myLatlng = a[b][0].territory_latlng.location;
                var latitude = a[b][0].territory_latlng.location.lat;
                var longitude = a[b][0].territory_latlng.location.lng;
                var myTitle = "There are "+size+" person/people who has multiple symptoms";
                var areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“Low number of flu cases reported in this area. However, the flu virus can spread fast especially during rainy season. So be sure you constantly monitor the spread of flu using this Flu Monitor System.  You can also follow us on Twitter @BiofluOfficial and on Facebook (BiofluOfficial) to get updates.” </div></div>';
                var icon2 = {
                    url: few_symp_img, // url
                    scaledSize: new google.maps.Size(30, 30), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(15, 30) // anchor
                };

                var mapLabel = new MapLabel({
                    text: size,
                    position:myLatlng ,
                    map: map,
                    fontColor:"#fff",
                    strokeColor:"transparent",
                    strokeWeight:1,
                    fontSize: 14,
                    align: 'center',
                    zIndex:2
                });

                //infomarkers test working
                if(size >= 6){
                    icon2.url = many_symp_img;
                    icon2.scaledSize = new google.maps.Size(60,60);
                    icon2.origin = new google.maps.Point(0,0);
                    icon2.anchor = new google.maps.Point(30,60);
                    mapLabel.marginTop = '-3.5em';
                    //change area text
                    areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“High number of flu cases reported in this area. Be sure to take necessary precautions to protect yourself. Wear a medical mask when exposed to crowded places. Also keep a sanitizer handy and be sure to carry All-in-One Bioflu so you can take it at the onset of flu.”</div></div>';
                }

                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: myTitle,
                    icon: icon2
                    // optimized: false
                });

                google.maps.event.addListener(marker, 'click', (function(marker,areaText) {
                    return function(){
                        showAreaMsg(marker,areaText);
                    }
                })(marker,areaText));
                objectMap.areaMarkers[b] = marker;
                mapLabel.set('position', new google.maps.LatLng(latitude, longitude));
            }
        }
    },
    areaTwitterMarker:function(tweetData,dbmarkers,map)
    {
        clearDbMarkers(); //clear previus markers
        var dbMark = objectMap.areaMarkers; // set areamarkers in variable
        var tMark = tweetData; // set tweetdata in a variable
        var setKm = 1; // set maximum distance for comparing twitter and db markers
    
        // for(var key in areaDatadb)
        // {
        //     var dataArr = areaDatadb[key];
        //     for(var k in dataArr)
        //     {
        //         var size = getSize(dataArr[k]); // size of database markers
        //         var dbPoints = new google.maps.LatLng(dataArr[k][0].territory_latlng.location.lat,dataArr[k][0].territory_latlng.location.lng);
        //         for(var tkey in tMark)
        //         {
        //             var tweeterPoints = new google.maps.LatLng(tMark[tkey].geometry.coordinates[0],tMark[tkey].geometry.coordinates[1]);
        //             var distance = google.maps.geometry.spherical.computeDistanceBetween(dbPoints,tweeterPoints)/1000;
        //             console.log("Distance = "+distance);
        //             if(distance <=1){
        //                 size++;
        //             }
        //             else{
        //                 var tsize = 1;
        //                 drawAreaMarkers(tsize,tweeterPoints,tkey);
        //             }
        //         }
        //         drawAreaMarkers(size,dbPoints,tkey);
        //     }
        // }   
    },
    testTwitterM:function(tD,map)
    {
        console.log(tD);
        for(var key in tD)
        {
            var user_name = tD[key].name;
            // var latlng = tD[key].geometry.coordinates[0];
            // console.log(latlng);
            var latlng = new google.maps.LatLng(tD[key].geometry.coordinates[0],tD[key].geometry.coordinates[1]);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: user_name
            });

            objectMap.markers.push(marker);
        }
        reDrawClusters(objectMap.markers,map);
    },
    testTwitterR:function(tD,map)
    {
        console.log(tD);
        for(var key in tD)
        {
            var user_name = tD[key].name;
            // var latlng = tD[key].geometry.coordinates[0];
            // console.log(latlng);
            var latlng = new google.maps.LatLng(tD[key].latitude ,tD[key].longitude);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: user_name
            });

            objectMap.markers.push(marker);
        }
        // reDrawClusters(objectMap.markers,map);
    },
    facilityMarkers: function(hosArrMar,map)
    {
        for(var key in hosArrMar)
        {
            var myLatlng = new google.maps.LatLng(hosArrMar[key].latitude ,hosArrMar[key].longitude);
            var myTitle = hosArrMar[key].facility_name;
            var icon_marker = hosArrMar[key].marker;
            // var address = hosArrMar[key].address;
            // console.log(hosArrMar[key]);
            // console.log(myLatlng);
            // console.log(myTitle);
            // console.log(icon_marker);
            // 
            
            var icon2 = {
                url: icon_marker, // url
                scaledSize: new google.maps.Size(20, 20), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: myTitle,
                icon: icon2,
                optimized: true,
                zIndex: 200 
            });

            objectMap.hosMarks[key] = marker;
            objectMap.count++;

        }
        // for(var key in hosArrMar ){
        //     if(hosArrMar[key].latlng){
        //         var myLatlng = hosArrMar[key].latlng.location;
        //         var myTitle = hosArrMar[key].name;
        //         var icon_marker = hosArrMar[key].marker;
        //         var address = hosArrMar[key].address;
        //         var icon2 = {
        //                 url: hosArrMar[key].marker, // url
        //                 scaledSize: new google.maps.Size(20, 20), // scaled size
        //                 origin: new google.maps.Point(0,0), // origin
        //                 anchor: new google.maps.Point(0, 0) // anchor
        //             };

        //         var marker = new google.maps.Marker({
        //             position: myLatlng,
        //             map: map,
        //             title: address,
        //             icon: icon2,
        //             optimized: false,
        //             zIndex: 200 
        //         });

        //         //mouseover
        //         google.maps.event.addListener(marker, 'mouseover', (function(marker,address) {
        //             return function(){
        //                 // console.log(address);
        //                 showStoreDetails(marker,address);

        //             }
        //         })(marker,address));

        //         objectMap.hosMarks[key] = marker;
        //         objectMap.count++;
        //     }
        // }
    },

}

function handleNoGeolocation(errorFlag)
{
    if (errorFlag == true) {
        alert("Geolocation service failed.");
        initialLocation = newyork;
    } else {
        alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
        initialLocation = siberia;
    }
    map.setCenter(initialLocation);
}

function rad(x)
{
    return x*Math.PI/180;
}

function getSize(obj)
{
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
}

function hideMarkers(obj)
{
    for(var key in obj)
    {
        obj[key].setVisible(false);
    }
}

function showMarkers(obj)
{
    for(var key in obj)
    {
         obj[key].setVisible(true);
    }
}

function hideAreaTags(obj)
{

   for(var key in obj)
    {
        obj[key].setVisible(false);
    }
}

function showAreaMsg(marker,areaText)
{
    var infoBubble2 = new InfoBubble({
        map: objectMap.map,
        content: areaText,
        position: marker.position,
        shadowStyle: 1,
        padding: 5,
        backgroundColor: '#265691',
        borderRadius: 4,
        arrowSize: 15,
        borderWidth: 1,
        borderColor: '#2c2c2c',
        disableAutoPan: true,
        hideCloseButton: false,
        arrowPosition: 50,
        backgroundClassName: 'info-container',
        arrowStyle: 2,
        maxWidth:200,
        maxHeight:175
    });
    infoBubble2.setBubbleOffset(0,-2);
    infoBubble2.open(objectMap.map,marker);


}
function showAreaMsg2(marker,areaText)
{
    var infoBubble2 = new InfoBubble({
        map: objectMap.map,
        content: areaText,
        position: marker.position,
        shadowStyle: 1,
        padding: 5,
        backgroundColor: '#265691',
        borderRadius: 4,
        arrowSize: 15,
        borderWidth: 1,
        borderColor: '#2c2c2c',
        disableAutoPan: true,
        hideCloseButton: false,
        arrowPosition: 50,
        backgroundClassName: 'info-container',
        arrowStyle: 2,
        maxWidth:200,
        maxHeight:175
    });
    infoBubble2.setBubbleOffset(0,-2);
    infoBubble2.open(objectMap.map,marker);


}
function showStoreDetails(marker,address)
{
    var address_text = '<div class="address-text" style="color:white;">'+address+'</div>';
    var infoBubble2 = new InfoBubble({
        map: objectMap.map,
        content: address_text,
        position: marker.position,
        shadowStyle: 1,
        padding: 5,
        backgroundColor: '#265691',
        borderRadius: 4,
        arrowSize: 15,
        borderWidth: 1,
        borderColor: '#2c2c2c',
        disableAutoPan: true,
        hideCloseButton: true,
        arrowPosition: 50,
        backgroundClassName: 'info-container',
        arrowStyle: 2,
        maxWidth:200,
        maxHeight:175
    });

    infoBubble2.setBubbleOffset(0,0);
    infoBubble2.open(objectMap.map,marker);

    marker.addListener('mouseout', function() {
        infoBubble2.close();
    });

}

function showProDetails(marker,pro_desc)
{
    var address_text = '<div class="address-text " style="color:white;">'+pro_desc+'</div>';
    var infoBubble2 = new InfoBubble({
        map: objectMap.map,
        content: address_text,
        position: marker.position,
        shadowStyle: 1,
        padding: 2,
        backgroundColor: '#265691',
        borderRadius: 4,
        arrowSize: 15,
        borderWidth: 1,
        borderColor: '#2c2c2c',
        disableAutoPan: true,
        hideCloseButton: true,
        arrowPosition: 50,
        backgroundClassName: 'info-container',
        arrowStyle: 2,
        maxWidth:200,
        maxHeight:175
    });

    infoBubble2.setBubbleOffset(20,0);
    infoBubble2.open(objectMap.map,marker);

    marker.addListener('mouseout', function() {
        infoBubble2.close();
    });
}

function drawAreaMarkers(size,dbPoints,tkey)
{
    var many_symp_img = './images/bioflu/pins/areamarker_many_big.png';
    var few_symp_img ='./images/bioflu/pins/areamarker_few_small.png';
    var myTitle = "There are "+size+" person/people who has multiple symptoms";
    var areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“Low number of flu cases reported in this area. However, the flu virus can spread fast especially during rainy season. So be sure you constantly monitor the spread of flu using this Flu Monitor System.  You can also follow us on Twitter @BiofluOfficial and on Facebook (BiofluOfficial) to get updates.” </div></div>';
    var icon2 = {
        url: few_symp_img, // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(15, 30) // anchor
    };

    var mapLabel = new MapLabel({
        text: size,
        position:dbPoints ,
        map: objectMap.map,
        fontColor:"#fff",
        strokeColor:"transparent",
        strokeWeight:1,
        fontSize: 14,
        align: 'center',
        zIndex:2
    });

    //infomarkers test working
    if(size >= 6){
        icon2.url = many_symp_img;
        icon2.scaledSize = new google.maps.Size(60,60);
        icon2.origin = new google.maps.Point(0,0);
        icon2.anchor = new google.maps.Point(30,60);
        mapLabel.marginTop = '-3.5em';
        //change area text
        areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“High number of flu cases reported in this area. Be sure to take necessary precautions to protect yourself. Wear a medical mask when exposed to crowded places. Also keep a sanitizer handy and be sure to carry All-in-One Bioflu so you can take it at the onset of flu.”</div></div>';
    }

    var marker = new google.maps.Marker({
        position: dbPoints,
        map: objectMap.map,
        title: myTitle,
        icon: icon2
        // optimized: false
    });

    google.maps.event.addListener(marker, 'click', (function(marker,areaText) {
        return function(){
            showAreaMsg(marker,areaText);
        }
    })(marker,areaText));

    objectMap.areaMarkers[tkey] = marker;
    mapLabel.set('position', dbPoints);
}

function clearDbMarkers()
{
    var len = objectMap.areaMarkers.length;
    // console.log(len);
    // for (var i = 0; i < len; i++) {
    //     if(typeof objectMap.areaMarkers[i] !== 'undefined'){
    //         objectMap.areaMarkers[i].setMap(null);       
    //     }
    // }
}

function reDrawClusters(markers,map)
{   
    var gSize = 10;
   
        // cluster styles
        var styles = [[
        {
        url: './images/bioflu/clusters/clu_few.png',
        height: 52,
        width: 53,
        anchor: [0, 0],
        textColor: '#FFF',
        textSize: 14
        }, {
        url: './images/bioflu/clusters/clu_many.png',
        width: 66,
        height: 65,
        anchor: [0, 0],
        textColor: '#FFF',
        textSize: 16
        }]];
    var markerCluster = new MarkerClusterer(map, markers,{
            maxZoom: 14,
            gridSize: gSize,
            styles: styles[0],
            minimumClusterSize:1
        });

        markerCluster.addListener('mouseover',function(c){
            var zoom = objectMap.map.getZoom();
            var areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“Low number of flu cases reported in this area. However, the flu virus can spread fast especially during rainy season. So be sure you constantly monitor the spread of flu using this Flu Monitor System.  You can also follow us on Twitter @BiofluOfficial and on Facebook (BiofluOfficial) to get updates.” </div></div>';
            var size = c.getSize();
            var center = c.getCenter();
            if(size >= 6)
            {
                areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“High number of flu cases reported in this area. Be sure to take necessary precautions to protect yourself. Wear a medical mask when exposed to crowded places. Also keep a sanitizer handy and be sure to carry All-in-One Bioflu so you can take it at the onset of flu.”</div></div>';
            }

            var infoBubble2 = new InfoBubble({
                map: map,
                content: areaText,
                position: center,
                shadowStyle: 1,
                padding: 5,
                backgroundColor: '#265691',
                borderRadius: 4,
                arrowSize: 15,
                borderWidth: 1,
                borderColor: '#2c2c2c',
                disableAutoPan: true,
                hideCloseButton: false,
                arrowPosition: 50,
                backgroundClassName: 'info-container',
                arrowStyle: 2,
                maxWidth:200,
                maxHeight:175
            });

            infoBubble2.setBubbleOffset(0,-2);
            if(zoom <= 12)
            {
                infoBubble2.open(map);
                markerCluster.addListener('mouseout', function() {
                    infoBubble2.close();
                });
            }
           
            // console.log(c.getCenter());
        });

        markerCluster.addListener('click',function(c){
            var zoom = objectMap.map.getZoom();
            var areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“Low number of flu cases reported in this area. However, the flu virus can spread fast especially during rainy season. So be sure you constantly monitor the spread of flu using this Flu Monitor System.  You can also follow us on Twitter @BiofluOfficial and on Facebook (BiofluOfficial) to get updates.” </div></div>';
            var size = c.getSize();
            var center = c.getCenter();
            if(size >= 6)
            {
                areaText = '<div class="info-container" style=" padding:5px; color:white;  zindex:999;font-weight:bold;"><div class="area-text">“High number of flu cases reported in this area. Be sure to take necessary precautions to protect yourself. Wear a medical mask when exposed to crowded places. Also keep a sanitizer handy and be sure to carry All-in-One Bioflu so you can take it at the onset of flu.”</div></div>';
            }

            var infoBubble2 = new InfoBubble({
                map: map,
                content: areaText,
                position: center,
                shadowStyle: 1,
                padding: 5,
                backgroundColor: '#265691',
                borderRadius: 4,
                arrowSize: 15,
                borderWidth: 1,
                borderColor: '#2c2c2c',
                disableAutoPan: true,
                hideCloseButton: false,
                arrowPosition: 50,
                backgroundClassName: 'info-container',
                arrowStyle: 2,
                maxWidth:200,
                maxHeight:175
            });

            infoBubble2.setBubbleOffset(0,-2);
            if(zoom <= 12)
            {
                infoBubble2.open(map);
                markerCluster.addListener('mouseout', function() {
                    infoBubble2.close();
                });
            }
           
            // console.log(c.getCenter());
        });
}