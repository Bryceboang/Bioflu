<?php  
    include 'modules/mod_flumonitor/tweets.php'; 
?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/css/ie_nationalflu.css" />
<![endif]-->
<style>
    #switch-hospital, #switch-drugstore,#switch-promo,#reset_btn
    {
         cursor: pointer;
    }

    .blue-text{
        color: #4bd2f5;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/css/nationalflu.css">
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/css/responsive.css">

<!-- load map resources -->
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyANldOrkcTeu_Oz0E_RTB4erZoKB-frZxE&v=3.0&sensor=false&libraries=places,geometry'></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/map.js"></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/infobox.js"></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/infobubble.js"></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/maplabel.js"></script>
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/toggles/style.css">

<div class="margin-top-10 pad-45">
    <input type="hidden" class="longitude" value=""/>
    <input type="hidden" class="latitude" value=""/>
    <div class="col-md-12">
        <!-- Landing page -->
        
        <div class="nfm-landing" >
            <div class="col-md-5 pad-0">
                <label class="blue-text header-title-large">THE NATIONAL FLU MONITOR</label>
                <p class="margin-0 black-text-futura p_upper p3">THE FLU MONITOR SYSTEM IS THE FIRST ONLINE FLU TRACKER IN THE PHILIPPINES, IT ALLOWS YOU TO TRACK FLU OUTBREAKS AND REPORT CASES. FLU REPORTS ARE UPDATED WITHIN 24 HOURS.</p>
                <p class="margin-0 p3">GET USEFUL TIPS AND FIND OUT HOW YOU CAN PARTICIPATE <a class="blue-text pointer bottom-scroll"> HERE. </a></p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6 flu-count">
                <div class="col-md-4 col-sm-4 col-xs-4 pad-0">
                    <div class="nfr_cnt header-title red-text-futura nfr_cnt"></div>
                    <div class="p3 p_upper">National Flu Reports</div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 pad-0">
                    <div class="fr_cnt header-title red-text-futura fr_cnt"></div>
                    <div class="p3 p_upper">Flu Reports</div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 pad-0">
                    <div class="l_cnt header-title red-text-futura flu-location p_upper">Philippines</div>
                    <div class="p3 p_upper ">Location</div>
                </div>
            </div>
        </div>

        <!-- Flu map -->
        <div class="nfm-flumap" style="display:none;">
            <div class="col-md-3 pad-0">
                <label class="red-text header-title-large">FLU MAP</label>
                <label class="blue-text header-title-vlarge">Philippines</label>
            </div>
            <div class="col-md-5 flu-count">
                <div class="col-md-4 col-sm-4 col-xs-4 pad-0">
                    <div class="fr_cnt header-title red-text-futura"></div>
                    <div class="p3 p_upper">flu reports in this area</div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 pad-0">
                    <div class=" nfr_cnt header-title red-text-futura"></div>
                    <div class="p3 p_upper">national flu reports</div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5 pad-0">
                    <div class="l_cnt header-title red-text-futura nfm_drugStores"></div>
                    <div class="p3 p_upper ">Bioflu stores near you</div>
                </div>
            </div>
            <div class="col-md-4 flubuzz">
                <div id="twitter_update_list">
                    <span class="tweet-loader">Loading tweets...</span>
                </div>
            </div>

        </div>


        <!-- Drugstores -->
        <div class="nfm-drugstores" style="display:none;">
            <div class="col-md-5 pad-0">
                <div class="blue-text header-title-large p_upper col-md-12">Find drugstores</div>
                <div class="blue-text header-title-vlarge p_upper col-md-12">near you</div>
                <div class="red-text header-title p_upper flu-location col-md-12">Philippines</div>
            </div>
        </div>

        <!-- Hospital -->
        <div class="nfm-hospital" style="display:none;">
            <div class="col-md-5 pad-0">
                <div class="blue-text header-title-large p_upper col-md-12">Hospitals / Clinic</div>
                <div class="blue-text header-title-vlarge p_upper col-md-12">near you</div>
                <div class="red-text header-title p_upper flu-location col-md-12">Philippines</div>
            </div>
        </div>

    </div>

</div>


<div class="col-md-12 parent-container pad-0" style="height:500px;padding-bottom: 3% !important;">   
    <div class="hospital-container col-md-12 col-xs-12 col-sm-12 panel map-details pad-0" style="height:100%;display:none;">
          <div class="col-md-12 list-container-hos pad-0" style = "margin-bottom:60px;"></div>
            <div class="loadmore txt-center">
              <div class="loader-more-hos"><p style ="padding:20px; text-align:center" class="loading-resp"><img src="modules/mod_flumonitor/assets/img/loader.gif"> Loading...</p></div>
            <a class = "next-page-hos" ></a>
          </div>
          <div class="col-md-12 pagination-hos" style = "display:none" ></div>
    </div>

    <div class="drugstore-container col-md-12 col-xs-12 col-sm-12 panel map-details pad-0" style="height:100%;display:none;">
          <div class="col-md-12 list-container pad-0" style = "margin-bottom:60px;"></div>
            <div class="loadmore txt-center">
              <div class="loader-more"><p style ="padding:20px; text-align:center" class="loading-resp"><img src="modules/mod_flumonitor/assets/img/loader.gif"> Loading...</p></div>
            <a class = "next-page" ></a>
          </div>
          <div class="col-md-12 pagination" style = "display:none" ></div>
    </div>


    <div class="child-containers col-md-12 col-xs-12 col-sm-12 panel map-container pad-0" style="height:100%;">
        <input id="pac-input" class="search-controls" type="text" placeholder="Enter a location">
        <div id="map-canvas" style="height: 100%; width:100%;">
        </div>
    </div>
</div>


<div class="col-md-12 fmn-about pad-45">

    <div class="col-md-12 fm-body pad-0">
        <div class="col-md-12"><label class="blue-text header-title nfm-title"></label></div>
        <div class="col-md-12 nfm-content"></div>
    </div>

</div>


<div class="pad-0 flu-monitor-btn container">
    <div class="col-md-6 flu-btn-inside">
        <div class="col-md-3 col-xs-3 col-sm-3 pad-0">
            <button data-name="flu" class="flu flu-btn p_upper ">FLU MAP</button>
        </div>
        <div class="col-md-4 col-xs-4 col-sm-4 pad-0">
            <button data-name="drugstores" class="drugstores flu-btn p_upper ">DRUGSTORES</button>
        </div>
        <div class="col-md-5 col-xs-5 col-sm-5 pad-0">
            <button data-name="hospitals" class="hospitals flu-btn p_upper ">Hospitals / Clinics</button>
        </div>
    </div>
    <div class="col-md-2"></div>
<!--     <div class="col-md-4" style="text-align:center;padding-top:1%;">
        <div class="col-md-12 twitter-login"><img src="templates/bioflu/twitter/images/sign-in-with-twitter.png" /></div>
        <div class="col-md-12 p_upper p4">The national flu monitor users data from users to map out flu cases use twitter connect to get started</div>
    </div> -->

</div>
<script type="text/javascript">
$(document).on('click', '.bottom-scroll',function(){
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
});

$(window).load(function(){
    // var child_height = $('.map-details').outerHeight();
    // console.log(child_height);
    // $('#map-canvas').height(child_height);
})
$(document).ready(function() {

   
    //initialize Map

    objectMap.init();
    var show_drugstores = 0;
    var dbSymptoms = {};
    var dbMarkers = {};
    var tweetMarkers = {};
    var storeShown = false;
    var showTimes = 0; 
    var showHospital = false;
    var showHospitalTimes = 0;
    var showDrugstoreChecker = false;
    var showDrugstore = 0;
    var showPromotion = false;
    var showPromotionTimes = 0;
    var showArea = false;
    var showAreaTimes = 0;
    var flu_name;
    var base_url = jQuery('body').attr('data-baseurl')+'/';

    var d = new Date();
    var n = d.getTime();
    //loadTags();
get_data();
fcounter();
function get_data(){

    var table = "maps_about";
    var order_by = "id";
    
    $.ajax({
        type: 'Post',
        url:  base_url+'templates/bioflu/controller.php?query=get_data',
        data:{table:table, order_by:order_by},
      }).done( function(data){
              var obj = JSON.parse(data);
              var htm ='', htm1 = '';
              
          $.each(obj, function(index, row){ 

            htm     +=  row.title;
            htm1    +=  row.content;
            });
              $('.nfm-content').html('');
              $('.nfm-content').html(htm1);
              $('.nfm-title').html('');
              $('.nfm-title').html(htm);
     }); 
}


$(document).on('keypress', '#pac-input', function(e) {

        /*Drugstores*/
                showDrugstoreChecker = false;
                showDrugstore = 0;
                objectMap.clearStoreMarkers();
        /* End of drugstores */
       /* Hospital */
            showHospital = false;
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        /* End of hospital */

    if(e.which == 13) {
        objectMap.deleteAllMarkers(); 

        $( ".flu-btn" ).each(function() {
                    if($( this ).hasClass("flu-btn-active")){
                        var name = $(this).attr('data-name');       
                        codeAddress(name);        
                    }               
        });
        
        
        /*Drugstores*/
    }
    
    var location = $(this).val();
    location = location.substr(0,15);
    $('.flu-location').html("");
    $('.flu-location').html(location+"...");

});

 function initialize() {
        var address = (document.getElementById('pac-input'));
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
      });
}
function codeAddress(name) {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("pac-input").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        $('.longitude').val(results[0].geometry.location.lng());
        $('.latitude').val(results[0].geometry.location.lat());
        alert($('.longitude').val());
        alert($('.latitude').val());

        var limit = '10';
        var offset = '1';
        countTags();
        if(name == "drugstores"){
            loadStores();
            $('.list-container').html('');
            $('.pagination').html('');
            get_list(limit,offset);
            get_pagination('1',limit);
        } else if (name == "hospitals") {
            // loadHospitals();
            fcounter();
            $(document).ajaxStop(function() {
                console.log('done loading');
                objectMap.facilityMarkers(objectMap.hosMPos, objectMap.map);
            });
  
            $('.list-container-hos').html('');
            $('.pagination-hos').html('');
            get_list_hos(limit,offset);
            get_pagination_hos('1',limit);
        } else if (name == "flu"){
            loadTags();
        } else {
            //do nothing
        }
      } 

      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

function countTags()
{

    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();


    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=nfm_count',
        data:  {longitude:longitude,latitude:latitude},
        //cache: false
    }).done(function(data){        
        var callback = JSON.parse(data);
        $('.fr_cnt').html('');
        $('.fr_cnt').html(callback.flu_reports);
        $('.nfr_cnt').html('');
        $('.nfr_cnt').html(callback.nfr_reports);
        $('.nfm_drugStores').html('');
        $('.nfm_drugStores').html(callback.drugStores);
        //alert(callback.nfr_reports);
        //alert(callback.flu_reports);
    });
}
countTags();


