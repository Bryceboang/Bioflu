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
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/css/nationalflu.css">
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/css/responsive.css">

<!-- load map resources -->
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyANldOrkcTeu_Oz0E_RTB4erZoKB-frZxE&v=3.0&sensor=false'></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/infobox.js"></script>
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/maplabel.js"></script>
<link rel="stylesheet" type="text/css" href="<?=JURI::base()?>modules/mod_flumonitor/assets/toggles/style.css">
<script type="text/javascript" src="<?=JURI::base()?>modules/mod_flumonitor/assets/js/map.js"></script>
 <div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8 txt-center">
        <div class="col-md-12"><h2><p style = "color:#c44f3e; font-weight:bold">FLU MONITOR</p></h2></div>
        <div class="col-md-12"><label>KEEPING THE HIGHLY CONTAGIOUS FLU IN CHECK</label></div>
        <div class="col-md-12"><p>The Flu monitor allows you to keep updated and report flu outbreaks in your area. It can also help you manage the multi-symptoms of the flu by pointing you to the nearest drugstore with available Bioflu.</p></div>
    </div>
    <div class="col-md-2"></div>
    </div>

<div class="col-md-12 parent-container" style="height:100%;">



    <div class="child-containers col-md-8 col-xs-8 col-sm-8 panel map-container" style="height:100%;">
        <div id="map-canvas" style="height: 100%; width:100%;">
        </div>
    </div>
    <div class="child-containers col-md-4 col-xs-4 col-sm-4 panel map-details pad-0" style="height:100%;">
        <div class="col-md-12 mapmania-container">
            <div class="button-settings col-md-12">
                <div class="btn_header col-md-offset-2">
                    <div class="col-md-6 filter-label"><span class = "glyphicon glyphicon-filter" style = "margin-right:5px"></span>Filter Monitor</div>
                    <div class="col-md-6 reset-lbl txt-center">Reset</div>
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
<label><h4>Report Your Flu Symptoms</h4></label>
</div>

<div class="col-md-12 list-symptoms"></div>
<div class="col-md-12 txt-center">
<span class = "er-msg symptoms">Select atleast two symptoms * </span>
</div>

<div class="col-md-12 txt-left pad-5 black ">
  <span class = "white ">Name</span>
  <input type = "text" name = "fullname" class = "fullwidth inputs fullname" placeholder = "Name">
  <span class = "er-msg">Name is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Email Address</span>
  <input type = "text" name = "email" class = "fullwidth inputs email" placeholder = "Email Address">
  <span class = "er-msg valid-email">Email Address is required * </span>
  <span class = "er-msg existing-email">Email is already registered * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Contact Number</span>
  <input type = "text" name = "contactnumber" class = "fullwidth inputs contactnumber" placeholder = "Contact Number">
  <span class = "er-msg">Contact Number is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black">
  <span class = "white">Province</span>
  <select class = "fullwidth inputs province">
    
  </select>
  <span class = "er-msg">Province is required * </span>
</div>

<div class="col-md-12 txt-left pad-5 black hide-city">
  <span class = "white">City</span>
  <select class = "fullwidth inputs city black">
    <option value = ''>Select Your City</option>
  </select>
  <span class = "er-msg">City is required * </span>
</div>

<div class="col-md-12 txt-center pad-5">
  <button class = "btn btn-danger btn-submitflu">SUBMIT <img class = "loader" src="images/bioflu/loader.gif"></button>
