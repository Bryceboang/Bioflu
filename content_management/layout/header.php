<?php 
require_once dirname(__FILE__) . '/config.php';
  
  if (isset($_SESSION['session_id'])!='') {
      $session_id = $_SESSION['session_id'];
       $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query
    ->select($db->quoteName(array('u.id', 'u.name', 'u.email', 'u.username')))
     ->select($db->quoteName(array('g.group_id', 'g.user_id')))
     ->select('ug.title')
    ->from($db->quoteName('#__users','u'))
    ->join('LEFT', $db->quoteName('#__user_usergroup_map', 'g') . ' ON (' . $db->quoteName('u.id') . ' = ' . $db->quoteName('g.user_id') . ')')
    ->join('LEFT', $db->quoteName('#__usergroups', 'ug') . ' ON (' . $db->quoteName('g.group_id') . ' = ' . $db->quoteName('ug.id') . ')')
    ->where($db->quoteName('u.id') . ' = '. $db->quote($session_id));
    $db->setQuery($query);
    $results = $db->loadObjectList();
     $_SESSION['name'] = $results[0]->name;
     $_SESSION['access_id'] = $results[0]->group_id;
      $_SESSION['access_name'] = $results[0]->title;
     $_SESSION['username'] = $results[0]->username;
  }

   
      

 ?>




<html>

<title>Content Management</title>

<head>


	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script type="text/javascript" src = "assets/js/jquery.js"></script>

	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="assets/css/uploadify.css">
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script> -->
<script type="text/javascript" src="assets/js/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.js"></script>

<script type="text/javascript" src="assets/js/datepicker.js"></script>

	<!--cleditor-->

		<link rel="stylesheet" type="text/css" href="assets/cle/jquery.cleditor.css">

		<script type="text/javascript" src = "assets/cle/jquery.cleditor.js"></script>

		<script type="text/javascript" src = "assets/cle/jquery.cleditor.min.js"></script>

	<!--cleditor-->



</head>

<div class="col-md-12 header-bg">
</div>

<body>


	<!-- Modal -->
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body"> 
       <d class = "msg"> Successfully saved... </d>   
      </div>
      <div class="modal-footer" style = "border:0px">
      		<button class = "btn btn-primary btc2" data-dismiss="modal" style = "padding:2px 10px;" >Close</button>
  
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style = "width:95% !important; height:95% !important;">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close btn-prev-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Preview</h4>
      </div>
      <div class="modal-body"> 
       <d class = "msg"> </d>   
      </div>
      <div class="modal-footer" style = "border:0px">
          <!-- <button class = "btn btn-primary btn-close" data-dismiss="modal" style = "padding:2px 10px;" >Close</button> -->
  
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-slider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style = "height:400px">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close btn-prev-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Stock Image</h4>
      </div>
      <div class="modal-body"> 
        <div class="col-md-1 prev" src = "">Prev</div>
        <div class="content-slider col-md-10 text-center" style = "height:500px;"> 
        </div>
        <div class="col-md-1 next" src = "">Next</div>
      </div>
      <div class="modal-footer" style = "border:0px">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style = "height:400px">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close btn-prev-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Stock Video</h4>
      </div>
      <div class="modal-body"> 
        <div class="col-md-1 prev" src = "">Prev</div>
        <div class="content-video col-md-10 text-center" style = "height:500px;"> 
        </div>
        <div class="col-md-1 next" src = "">Next</div>
      </div>
      <div class="modal-footer" style = "border:0px">

      </div>
    </div>
  </div>
</div>


<!--Image Modal -->
<div class="modal fade" id="select-image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Image Manager <d style = "display:none" class = "id-image"></d></h4>
      </div>
      <div class="file-manager">       
      </div>
      <div class="modal-footer">
        <div class="col-md-8">
          <!-- <p align="left">Upload or Select file</p> -->
          <div class="row">
            <div class="col-md-5">
              <input id = 'imgfiles' type = "file">
            </div>
            <div class="col-md-5">
              <button class = "upload btn btn-success" style = "padding:2px 10px;"><d class="uploadlabel"> Upload </d><img class = "loader" src="assets/img/loader.gif"></button>
            </div>
          </div>
        </div>
        <div class="col-md-4 c-insert">
          <button class = "btn btn-primary btn-insert" data-dismiss="modal" style = "padding:2px 10px; display:none;" >Insert</button>
        </div>
        <div class="col-md-12 c-copy pad-0" style = "display:none">
          <div class="col-md-9 pad-0">
          <input type = "text" class = "pathtocopy fullwidth">
          </div>
          <div class="col-md-3 pad-0">
          <button style = "padding:2px 10px;" class = "btn btn-primary btn-copy">Insert Image</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Video Modal -->