$('.flumonitor_count').hide();
$('.nfm-header').show();

$(document).on('click', '.flu-btn', function(){  
    objectMap.deleteAllMarkers(); 
    $(this).addClass('flu-btn-active');
    var flu_name = $(this).attr('data-name');
    if(flu_name == 'drugstores'){
       //get_drugstore_list();
       //$('.flumonitor_count').show();
        $('.list-container').html('');
        $('.pagination').html('');
        var limit = '10';
        var offset = '1';
          get_list(limit,offset);
          get_pagination('1',limit);
       $('.fmn-about').hide();
       $('.hospitals, .flu').removeClass('flu-btn-active');
       $('.map-container').removeClass('col-md-12');
       $('.map-container').removeClass('col-sm-12');
       $('.map-container').removeClass('col-xs-12');
       $('.map-container').addClass('col-md-8');
       $('.map-container').addClass('col-sm-8');
       $('.map-container').addClass('col-xs-8');
       $('.child-containers').css('display','table-cell !important');
       
       /* Hospital */
            showHospital = false;
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        /* End of hospital */
        /*Flu map*/
            objectMap.markers = [];
            objectMap.clearMarkers();
        /* End of flu map */
        /*Drugstores*/
                showDrugstoreChecker = false;
                showDrugstore = 0;
                objectMap.clearStoreMarkers();
        /* End of drugstores */

       showDrugstoreChecker = true;
       flu_name = 'drugstores';


            showDrugstore++;
            loadStores();
           // objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);
           // addCount(flu_name);
        $('.hospital-container').hide();
        $('.drugstore-container').show();

        $('.nfm-hospital').hide();
        $('.nfm-landing').hide();
        $('.nfm-flumap').hide();
        $('.nfm-drugstores').show();

    } else if (flu_name == 'hospitals') {
        //get_hospital_list();
        //$('.flumonitor_count').show();
        $('.list-container-hos').html('');
        $('.pagination-hos').html('');
        var limit = '10';
        var offset = '1';
          get_list_hos(limit,offset);
          get_pagination_hos('1',limit);
        $('.fmn-about').hide();
        $('.drugstores, .flu').removeClass('flu-btn-active');
        $('.map-container').removeClass('col-md-12');
        $('.map-container').removeClass('col-sm-12');
        $('.map-container').removeClass('col-xs-12');
        $('.map-container').addClass('col-md-8');
        $('.map-container').addClass('col-sm-8');
        $('.map-container').addClass('col-xs-8');
        $('.child-containers').css('display','table-cell !important');
        showHospital = true;
        flu_name = 'hospitals';

       /* Hospital */
            showHospital = false;
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        /* End of hospital */
        /*Flu map*/
            objectMap.markers = [];
            objectMap.clearMarkers();
        /* End of flu map */
        /*Drugstores*/
                showDrugstoreChecker = false;
                showDrugstore = 0;
                objectMap.clearStoreMarkers();
        /* End of drugstores */


            showHospitalTimes++;
            fcounter();
            // loadHospitals();
            // objectMap.hospitalMarkers(objectMap.hosMPos, objectMap.map);

            objectMap.facilityMarkers(objectMap.hosMPos, objectMap.map);
            addCount(flu_name);

            $('.hospital-container').show();
            $('.drugstore-container').hide();

            $('.nfm-hospital').show();
            $('.nfm-landing').hide();
            $('.nfm-flumap').hide();
            $('.nfm-drugstores').hide();
            

    } else {
        //$('.flumonitor_count').hide();
        $('.child-containers').css('display','table-row !important');
        // $('.hospital-container').html('');
        $('.map-container').removeClass('col-md-8');
        $('.map-container').removeClass('col-sm-8');
        $('.map-container').removeClass('col-xs-8');
        $('.map-container').addClass('col-md-12');
        $('.map-container').addClass('col-sm-12');
        $('.map-container').addClass('col-xs-12');
        /*Drugstores*/
                showDrugstoreChecker = false;
                showDrugstore = 0;
                objectMap.clearStoreMarkers();
        /* End of drugstores */
       /* Hospital */
            showHospital = false;
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        /* End of hospital */
        /*Flu map*/
            objectMap.markers = [];
            objectMap.clearMarkers();
        /* End of flu map */
        $('.drugstores, .hospitals').removeClass('flu-btn-active');
        $('.fmn-about').show();
        loadTags();
        
        $('.hospital-container').hide();
        $('.drugstore-container').hide();

        $('.nfm-landing').hide();
        $('.nfm-flumap').show();
        $('.nfm-hospital').hide();
        $('.nfm-landing').hide();
        $('.nfm-drugstores').hide();

    }



    $(document).ajaxStop(function() {
        console.log('done loading');
    });

});  








    //triggerClick
    // new buttons v2
    $('#switch-hospital').css('cursor','pointer');
    $('.mapmania-container').on('click','#switch-hospital',function(){
        showHospital = true;
        flu_name = 'hospitals';
        if(showHospital == true && showHospitalTimes == 0){

            showHospitalTimes++;
            fcounter();
            // loadHospitals();
            // objectMap.hospitalMarkers(objectMap.hosMPos, objectMap.map);
            objectMap.facilityMarkers(objectMap.hosMPos, objectMap.map);
            addCount(flu_name);
        }
        else{
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        }
    });

    $('#switch-promo').css('cursor','pointer');
    $('.mapmania-container').on('click','#switch-promo',function(){
        showPromotion = true;
        flu_name = 'promotions';
        if(showPromotion == true && showPromotionTimes == 0){
            showPromotionTimes++;
            showPromotion = true;
            objectMap.showInfoWindows(objectMap.map);
            addCount(flu_name);

        }
        else{
            showPromotionTimes = 0;
            showPromotion = false;
            objectMap.closeInfowindows();
        }
    });

    $('#switch-drugstore').css('cursor','pointer');
    $('.mapmania-container').on('click','#switch-drugstore',function(){
       showDrugstoreChecker = true;
       flu_name = 'drugstores';
        if(showDrugstoreChecker == true && showDrugstore == 0)
        {
            showDrugstore++;
            loadStores();
            objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);
            addCount(flu_name);
        }
        else
        {
            showDrugstore = 0;
            objectMap.clearStoreMarkers();
            if(showPromotion)
            {
                $('#switch-promo').trigger('click');
            }
        }
    });

    $('#reset_btn').css('cursor','pointer');
    $('.mapmania-container').on('click','#reset_btn',function(){

        showPromotion = false;
        showPromotionTimes = 0;
        objectMap.closeInfowindows();
        $('#switch-promo').attr('checked', false);
        
        showHospital = false;
        showHospitalTimes = 0;
        objectMap.clearHospitalMarkers();
        $('#switch-hospital').attr('checked', false);
        
        if(showDrugstore!= true){
            showDrugstoreChecker = false;
            showDrugstore = 0;
            objectMap.clearStoreMarkers();
            $('#switch-drugstore').attr('checked', false);
            loadStores();
        }
    });
   
    $(document).ajaxStop(function() {
        console.log('done loading');
    });

});