</div>

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
$(document).ready(function() {
    
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
    //initialize Map
  
    // loadTwitterMakers(tweetMarkers);
    // loadMarkers(dbMarkers);
    loadMarkersV2(dbMarkers);
    loadStores();
    // geocode(address);
    loadHospitals();
    // // loadMoreTweets();
    //triggerClick
    
    // new buttons v2
    $('#switch-hospital').on('click',function(){
        showHospital = true;
        if(showHospital == true && showHospitalTimes == 0){
            showHospitalTimes++;
            objectMap.hospitalMarkers(objectMap.hosMPos, objectMap.map);

        }
        else{
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        }
    });

    $('#switch-promo').on('click',function(){
        showPromotion = true;
        if(showPromotion == true && showPromotionTimes == 0){
            showPromotionTimes++;
            objectMap.showInfoWindows();

        }
        else{
            showPromotionTimes = 0;
            objectMap.closeInfowindows();
        }
    });

    $('#switch-drugstore').on('click',function(){
       showDrugstoreChecker = true;
        if(showDrugstoreChecker == true && showDrugstore == 0)
        {
            showDrugstore++;
            objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);

        }
        else
        {
            showDrugstore = 0;
            objectMap.clearStoreMarkers();
        }
    });



    $('#hide_drugstore_btn').hide();

    $('.map-details').on('click','#city_view_btn',function(){
        objectMap.map.setZoom(15);
    });

    $('.map-details').on('click','#map_view_btn',function(){
        objectMap.map.setZoom(6);
    });

    $('.map-details').on('click','#drugstore_btn',function(){
        storeShown = true;
        if( storeShown == true && showTimes == 0)
        { 
            objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);
            showTimes ++;
            $('#drugstore_btn').hide();
            $('#hide_drugstore_btn').show();
        }
        
    });
    $('.map-details').on('click','#hide_drugstore_btn',function(){
        if(storeShown == true)
        {
            objectMap.clearStoreMarkers();   
            showTimes = 0;
            storeShown = false; 
            $('#drugstore_btn').show();
            $('#hide_drugstore_btn').hide();
        }
        
    });
    $('.map-details').on('click','#generate_btn',function(){
        // console.log(dbMarkers);
        // console.log(tweetMarkers);
        // var db_marker = dbMarkers;
        // var tweet_marker = tweetMarkers;
        var fromDb = dbMarkers;
        var fromTwitter = tweetMarkers;
        
        $.ajax({
            type: 'post',
            url: 'modules/mod_flumonitor/controller.php?function=generateExcelData',
            data:  {dbData:JSON.stringify(fromDb),dbTweets:JSON.stringify(fromTwitter)},
            datatype:'json'
        }).done(function(data){
            window.location = data;
        });
    });

    $('#mode_btn').on('click',function(){
        // showArea = true;
        // if(showArea == true && showAreaTimes == 0)
        // {   
        //     showAreaTimes++;
        //     $(this).html('Normal Mode');
        //     var objChecker = isEmpty(objectMap.areaMarkers);
        //     if(objChecker == false)
        //     {
        //         var Amarkers = objectMap.areaMarkers;
        //         for(var areaM in Amarkers )
        //         {
        //             Amarkers[areaM].setVisible(true);
        //         }
        //         hideMarkers(objectMap.markers);
        //     }
        //     else
        //     {
        //         $.ajax({
        //         type: 'post',
        //             url: 'modules/mod_flumonitor/controller.php?function=getTagTerritory',
        //             data:  ''
        //         }).done(function(data){
        //             var tData = JSON.parse(data);
        //             // console.log(tData);
        //             // $.each(tData, function(x,y){
        //             //     $.each(y,function(a,b){
        //             //         areaTags[a] = b;
        //             //     });
        //             // });
        //             // //console.log(tData);
        //             objectMap.areaMode(tData,objectMap.map);
        //         });
        //     }
        // }
        // else
        // {
        //     $(this).html('AREA MODE');
        //     showAreaTimes = 0;
        //     showMarkers(objectMap.markers);
        //     hideAreaTags(objectMap.areaMarkers);
        // }
         $.ajax({
                type: 'post',
                url: 'modules/mod_flumonitor/controller.php?function=getTagTerritory',
                data:  ''
            }).done(function(data){
                var tData = JSON.parse(data);
                // console.log(tData);
                $.each(tData, function(x,y){
                    $.each(y,function(a,b){
                        areaTags[a] = b;
                    });
                });
                // //console.log(tData);
                objectMap.areaMarker(tData,objectMap.map);
            });
    });


    //new buttons
    $('#showDrugstoreBtn').on('click', function(){
        showDrugstoreChecker = true;
        if(showDrugstoreChecker == true && showDrugstore == 0)
        {
            showDrugstore++;
            $(this).html('Hide');
            objectMap.storeMarkers(objectMap.storeMPos, objectMap.map);

        }
        else
        {
            $(this).html('Show');
            showDrugstore = 0;
            objectMap.clearStoreMarkers();
        }
        // alert("asdasd");
    });

    $('#btn_hospitals').on('click',function(){
        showHospital = true;
        if(showHospital == true && showHospitalTimes == 0)
        {
            showHospitalTimes++;
            $(this).html('Hide');
            objectMap.hospitalMarkers(objectMap.hosMPos, objectMap.map);

        }
        else
        {
            $(this).html('Show');
            showHospitalTimes = 0;
            objectMap.clearHospitalMarkers();
        }
    });

    $('#btn_promotion').on('click',function(){
        showPromotion = true;
        if(showPromotion == true && showPromotionTimes == 0)
        {
            showPromotionTimes++;
            $(this).html('Hide');
            objectMap.showInfoWindows();

        }
        else
        {
            $(this).html('Show');
            showPromotionTimes = 0;
            objectMap.closeInfowindows();
        }
    });

    // $('.btn-submitflu').on('click',function(){
    //     $.ajax({
    //         type: 'post',
    //         url: 'modules/mod_flumonitor/controller.php?function=saveSymptom',
    //         data:  $( "#survey_symptoms" ).serialize()
    //     })
    //     // .done(function(data){
    //     //     // $('#survey_symptoms')[0].reset();
    //     //     // $('#territory_input').hide();
    //     //     // loadMarkers();
    //     // });
    // });
    

});

function loadTwitterMakers(tweetMarkers)
{   
    // var tweetMarkers = {};
    <?php foreach ($tweet_data as $key => $value):?>
        objectMap.tweetMPos[<?=$key;?>] = <?=$value;?>;
        tweetMarkers[<?=$key;?>] =  <?=$value;?>;
    <?php endforeach;?>
    // console.log(tweetMarkers);
    objectMap.twitterlayMarker(objectMap.tweetMPos, objectMap.map);
}

