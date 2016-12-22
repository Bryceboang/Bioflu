<div class="contact-label"><label><h3>CONTACT US</h3></label></div> 

<div class="col-md-12 col-sm-12 contact-container" style="background-image:url(images/assets/contact-bg.png);">
<div class="col-md-12 ">
  <label class="love-to-help">We would love to help</label>
  <p class="help-text">Take control of your symptoms and your flu. Send us your questions and we will respond to you as soon as we can.</p>
</div>
<div class="col-md-6 col-sm-6 pad-0">
<div class="col-md-12 pad-7">
    <div class="col-md-10 pad-0"><select class = "inputs subject fullwidth" >
      <option value = "" style="display:none">Inquiry Type</option>
      <option value = "product-related">Product-related</option>
      <option value = "comments">Comment</option>
      <option value = "others">Other/s</option>
    </select>
      <span class = "er-msg">Inquiry Type is required *</span>
    </div>
</div>  

<div class="col-md-12 pad-7">
  <div class="col-md-2 pad-0 lbl-text" style="margin-top: 7px;">Name:</div>
    <div class="col-md-10 pad-0"><input class = "inputs fullname form-control fullwidth" type = "text" placeholder = "Name">
      <span class = "er-msg">Name is required *</span>
    </div>
</div>

<div class="col-md-12 pad-7">
  <div class="col-md-2 pad-0 lbl-text" style="margin-top: 7px;">Email:</div>
    <div class="col-md-10 pad-0"><input class = "inputs emailaddress form-control fullwidth" type = "text" placeholder = "Email">
      <span class = "er-msg email-msg">Email is required *</span>
    </div>
</div>

<div class="col-md-12 pad-7">
  <div class="col-md-2 pad-0 lbl-text" style="margin-top: 7px;">Message:</div>
    <div class="col-md-10 pad-0"><textarea class = "inputs message form-control fullwidth" placeholder = "Message"></textarea>
      <span class = "er-msg">Message is required *</span>
    </div>
</div>

<div class="col-md-12 pad-7">
  <div class="col-md-2"></div>
  <div class="col-md-10 pad-0">
    <div class="col-md-5 pad-0">
    <!-- <button class = "btn btn-danger btn-submit fullwidth"><span class = "btn-send-caption">Send Message</span> <span class = " glyphicon glyphicon-send"></span><img class = "loader" src="images/bioflu/loader.gif"></button>
 -->     
      <button class = "btn-radius btn btn-danger btn-submit fullwidth"><span class = "btn-send-caption">SUBMIT INQUIRY</span> <img class = "loader" src="images/bioflu/loader.gif"></button>
    </div>
  </div>
</div>

</div>

</div>
<div class="contact-fb">
  <div class="fbtext">
    <p style = "margin:0px">In a hurry?</p>
    <p style = "margin:0px">Reach us through </p>
  </div>
  <div class="soc-icon">
    <a class="soc-icon-child" target="_blank" href="https://www.facebook.com/biofluofficial?fref=ts"><img src="images/assets/fb.png"><a class="soc-icon-child" target="_blank" href="https://twitter.com/BiofluOfficial"><img src="images/assets/twitter.png"></a>
  </div>
</div>

<!-- Modal -->

<div class="modal fade" id="success-sendmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
        The mail has been successfully sent.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<img class="girl-img" src="images/assets/contact-us-img.png">


<script type="text/javascript">
    $('.btn-submit').on('click', function(){
     var counter = 0; 
     var fullname = $('.fullname').val();
     var emailaddress = $('.emailaddress').val();
     var subject = $('.subject').val();
     var message = $('.message').val();

        $('.inputs').each(function(){
            var input = $(this).val();
            if (input.length == 0) {
              $(this).siblings().show();
              $('.email-msg').html('Email is required *');
              counter++;
            }else{
              $(this).siblings().hide();
            }
        });

        if(emailaddress.length != 0){     
            var val = validateEmail(emailaddress); 
            if (val == false)
            {
              $('.email-msg').show();
              $('.email-msg').html('The email you have entered is invalid');
            }else{
              if(counter == 0){
                $('.loader').show();
                $('.glyphicon-send').hide();
                $('.btn-submit').attr('disabled', true);
                $('.btn-send-caption').html('Sending ');
                  $.ajax({
                      type: 'Post',
                      url: 'modules/mod_contact_form/sendemail.php',
                      data:{fullname: fullname, emailaddress:emailaddress, subject: subject, message: message },
                    }).done( function(res){
                      $('.loader').hide();
                        $('#success-sendmail').modal();
                        $('.glyphicon-send').show();
                        $('.btn-send-caption').html('Send Message ');
                      });
              }
            }
          }

    });

    $('.modal-close').click(function(){
      location.reload();
    });

    function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
    } 
</script>