function loadTwitterMakers()
{   
    <?php foreach ($tweet_data as $key => $value):?>wala
        objectMap.tweetMPos[<?=$key;?>] = <?=$value;?>;
        // tweetMarkers[<?=$key;?>] =  <?=$value;?>;
    <?php endforeach;?>
    console.log(objectMap.tweetMPos);
    objectMap.testTwitterM(objectMap.tweetMPos,objectMap.map);
}

function loadReportMakers()
{   
    <?php foreach ($tweet_reports as $key => $value):?>
        objectMap.tweetRPos[<?=$key;?>] = <?=$value;?>;
        // tweetMarkers[<?=$key;?>] =  <?=$value;?>;
    <?php endforeach;?>
    console.log(objectMap.tweetRPos);
    objectMap.testTwitterR(objectMap.tweetRPos,objectMap.map);
    loadTwitterMakers();
}

function reloadMaps()
{
    objectMap.init();
    loadTags();
    loadStores();
    loadHospitals();
}



function loadStores()
{
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();
    
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=loadDrugstores',
        data:  {latitude:latitude,longitude:longitude},
        //cache: false
    }).done(function(data){
       
        var stores = JSON.parse(data);
        $.each(stores,function(x,y){
            $.each(y,function(a,b){
                objectMap.storeMPos[a] = b;
            });
        });

        objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);
        console.log(objectMap.storeMPos);
        addCount('drugstores');
        // $('#switch-drugstore').trigger('click');       
    });
}