function geocode(add)
{
    
    // $.ajax({
    //     type: 'post',
    //     url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+add,
    //     data:  ''
    // }).done(function(data){
    //     var obj = JSON.parse(data);

    // });
    // 
    $.post('https://maps.googleapis.com/maps/api/geocode/json?address='+add,{data:''},function(geo){
        //console.log(result);
        // var res = json.parse(geo);
        console.log(JSON.stringify(geo));
    },'json');
}

function loadStores()
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=loadDrugstores',
        data:  ''
    }).done(function(data){
        var stores = JSON.parse(data);
        $.each(stores,function(x,y){
            $.each(y,function(a,b){
                objectMap.storeMPos[a] = b;
            });
        });

    });
}


function loadMoreTweets()
{
    var url = '<?php echo $tweet_meta;?>';
    console.log(url);
}

function loadMarkers(dbMarkers)
{   
    $.post('modules/mod_flumonitor/controller.php?function=tags',{data:'<?=date("Y/m/d");?>'},function(result){
        $.each(result,function(x,y){
            $.each(y,function(a,b){
                objectMap.markerPos[a] = b;
                dbMarkers[a] = b;
            });
        });
        // console.log(dbMarkers);
        objectMap.layMarker(objectMap.markerPos, objectMap.map);
    },'json');
}

function loadMarkersV2(dbMarkers)
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=getTagTerritory',
        data:  ''
    }).done(function(data){
        var tData = JSON.parse(data);
        // console.log(tData);
        $.each(tData, function(x,y){
            $.each(y,function(a,b){
                areaTags[a] = b;
            });
        });
        // //console.log(tData);
        objectMap.areaMarker(tData,objectMap.map);
    });
}

function loadHospitals()
{
    $.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=loadHospitals',
        data:  ''
    }).done(function(data){
        var hospitals = JSON.parse(data);
        $.each(hospitals,function(x,y){
            $.each(y,function(a,b){
                objectMap.hosMPos[a] = b;
            });
        });
    });
}
function isEmpty(obj)
{
    for(var prop in obj)
    {
        if(obj.hasOwnProperty(prop))
            return false;
    }
    return true;
}

</script>




<script type="text/javascript">

$('.email').on('change', function(){
  

var email = $('.email').val();

  
var email = $('.email').val();
   $.ajax({
    type: 'Post',
    url: 'modules/mod_flu_sidebar/controller.php?function=checkmail',
    data:{email: email},
  }).done( function(data){
    if (data == 0) {
       $('.existing-email').hide();
    }else{
        $('.existing-email').show();
    }
    });


  if(email.length != 0){     
      var val = validateEmail(email); 
      if (val == false)
      {
        $('.valid-email').show();
        $('.valid-email').html('The email you have entered is invalid'); 
      }
      else
      {
         $('.valid-email').hide();
        $('.valid-email').html('Email address is required ');
      }       
    }

function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
  } 


});

$('.btn-submitflu').on('click', function(){
  var counter = 0;
  var count_symptoms = 0;
  var email = $('.email').val();
      
       $('.inputs').each(function(){
            var input = $(this).val();

            if (input.length == 0) {
              $(this).next().show();
              counter++;
            }else{
              $(this).next().hide();
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
            if (val == true)
            {
              $('.valid-email').hide();
              $('.valid-email').html('Email address is required ');
            }
            else
            {
              $('.valid-email').show();
              $('.valid-email').html('The email you have entered is invalid'); 
              return false;
            }       
          }

      function validateEmail(email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test(email);
        } 

       if (count_symptoms <= 1) {
          $('.symptoms').show()
         }else{
           $('.symptoms').hide()
          if (counter == 0) {
            
            var fullname = $('.fullname').val();
            var email = $('.email').val();
            var contactnumber = $('.contactnumber').val();
            var province = $('.province').val();
            var city = $('.city').val();
            $('.loader').show();
            $('.btn-submitflu').attr('disabled', true);
           $.ajax({
                  type: 'Post',
                  url: 'modules/mod_flu_sidebar/controller.php?function=insert',
                  data:{'fullname': fullname, 'email': email, 'contactnumber': contactnumber, 'city':city, 'number_of_symptoms': number_of_symptoms},
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
                                     $('#success-modal').modal();
                                      }, 4000);
                                   });
                              }
                      });
                 
                });

         }
       }       
});


getprovince();
$('.hide-city').hide();
$(document).on('change', '.province', function(){
  var province_id = $('.province').val();
  getcity(province_id);

  if (province_id.length == 0 ) {
    $('.hide-city').hide();
  }else{
    $('.hide-city').show();
  }
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
            htm+="<option value = ''>Select Your Province</option>";
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
          htm+="<option value = ''>Select Your City</option>";
      $.each(obj, function(index, row){
          htm+="<option value = "+row.territory_id+">"+row.territory_name+"</option>";                    
         });
      }
          $('.city').html('');
          $('.city').html(htm);
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

$(document).on('change', '.email', function(){

});

</script>
