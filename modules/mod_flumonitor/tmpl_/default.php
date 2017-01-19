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

<div class="col-md-12 parent-container" style="height:100%;">

    <div class="child-containers col-md-8 col-xs-8 col-sm-8 panel map-container" style="height:100%;">
        <input id="pac-input" class="search-controls" type="text" placeholder="Enter a location">
        <div id="map-canvas" style="height: 100%; width:100%;">
        </div>
    </div>
    <div class="child-containers col-md-4 col-xs-4 col-sm-4 panel map-details pad-0" style="height:100%;">
        <div class="col-md-12 mapmania-container">
            <div class="button-settings col-md-12">
                <div class="btn_header col-md-offset-2">
                    <div class="col-md-6 filter-label"><span class = "glyphicon glyphicon-filter" style = "margin-right:5px"></span>Filter Monitor</div>
                    <div class="col-md-6 reset-lbl txt-center" id="reset_btn">Reset</div>
                 </div>
                <div class="row bs-row">
                    <div class="col-md-4 col-md-offset-2 col-xs-5 col-xs-offset-2 bs-labels">
                        <span class="bs-label-text">Hospitals</span>
                    </div>
                    <div class="col-md-5 col-md-offset-1 bs-btns txt-center" >
                        <!-- <button type="button" class="btn btn-primary bs-btn col-md-9 col-xs-3" id="btn_hospitals">Show</button> -->
                        
                        <label class="switch">
                            <input id="switch-hospital"type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="" data-off=""></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
                <div class="row bs-row">
                    <div class="col-md-4 col-md-offset-2 col-xs-5 col-xs-offset-2 bs-labels">
                        <span class="bs-label-text">Promotions</span>
                    </div>
                    <div class="col-md-5 col-md-offset-1 bs-btns txt-center">
                        <!-- <button type="button" class="btn btn-primary bs-btn col-md-9 col-xs-3" id="btn_promotion">Show</button> -->
                        <label class="switch">
                            <input id="switch-promo"type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="" data-off=""></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
                <div class="row bs-row">
                    <div class="col-md-4 col-md-offset-2 col-xs-5 col-xs-offset-2 bs-labels">
                        <span class="bs-label-text">Drugstores</span>
                    </div>
                    <div class="col-md-5 col-md-offset-1 bs-btns txt-center">
                        <!-- <button type="button" class="btn btn-primary bs-btn col-md-9 col-xs-3" id="showDrugstoreBtn">Show</button> -->
                        <label class="switch">
                            <input id="switch-drugstore" type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="" data-off=""></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 sidebar-container">
            <div class="col-md-12 txt-center">
                <label><h2>DO YOU THINK YOU HAVE THE FLU?</h2></label>
                <span><h4>Report All Your Flu Symptoms</h4></span>
                <span><h4>Check All Applicable Boxes</h4></span>
            </div>
            <div class="col-md-12 list-symptoms"></div>
            <div class="col-md-12 txt-center">
                <span class = "er-msg symptoms">Select atleast two symptoms * </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black ">
                <span class = "white ">Name</span>
                <input type = "text" name = "fullname" class = "fullwidth fullname" placeholder = "Name">
                <span class = "er-msg">Name is required * </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black">
                <span class = "white">Email Address *</span>
                <input type = "text" name = "email" class = "fullwidth inputs email" placeholder = "Email Address">
                <span class = "er-msg valid-email">Email Address is required * </span>
                <span class = "er-msg existing-email">Email is already registered * </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black">
                <span class = "white">Mobile Number</span>
                <input type = "text" name = "contactnumber" class = "fullwidth contactnumber" placeholder = "Mobile Number">
                <span class = "er-msg">Mobile Number is required * </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black">
                <span class = "white">Provinces *</span>
                <select class = "fullwidth inputs province">
                </select>
                <span class = "er-msg">Provinces is required </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black hide-city">
                <span class = "white">City *</span>
                <select class = "fullwidth inputs city black">
                    <option value = ''>Select</option>
                </select>
                <span class = "er-msg">City is required * </span>
            </div>
            <div class="col-md-12 txt-left pad-5 black hide-barangay">
                <span class = "white">Barangay *</span>
                <select class = "fullwidth inputs barangay black">
                    <option value = ''>Select</option>
                </select>
                <span class = "er-msg">Barangay is required * </span>
            </div>
            <div class="col-md-12 txt-center pad-5">
                <button class = "btn btn-danger btn-submitflu" onclick="ClickTrackinEvent('Form','Submit','Submit FLU')">SUBMIT <img class = "loader" src="images/bioflu/loader.gif"></button>
            </div>
            <div class="col-md-12 error-clone pad-0"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Message</h4>
            </div>
            <div class="modal-body">
                Successfully saved.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(window).load(function(){
    var child_height = $('.map-details').outerHeight();
    console.log(child_height);
    $('#map-canvas').height(child_height);
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
    
    // loadMarkersV2(dbMarkers);
    var d = new Date();
    var n = d.getTime();

    // loadFacility();
     fcounter();
    // locations();
    // console.log(n);
    
    // generateDrugstoreLatlng();

    // generateFacilities();
    // loadReportMakers();
    loadTags();
    loadStores();
    loadHospitals();
    
    //triggerClick
    // new buttons v2
    $('#switch-hospital').css('cursor','pointer');
    $('.mapmania-container').on('click','#switch-hospital',function(){
        showHospital = true;
        flu_name = 'hospitals';
        if(showHospital == true && showHospitalTimes == 0){
            showHospitalTimes++;
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
    <?php foreach ($tweet_data as $key => $value):?>
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
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=loadDrugstores',
        data:  '',
        cache: false
    }).done(function(data){
        var stores = JSON.parse(data);
        $.each(stores,function(x,y){
            $.each(y,function(a,b){
                objectMap.storeMPos[a] = b;
            });
        });
        console.log(objectMap.storeMPos);
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
    var tagsArr = {};
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=tags',
        data:  '',
        cache: false
    }).done(function(data){
        var tData = JSON.parse(data);
        // console.log(tData);
        $.each(tData, function(x,y){
            $.each(y,function(a,b){
                tagsArr[a] = b;

            });
        });
        objectMap.layMarker(tagsArr,objectMap.map);
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
    
    // console.log(offset);
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=markerFacilityOffset',
        data: {"offset":offset},
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
                                    $('.error-clone').html('<div style = "border:4px solid #039700; border-radius:10px; background:#fff;" class = "col-md-12 flu-success-con pad-0"><div class = "col-md-10 pad-10"><p class = "title-error" style = "color:#000">Thank your for reporting flu symptoms.</p><p style = "color:#333">Visit the <a href = "bioflu-information">Information Page</a> to learn how to relieve your flu symptoms immediately or head to the nearest <a href = "bioflu-information">drugstore</a> with available Bioflu.</p></div><div class = "col-md-2 pad"><span style = "color: #039700; font-size:20px;" class = "glyphicon glyphicon-remove-sign close-success"></span></div></div>');

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

<style type="text/css">

.error-clone .flu-danger-con{
  border: 4px solid #ca4a48;
  border-radius: 10px;
  background: #fff;
  color: #000;
}

.error-clone .title-error{
  color: #ca4a48;
  font-weight: bold;
 
}
.error-clone p{
   margin: 0px;
}

.error-clone{
  margin-bottom: 20px; box-shadow: 0 5px 7px #7e7e7e;
}
.error-clone .glyphicon-remove-sign{
   color: #ca4a48;
   font-size: 20px;

}
.title-error{
  margin-top: 5px;
}
.glyphicon-remove-sign{
  cursor: pointer;
}
</style>