function loadMarkersV2(dbMarkers)
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=getTagTerritory',
        data:  ''
    }).done(function(data){
        var tData = JSON.parse(data);
        // $.each(tData, function(x,y){
        //     $.each(y,function(a,b){
        //         areaTags[a] = b;
        //     });
        // });
        // objectMap.areaMarker(tData,objectMap.map);
        // objectMap.layMarker(tData,ObjectMap.map);
        loadTwitterMakers(tData);
    });
}

function loadTags()
{

    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();
    var tagsArr = {};
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=tags',
        data:  {latitude:latitude,longitude:longitude},
        cache: false
    }).done(function(data){
       // alert(data);
        
        var tData = JSON.parse(data);
        // console.log(tData);
        $.each(tData, function(x,y){
            $.each(y,function(a,b){
                tagsArr[a] = b;

            });
        });

        objectMap.layMarker(tagsArr,objectMap.map);
        objectMap.layMarker();
        loadReportMakers();
        console.log(tagsArr);
    });
}

//loadTagsTest();

function loadTagsTest()
{



            var longitude = $('.longitude').val();
            var latitude = $('.latitude').val();
    


    var tagsArr = {};
    $.ajax({
        type: 'Post',
        url: 'modules/mod_flumonitor/controller.php?function=tagstest',
        data:  {latitude:latitude,longitude:longitude},
        //cache: false
    }).done(function(data){
       
        
        var tData = JSON.parse(data);
        // console.log(tData);
        $.each(tData, function(x,y)
        {
            $.each(y,function(a,b){

                tagsArr[a] = b;

            });
        });
        objectMap.layMarker(tagsArr,objectMap.map);
        objectMap.layMarker();
        loadReportMakers();
        console.log(tagsArr);
    });
}


