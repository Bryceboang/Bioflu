<?php  require_once dirname(__FILE__) . '/login/session.php'; ?>

<?php  require_once dirname(__FILE__) . '/layout/header.php'; ?>

<?php
if (isset($_POST['submit'])) {
  //echo "asd";
  if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
    //echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
    //echo "<h2>Displaying contents:</h2>";
    //readfile($_FILES['filename']['tmp_name']);
  }

  //Import uploaded file to Database
  $handle = fopen($_FILES['filename']['tmp_name'], "r");

  /*print_r(fgetcsv($handle, 1000, ","));*/

  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    //$import="INSERT into testing_tbl(item1,item2,item3) values('$data[0]','$data[1]','$data[2]')";
    //mysql_query($import) or die(mysql_error());
    echo "<pre>";
    print_r($data);
  }

  fclose($handle);

  //print "Import done";

  //view upload form
}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



  <div class="row">



    <?php  require_once dirname(__FILE__) . '/menu.php'; ?>



    <div class="col-md-9 container-content">

      <div class="col-md-12 pad-0">

          <div class="row">

            <div class="col-md-12 title-header"><p> Flu Monitor - Reports - Listening Tool</p></div>

            <div class="col-md-6 btn-navigation">

              <a href = "dashboard.php?function=export_tweets&data_get=list" class="btn-export-excel btn-min btn btn-primary">Export to Excel</a>

              <a id="import-csv" class="btn-export-excel btn-min btn btn-primary">Import CSV File</a>
            </div>

            <div class="col-md-6 pagination"></div>

          <div class="col-md-12 content-container"></div>

        </div>

      </div>

    </div>

    <!-- sidebar -->

    <?php  require_once dirname(__FILE__) . '/sidebar.php'; ?>

    <!-- end sidebar -->



  </div>





</div>


<div class="modal fade" id="upload-csv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content" style = "overflow:hidden">

      <div class="modal-header modal-head">

        <button type="button" class="close modal-close" style = "color:#fff !important; opacity:10" data-dismiss="modal" aria-label="Close"><span style = "color:#fff !important; opacity:10"  aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Upload CSV File<d style = "display:none" class = "id-image"></d></h4>

      </div>


      <div class="modal-footer">

        <div class="col-md-8">

          <!-- <p align="left">Upload or Select file</p> -->
          <form enctype='multipart/form-data' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>

          <div class="row">

            <div class="col-md-5">

              <input name="filename" type = "file">

            </div>

            <div class="col-md-5">

              <!--button class = "upload btn btn-success" style = "padding:2px 10px;"><d class="uploadlabel"> Upload </d><img class = "loader" src="assets/img/loader.gif"></button-->
              <input type="submit" name="submit" value="Upload" class="btn btn-success" style = "padding:2px 10px;">
            </div>

          </div>

          </form>


        </div>


      </div>

    </div>

  </div>

</div>


<input type="hidden" id="hidden_type" value=""> 



<script type="text/javascript">

$(document).ready(function(){

  $('#import-csv').click(function() {
      $('#upload-csv').modal('show');
  })



  $('.content-container').load('flumonitor/listening_tool.php');









});



</script>