<div class="modal fade" id="select-video-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Video Manager <d style = "display:none" class = "id-image"></d></h4>
      </div>
      <div class="video-manager">       
      </div>
      <div class="modal-footer">
        <div class="col-md-8">
          <!-- <p align="left">Upload or Select file</p> -->
          <div class="row">
            <div class="col-md-5">
              <input id = 'videofiles' type = "file">
            </div>
            <div class="col-md-5">
              <button class = "upload-vid btn btn-success" style = "padding:2px 10px;"><d class="uploadlabel"> Upload </d><img class = "loader" src="assets/img/loader.gif"></button>
            </div>
          </div>
        </div>
        <div class="col-md-4 c-insert">
          <button class = "btn btn-primary btn-insert" data-dismiss="modal" style = "padding:2px 10px; display:none;" >Insert</button>
        </div>
        <div class="col-md-12 c-copy pad-0" style = "display:none">
          <div class="col-md-9 pad-0">
          <input type = "text" class = "pathtocopy fullwidth">
          </div>
          <div class="col-md-3 pad-0">
          <button style = "padding:2px 10px;" class = "btn btn-primary btn-insert-video">Insert Video</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!--Image Modal -->
<div class="modal fade" id="select-thumbnail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Image Manager <d style = "display:none" class = "id-image"></d></h4>
      </div>
      <div class="file-manager">       
      </div>
      <div class="modal-footer">
        <div class="col-md-8">
          <!-- <p align="left">Upload or Select file</p> -->
          <div class="row">
            <div class="col-md-5">
              <input id = 'imgfiles' type = "file">
            </div>
            <div class="col-md-5">
              <button class = "upload btn btn-success" style = "padding:2px 10px;"><d class="uploadlabel"> Upload </d><img class = "loader" src="assets/img/loader.gif"></button>
            </div>
          </div>
        </div>
        <div class="col-md-4 c-insert">
          <button class = "btn btn-primary btn-insert" data-dismiss="modal" style = "padding:2px 10px; display:none;" >Insert</button>
        </div>
        <div class="col-md-12 c-copy pad-0" style = "display:none">
          <div class="col-md-9 pad-0">
          <input type = "text" class = "pathtocopy fullwidth">
          </div>
          <div class="col-md-3 pad-0">
          <button style = "padding:2px 10px;" class = "btn btn-primary btn-insert-thumbnail">Insert Image</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-select-article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "overflow:hidden">
      <div class="modal-header modal-head">
        <button type="button" class="close modal-close btn-close btn-prev-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select Page</h4>
      </div>
      <div class="modal-body" style = "font-size:10px; padding:0px 10px; height:300px; overflow-y:scroll"> 
        <div class="table-responsive">
        <table class = "table list-select-articles">
          <thead>
          <tr>
           <th> Menu Title </th>
           <th> Alias </th>
          </tr>
          </thead>
          <tbody class = "list-articles">

          </tbody>

        </table>
        </div>
       
      </div>
      <div class="modal-footer" style = "border:0px">
          <button class = "btn btn-primary btn-close" data-dismiss="modal" style = "padding:2px 10px;" >Close</button>
  
      </div>
    </div>
  </div>
</div>


  <style>
.next, .prev{
  cursor: pointer;
}
  }
  </style>

<script type="text/javascript">


 $('.btn-close').click(function(){
      $('.article_list').click();
      setTimeout(function(){
        $('#success-modal').modal('hide');
      },1000);
     });

     $('.article_list').click(function(){});
$(document).on('click', '.btn-close', function(){
      // $('.article_list').click();
      
        $('#success-modal').modal('hide');
    
     });


</script>