function loadHospitals()
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=loadHospitals',
        data:  '',
        cache: false
    }).done(function(data){
       
        var hospitals = JSON.parse(data);
        $.each(hospitals,function(x,y){
            $.each(y,function(a,b){
                objectMap.hosMPos[a] = b;
            });
        });
    });
}

function loadTwitterReports()
{   

    var tags = [];
    tags =  "<?php $tweet_data?>";
    console.log(tags);
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=thisTwitterReport',
        data:  '',
        cache: false
    })
    
    // .done(function(data){
    //     var hospitals = JSON.parse(data);
    //     $.each(hospitals,function(x,y){
    //         $.each(y,function(a,b){
    //             objectMap.hosMPos[a] = b;
    //         });
    //     });
    // });
}

function addCount(flu_name){
    // console.log(flu_name);
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=addFluCount',
        data:  {'flu_name':flu_name},
        cache: false
    })
}

function loadFacility()
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=markerFacility',
        data:  '',
        cache: false
    }).done(function(data){
        var hospitals = JSON.parse(data);
        // console.log(hospitals);
        $.each(hospitals,function(x,y){
            $.each(y,function(a,b){
                objectMap.hosMPos[a] = b;
            });
        });

        // console.log(objectMap.hosMPos);
    });
}

function fcounter()
{
    
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=facilityCounter',
        data:  '',
        cache: false
    }).done(function(data){
        console.log(data);
        var total = parseInt(data);
        
        for(var i=0; i <= total; i++){

            var offset = 300*i;
            if(!(offset >= total))
            {
                // console.log(offset+":"+i);
                loadFacilityOffset(offset);
            }
        }
        // var total = JSON.parse(data);
        // console.log(total);
    });
    //  .done(function(data){
    //     var hospitals = JSON.parse(data);
    //     // console.log(hospitals);
    //     $.each(hospitals,function(x,y){
    //         $.each(y,function(a,b){
    //             objectMap.hosMPos[a] = b;
    //         });
    //     });
    // });
}

function loadFacilityOffset(offset)
{
 
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();   
    // console.log(offset);
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=markerFacilityOffset',
        data: {"offset":offset,longitude:longitude,latitude:latitude},
        cache: false
    }).done(function(data){
        var hospitals = JSON.parse(data);
        // console.log(hospitals);
        $.each(hospitals,function(x,y){
            $.each(y,function(a,b){
                // objectMap.hosMPos.push(b);
                objectMap.hosMPos[a] = b;
                // objectMap.hosMarks.push(b);
            });
        });

        console.log(objectMap.hosMPos);
        objectMap.facilityMarkers(objectMap.hosMPos, objectMap.map);
    });
}
function generateFacilities()
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=thisfacility',
        data:  '',
        cache: false,
        timeout: 0,
    })
}

// function locations()
// {
//     $.ajax({
//         type: 'post',
//         url: 'modules/mod_flumonitor/controller.php?function=ptb',
//         data:  '',
//         cache: false
//     })
// }

// function generateDrugstoreLatlng()
// {
//     $.ajax({
//         type: 'post',
//         url: 'modules/mod_flumonitor/controller.php?function=drugStores',
//         data:  '',
//         cache: false
//     })   
// }


