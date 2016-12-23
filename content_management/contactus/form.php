
<div class="row">

	<div class="col-md-12">

    <div class="col-md-12 pad-10"><label> SMTP Mail Settings </label></div>

		<div class="col-md-12 pad-5">
      <div class="col-md-2"><p>SMTP Host:</p></div>
      <div class="col-md-10"><input type = "text" name = "smtphost" class = "smtphost"></div>
       <div class="col-md-10"><input type = "hidden" name = "smtp_id" class = "smtp_id"></div>
    </div>

    <div class="col-md-12 pad-5">
      <div class="col-md-2"><p>SMTP Port:</p></div>
      <div class="col-md-10"><input type = "text" name = "smtpport" class = "smtpport"></div>
    </div>

    <div class="col-md-12 pad-5">
      <div class="col-md-2"><p>SMTP Username:</p></div>
      <div class="col-md-10"><input type = "text" name = "smtpusername" class = "smtpusername"></div>
    </div>

    <div class="col-md-12 pad-5">
      <div class="col-md-2"><p>SMTP Password:</p></div>
      <div class="col-md-10"><input type = "password" name = "smtppassword" class = "smtppassword"></div>
    </div>

    <div class="col-md-12 pad-5">
      <div class="col-md-2"><p>Mail Recipient:</p></div>
      <div class="col-md-10"><input type = "text" name = "mailrecipient" class = "mailrecipient"></div>
    </div>

    <div class="col-md-12 pad-5">
      <div class="col-md-2"></div>
      <div class="col-md-10"><button class = "btn btn-primary btn-host">Submit</button></div>
    </div>




	</div>

</div>


<script type="text/javascript">
  
get_data();
function get_data(){

    $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=get_host',
        data:{},
      }).done( function(data){
              var obj = JSON.parse(data);
          $.each(obj, function(index, row){ 
        $('.smtp_id').val(row.id);
        $('.smtphost').val(row.smtp_host);
        $('.smtpport').val(row.smtp_port);
        $('.smtpusername').val(row.smtp_username);
        $('.smtppassword').val(row.smtp_password);
        $('.mailrecipient').val(row.mailrecipient);

        });
          
     }); 
  }

  $('.btn-host').click(function(){
        var smtp_id = $('.smtp_id').val();
        var smtphost = $('.smtphost').val();
        var smtpport = $('.smtpport').val();
        var smtpusername = $('.smtpusername').val();
        var smtppassword = $('.smtppassword').val();
        var mailrecipient = $('.mailrecipient').val();
       $.ajax({
        type: 'Post',
        url: 'dashboard.php?function=update_host',
        data:{smtphost:smtphost, smtpport: smtpport, smtpusername: smtpusername, smtppassword:smtppassword , id: smtp_id, mailrecipient: mailrecipient },
      }).done( function(data){
        $('.msg').html('<p>Successfully Saved...</p>');
            $('#success-modal').modal('show');
        get_data();
         });
  });

</script>