//latlng generator
// function drugs()
// {
//     $.ajax({
//         type: 'post',
//         url: 'modules/mod_flumonitor/controller.php?function=drugStores',
//         data:  ''
//     });
//     // .done(function(data){
//     //     var hospitals = JSON.parse(data);
//     //     $.each(hospitals,function(x,y){
//     //         $.each(y,function(a,b){
//     //             objectMap.hosMPos[a] = b;
//     //         });
//     //     });
//     // });
// }

var limit = '10';
var offset = '1';


  $(document).on('change','.page-number-hos', function() {
    var page_number = parseInt($(this).val());
      $('.listdata tbody').html('');
      get_list_hos(limit,page_number);
  });

$(".hospital-container").scroll(function() {
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {   
        var page_number = parseInt($('.page-number-hos').val());
        var next = page_number +1;
        if(page_number!=last()){
          get_list_hos(limit,next);
          $('.page-number-hos').val(next);
        }else{
             $('.loadmore').html('No More Hospitals');
        }
    }
});

  $(document).on('click','.last-page-hos', function() {
    var page_number = parseInt($('.page-number-hos').val());
    if(page_number!=last()){
      get_list_hos(limit,last());
      $('.page-number-hos').val($('.page-number-hos option:last').val());
    }
  });

  $(document).on('click','.prev-page-hos', function() {
    var page_number = parseInt($('.page-number-hos').val());
    var prev = page_number -1;
    if(page_number!=first()){
      get_list_hos(limit,prev);
      $('.page-number').val(prev);
    }
  });

  $(document).on('click','.first-page-hos', function() {
    var page_number = parseInt($('.page-number-hos').val());
    if(page_number!=first()){
      get_list_hos(limit,first());
      $('.page-number-hos').val($('.page-number-hos option:first').val());
    }
  });

  function first(){
    return parseInt($('.page-number-hos option:first').val());
  }

  function last(){
    return parseInt($('.page-number-hos option:last').val());
  }

    function get_list_hos(limit,offset){
    $('.loader-more-hos').show();
    $('.next-page-hos').hide();
    // var article_id = "<?php echo JRequest::getVar('id');?>";
    var table = "maps_facility";
    var order_by = "id";
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();

    $.ajax({
        type: 'Post',
        url: 'modules/mod_flumonitor/controller.php?function=get_data_map_list',
        data:{limit:limit, offset:offset, table:table, order_by:order_by,longitude:longitude,latitude:latitude},
      }).done( function(data){
        
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
                    htm+= '<div class="col-md-6 col-sm-12 col-xs-12 hospital_body">'; 
                                    htm+= '<div><span class="hospital_name blue-text p3 p_upper">'+row.facility_name+'</span></div>';
                                    htm+= '<div class="hospital_add p4">'+row.street_name+','+row.barangay_name+','+row.city_name+'</div>';
                                    htm+= '<div class="hospital_add p4">'+row.description+'</div>';
                    htm+= '</div>';
            });

          setTimeout(function(){
            $('.loader-more-hos').hide();
            $('.next-page-hos').show();      
            $('.list-container-hos').append(htm);
           }, 3000);
     }); 
  }
  
  function get_pagination_hos(page_num,limit){
    // var article_id = "<?php echo JRequest::getVar('id');?>";
    var table = "maps_facility";
    var order_by = "id";
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();
    $.ajax({
        type: 'Post',
        url: 'modules/mod_flumonitor/controller.php?function=get_data_map_count',
        data:{limit:limit, table:table, order_by:order_by,longitude:longitude,latitude:latitude },
      }).done( function(data){
          var htm = '';
          htm += '<span class = "glyphicon glyphicon-step-backward first-page-hos"></span><span class = "glyphicon glyphicon-triangle-left prev-page-hos"></span><select class="page-number-hos"> ';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><span class = "glyphicon glyphicon-triangle-right next-page-hos"></span><span class = "glyphicon glyphicon-step-forward last-page-hos"></span>';

          $('.pagination-hos').html('');
          $('.pagination-hos').html(htm);
     }); 
  }







  $(document).on('change','.page-number', function() {
    var page_number = parseInt($(this).val());
      $('.listdata tbody').html('');
      get_list(limit,page_number);
  });

$(".drugstore-container").scroll(function() {
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {   
        var page_number = parseInt($('.page-number').val());
        var next = page_number +1;
        if(page_number!=last()){
          get_list(limit,next);
          $('.page-number').val(next);
        }else{
             $('.loadmore').html('No More Articles');
        }
    }
});

  $(document).on('click','.last-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=last()){
      get_list(limit,last());
      $('.page-number').val($('.page-number option:last').val());
    }
  });

  $(document).on('click','.prev-page', function() {
    var page_number = parseInt($('.page-number').val());
    var prev = page_number -1;
    if(page_number!=first()){
      get_list(limit,prev);
      $('.page-number').val(prev);
    }
  });

  $(document).on('click','.first-page', function() {
    var page_number = parseInt($('.page-number').val());
    if(page_number!=first()){
      get_list(limit,first());
      $('.page-number').val($('.page-number option:first').val());
    }
  });

  function first(){
    return parseInt($('.page-number option:first').val());
  }

  function last(){
    return parseInt($('.page-number option:last').val());
  }

    function get_list(limit,offset){
    $('.loader-more').show();
    $('.next-page').hide();

    // var article_id = "<?php echo JRequest::getVar('id');?>";
    var table = "maps_drugstore";
    var order_by = "drugstore_id";
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();

    $.ajax({
        type: 'Post',
        url: 'modules/mod_flumonitor/controller.php?function=get_data_map_list',
        data:{limit:limit, offset:offset, table:table, order_by:order_by,longitude:longitude,latitude:latitude},
      }).done( function(data){
        
              var obj = JSON.parse(data);
              var htm = '';
          $.each(obj, function(index, row){ 
                    htm+= '<div class="col-md-6 col-sm-12 col-xs-12 drugstore_body">';                                   
                    htm+= '<div><span class="drugstore_name blue-text p3 p_upper">'+row.name+'</span></div>';
                    htm+= '<div class="drugstore_address p4">'+row.complete_address+'</div>';
                    htm+= '<div class="drugstore_contact p4">'+row.contact_number+'</div>';
                    htm+= '</div>';
            });

          setTimeout(function(){
            $('.loader-more').hide();
              $('.next-page').show();      
            $('.list-container').append(htm);
           }, 3000);
     }); 
  }
  
  function get_pagination(page_num,limit){
    // var article_id = "<?php echo JRequest::getVar('id');?>";
    var table = "maps_drugstore";
    var order_by = "drugstore_id";
    var longitude = $('.longitude').val();
    var latitude = $('.latitude').val();
    $.ajax({
        type: 'Post',
        url: 'modules/mod_flumonitor/controller.php?function=get_data_map_count',
        data:{limit:limit, table:table, order_by:order_by,longitude:longitude,latitude:latitude },
      }).done( function(data){
          var htm = '';
          htm += '<span class = "glyphicon glyphicon-step-backward first-page"></span><span class = "glyphicon glyphicon-triangle-left prev-page"></span><select class="page-number"> ';
          for(var x =1; x<=data; x++){
            htm += "<option value='"+x+"'>"+x+"</option>";
          }
          htm += '</select><span class = "glyphicon glyphicon-triangle-right next-page"></span><span class = "glyphicon glyphicon-step-forward last-page"></span>';

          $('.pagination').html('');
          $('.pagination').html(htm);
     }); 
  }



</script>


<script type="text/javascript">

$('.email').on('change', function(){

var email = $('.email').val();
  //  $.ajax({
  //   type: 'Post',
  //   url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
  //   data:{email: email},
  // }).done( function(data){
  //   if (data == 0) {
  //      // $('.existing-email').hide();
  //   }else{
  //      $('.error-clone').html('<div class = "col-md-12 pad-0"><div class = "col-md-10 pad-0"><p class = "title-error">ERROR!</p><p>Email is already registered *</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');

  //   }
  //   });



function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
  } 


});

function resizeMaps()
{
    var child_height = $('.map-details').outerHeight();
    console.log(child_height);
    $('#map-canvas').height(child_height);
    $('.map-container').height(child_height);
}

$('.btn-submitflu').on('click', function(){
  var counter = 0;
  var count_symptoms = 0;
  var email = $('.email').val();
  var province = $('.province').val();
   $('.error-clone').show();

       $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              if (email.length == 0 || province.length == 0) {
                  $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Required fields</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
              }
                 counter++;
            }
        });

        $('.inputs2:checked').each(function(){
          var id = $(this).attr('data-id');
            if ($('.inputs2:checked').length != 0){
              count_symptoms++;
            }
        });

        if(count_symptoms == 2){
          var number_of_symptoms = 1;
        }
        if(count_symptoms == 3){
          var number_of_symptoms = 2;
        }
        if(count_symptoms == 4){
          var number_of_symptoms = 3;
        }

        if(email.length != 0){     
            var val = validateEmail(email); 
            if (val == false)
            {
              $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>The email you have entered is invalid</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
            }
                
          }

      function validateEmail(email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test(email);
        } 

   $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
    data:{email: email},
  }).done( function(data){
    if (data == 0) {

       if (count_symptoms <= 1) {
         $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Please click atleast to two symptoms</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
         }else{
          if (counter == 0) {
            
            var fullname = $('.fullname').val();
            var email = $('.email').val();
            var contactnumber = $('.contactnumber').val();
            var province = $('.province').val();
            var city = $('.city').val();
            var barangay = $('.barangay').val();

            if(email.length != 0){     
            var val = validateEmail(email); 
            if (val == true)
            {
               $('.loader').show();
               $('.btn-submitflu').attr('disabled', true);
               $('.error-clone').html('');
           $.ajax({
                  type: 'Post',
                  url: 'modules/mod_flu_sidebar/controller.php?function=insert',
                  data:{'fullname': fullname, 'email': email, 'contactnumber': contactnumber, 'barangay':barangay, 'number_of_symptoms': number_of_symptoms},
                }).done( function(data){
                  
                   $('.inputs2:checked').each(function(){
                      var symptoms_id = $(this).attr('data-id');
                        if ($('.inputs2:checked').length != 0){
                            $.ajax({
                                  type: 'Post',
                                  url: 'modules/mod_flu_sidebar/controller.php?function=insert_symptoms',
                                  data:{'symptoms_id': symptoms_id, 'user_id': data},
                                }).done( function(data){
                                    setTimeout(function(){
                                    $('.loader').hide();
                                    $('.inputs2').attr('checked', false);
                                    $('.inputs').val('');
                                    $('.fullname').val('');
                                    $('.contactnumber').val('');
                                    $('.hide-city').hide();
                                    $('.hide-barangay').hide();
                                    $('.error-clone').html('<div style = "border:4px solid #039700; border-radius:10px; background:#fff;" class = "col-md-12 flu-success-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error" style = "color:#000">Thank you for reporting your flu symptoms.</p><p style = "color:#333">Visit the <a href = "bioflu-information">Information Page</a> and learn how to relieve your flu symptoms immediately or head to the nearest <a href = "bioflu-information">drugstore</a> with available Bioflu.</p></div><div class = "col-md-2 pad"><span style = "color: #039700; font-size:20px;" class = "glyphicon glyphicon-remove-sign close-success"></span></div></div>');

                                    }, 4000);
                                    });
                              }});});}else{
                 $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>The email you have entered is invalid</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
              }}}}}else{
       $('.error-clone').html('<div class = "col-md-12 flu-danger-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error">ERROR!</p><p>Sorry, you have exceeded the number of submissions allowed.</p></div><div class = "col-md-2 pad"><span class = "glyphicon glyphicon-remove-sign close-err"></span></div></div>');
       }});});


getprovince();
$('.hide-city').hide();
$('.hide-barangay').hide();
$(document).on('change', '.province', function(){
  var province_id = $('.province').val();
  getcity(province_id);

  if (province_id.length == 0 ) {
    $('.hide-city').hide();
  }else{
    $('.hide-city').show();
  }
  resizeMaps();
});
$(document).on('change', '.city', function(){
  var city_id = $('.city').val();
  getbarangay(city_id);

  if (city_id.length == 0 ) {
    $('.hide-barangay').hide();
  }else{
    $('.hide-barangay').show();
  }
  resizeMaps();
});



function getprovince(){
  $.ajax({
      type: 'Post',
      url: 'modules/mod_flu_sidebar/controller.php?function=province',
      data:{},
    }).done( function(data){
            var obj = JSON.parse(data);
            var htm = '';
             if (obj.length == 0) {
             
            }else{
            htm+="<option value = ''>Select</option>";
        $.each(obj, function(index, row){
            htm+="<option value = "+row.province_id+">"+row.province_name+"</option>";                    
           });
        }
            $('.province').html('');
            $('.province').html(htm);
     }); 
}


function getcity(province_id){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=city',
    data:{province_id: province_id},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';
           if (obj.length == 0) {
           
          }else{
          htm+="<option value = ''>Select</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.territory_id+">"+row.territory_name+"</option>";                    
         });
      }
          $('.city').html('');
          $('.city').html(htm);
    });        
}



function getbarangay(city_id){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=barangay',
    data:{city_id: city_id},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';
           if (obj.length == 0) {
           
          }else{
          htm+="<option value = ''>Select</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.barangay_id+">"+row.barangay_name+"</option>";                    
         });
      }
          $('.barangay').html('');
          $('.barangay').html(htm);
    });        
}

getsymptoms();

function getsymptoms(){
  $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=getsymptoms',
    data:{},
  }).done( function(data){
          var obj = JSON.parse(data);
          var htm = '';

      $.each(obj, function(index, row){
          htm+='<div class="col-md-6 pad-0"><div class="col-md-2 pad-0"><input  type="checkbox" name = "" class = "inputs2 '+row.flu_symptoms+'" data-id = "'+row.id+'"></div>';
          htm+='<div class="col-md-10 pad-0 ">'+row.flu_symptoms+'</div></div>';                    
         });
      
          $('.list-symptoms').html('');
          $('.list-symptoms').html(htm);
    });        
}
     


$('.modal-close').click(function(){
  location.reload();
});        

$(document).on('click', '.error-clone .close-err',function(){
  $('.error-clone').fadeOut();
});

$(document).on('click', '.error-clone .close-success',function(){
  location.reload();
});



</script>

<script type="text/javascript">


//google.maps.event.addDomListener(window, 'load', initialize);

</script>