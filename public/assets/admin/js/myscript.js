(function($) {
		"use strict";
		
	$(document).ready(function() {


function disablekey()
{


 document.onkeydown = function (e) 
 {
  return false;
 }
}

function enablekey()
{
 document.onkeydown = function (e) 
 {
  return true;
 }
}

// **************************************  AJAX REQUESTS SECTION *****************************************
  // Status Start
      $(document).on('click','.status',function () {
        var link = $(this).attr('data-href');
            $.get( link, function(data) {
              }).done(function(data) {
                  table.ajax.reload();
                  $('.alert-danger').hide();
                  $('.alert-success').show();
                  $('.alert-success p').html(data);
            })
          });
  // Status Ends


  // Active Start
      $(document).on('change','.jew-check.switch input',function () {
          $.get( $(this).attr('data-href'), function(data) {
              table.ajax.reload();
          });
      });
  // Active Ends

  // Display Subcategories
      $(document).on('change','#cat',function () {
        var link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
          $('#subcat').load(link);
          $('#subcat').prop('disabled',false);
        }
      });
  // Display Subcategories Ends

  // Display Subcategories
      $(document).on('change','#subcat',function () {
        var link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
          $('#childcat').load(link);
          $('#childcat').prop('disabled',false);
        }
      });
  // Display Subcategories Ends

  // Droplinks Start
      $(document).on('change','.droplinks',function () {

        var link = $(this).val();
        var data = $(this).find(':selected').attr('data-val');
        if(data == 0)
        {
          $(this).next(".nice-select.process.select.droplinks").removeClass("drop-success").addClass("drop-danger");
        }
        else{
          $(this).next(".nice-select.process.select.droplinks").removeClass("drop-danger").addClass("drop-success");
        }
        $.get(link);
        $.notify("Status Updated Successfully.","success");
      });


      $(document).on('change','.vdroplinks',function () {

        var link = $(this).val();
        var data = $(this).find(':selected').attr('data-val');
        if(data == 0)
        {
          $(this).next(".nice-select.process.select1.vdroplinks").removeClass("drop-success").addClass("drop-danger");
        }
        else{
          $(this).next(".nice-select.process.select1.vdroplinks").removeClass("drop-danger").addClass("drop-success");
        }
        $.get(link);
        $.notify("Status Updated Successfully.","success");
      });

      $(document).on('change','.data-droplinks',function (e) {
          $('#confirm-delete').modal('show');
          $('#confirm-delete').find('.btn-ok').attr('href', $(this).val());
          table.ajax.reload();
        });

      $(document).on('change','.vendor-droplinks',function (e) {
          $('#confirm-delete1').modal('show');
          $('#confirm-delete1').find('.btn-ok').attr('href', $(this).val());
          table.ajax.reload();
        });


  // Droplinks Ends



// ADD OPERATION

$(document).on('click','#add-data',function(){
  $('.submit-loader').show();
  $('script.load-js').remove();
  $('#modal1').find('.modal-title').html('ADD NEW '+$('#headerdata').val());
  $('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success"){
        $.getScript(mainurl+'/assets/admin/js/load.js')
        $('.submit-loader').hide();
      }
      
    });
});

// ADD OPERATION END



// EDIT OPERATION

$(document).on('click','.edit',function(){
  $('.submit-loader').show();
   $('script.load-js').remove();
  $('#modal1').find('.modal-title').html('EDIT '+$('#headerdata').val());
  $('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success"){
        $.getScript(mainurl+'/assets/admin/js/load.js')
        $('.submit-loader').hide();
      }
    });
});


// EDIT OPERATION END


// FEATURE OPERATION

$(document).on('click','.feature',function(){
  $('.submit-loader').show();
  $('script.load-js').remove();
  $('#modal2').find('.modal-title').html($('#headerdata').val()+' Highlight');
  $('#modal2 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success"){
        $.getScript(mainurl+'/assets/admin/js/load.js')
        $('.submit-loader').hide();
      }
    });
});


// EDIT OPERATION END


// SHOW OPERATION

$(document).on('click','.view',function(){
  $('.submit-loader').show();
  $('script.load-js').remove();
  $('#modal1').find('.modal-title').html($('#headerdata').val()+' DETAILS');
  $('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success"){
        $.getScript(mainurl+'/assets/admin/js/load.js')
        $('.submit-loader').hide();
      }
    });
});


// SHOW OPERATION END

// ADD / EDIT FORM SUBMIT FOR DATA TABLE
setTimeout(function(){
  $('[id="sn-checkbox-open-in-new-window"]').each(function(i){  $(this).attr('id', $(this).attr('id')+(i+1)); });
}, 1000);

$(document).on('submit','#geniusformdata',function(e){
  e.preventDefault();
  $('.submit-loader').show();
  $('button.addProductSubmit-btn').prop('disabled',true);
  disablekey();
  
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('#error .alert-danger').show();
          $('#error .alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('#error .alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
            $('.submit-loader').hide();
            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            table.ajax.reload();
            $('#success .alert-success').show();
            $('#success .alert-success p').html(data);
            $('.submit-loader').hide();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2').modal('toggle');

           }
          enablekey();
       }

      });

});


// ADD / EDIT FORM SUBMIT FOR DATA TABLE ENDS



// DELETE OPERATION

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

      $('#confirm-delete .btn-ok').on('click', function(e) {
        if($('#confirm-delete .btn-ok').hasClass("order-btn")){
          $('.submit-loader').show();
        }
        $.ajax({
         type:"GET",
         url:$(this).attr('href'),
         success:function(data)
         {
              $('#confirm-delete').modal('toggle');
              table.ajax.reload();
              $('.alert-danger').hide();
              $('.alert-success').show();
              $('.alert-success p').html(data);

              if($('#confirm-delete .btn-ok').hasClass("order-btn")){
                $('.submit-loader').hide();
              }
              
         }
        });
        return false;
      });

      $('#confirm-delete1 .btn-ok').on('click', function(e) {

        $.ajax({
         type:"GET",
         url:$(this).attr('href'),
         success:function(data)
         {
              $('#confirm-delete1').modal('toggle');
              table.ajax.reload();
              $('.alert-danger').hide();
              $('.alert-success').show();
              $('.alert-success p').html(data);
         }
        });
        return false;
      });

// DELETE OPERATION END

	});



// NORMAL FORM

$(document).on('submit','#geniusform',function(e){
  e.preventDefault();
  $('.gocover').show();
  $('button.addProductSubmit-btn').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('#form-both .alert-success').hide();
          $('#form-both .alert-danger').show();
          $('#form-both .alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('#form-both .alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#geniusform input , #geniusform select , #geniusform textarea').eq(1).focus();
          }
          else
          {
            $('#form-both .alert-danger').hide();
            $('#form-both .alert-success').show();
            $('#form-both .alert-success p').html(data);
            $('#geniusform input , #geniusform select , #geniusform textarea').eq(1).focus();
          }
          $('.gocover').hide();
          $('button.addProductSubmit-btn').prop('disabled',false);
       }

      });

});  

// NORMAL FORM ENDS


// MESSAGE FORM

$(document).on('submit','#messageform',function(e){
  e.preventDefault();
  var href = $(this).data('href');
  $('.gocover').show();
  $('button.mybtn1').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#messageform textarea').val('');
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('#messageform textarea').val('');
            $('#messages').load(href);
          }
          $('.gocover').hide();
          $('button.mybtn1').prop('disabled',false);
       }
      });
});  

// MESSAGE FORM ENDS


// LOGIN FORM

$("#loginform").on('submit',function(e){
  e.preventDefault();
  $('button.submit-btn').prop('disabled',true);
  $('.alert-info').show();
  $('.alert-info p').html($('#authdata').val());
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-info').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger p').html(data.errors[error]);
            }
          }
          else
          {
            $('.alert-info').hide();
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html('Success !');
            window.location = data;
          }
          $('button.submit-btn').prop('disabled',false);
       }

      });

});  


// LOGIN FORM ENDS


// FORGOT FORM

$("#forgotform").on('submit',function(e){
  e.preventDefault();
  $('button.submit-btn').prop('disabled',true);
  $('.alert-info').show();
  $('.alert-info p').html($('#authdata').val());
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-info').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger p').html(data.errors[error]);
            }
          }
          else
          {
            $('.alert-info').hide();
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('input[type=email]').val('');
          }
          $('button.submit-btn').prop('disabled',false);
       }

      });

});  


// FORGOT FORM ENDS


// ORDER NOTIFICATION

$(document).ready(function(){
    setInterval(function(){
            $.ajax({
                    type: "GET",
                    url:$("#order-notf-count").data('href'),
                    success:function(data){
                        $("#order-notf-count").html(data);
                      }
              }); 
    }, 5000);
});

$(document).on('click','#notf_order',function(){
  $("#order-notf-count").html('0');
  $('#order-notf-show').load($("#order-notf-show").data('href'));
});

$(document).on('click','#order-notf-clear',function(){
  $(this).parent().parent().trigger('click');
  $.get($('#order-notf-clear').data('href'));
});

// ORDER NOTIFICATION ENDS



// SEND MESSAGE SECTION
$(document).on('click','.send',function(){
  $('.eml-val').val($(this).data('email'));
});

          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var to = $(this).find('input[name=to]').val();
          $('#eml1').prop('disabled', true);
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
            $.ajax({
            type: 'post',
            url: mainurl+'/admin/user/send/message',
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'to'   : to
                  },
                 success: function( data) {
                  $('#eml1').prop('disabled', false);
                  $('#subj1').prop('disabled', false);
                  $('#msg1').prop('disabled', false);
                  $('#subj1').val('');
                  $('#msg1').val('');
                  $('#emlsub1').prop('disabled', false);
                  if(data == 0)
                    $.notify("Oops Something Goes Wrong !!","error");
                  else
                    $.notify("Message Sent !!","success");
                  $('.close').click();
            }
        });          
          return false;
        });

// SEND MESSAGE SECTION ENDS



// SEND EMAIL SECTION

          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var to = $(this).find('input[name=to]').val();
          $('#eml').prop('disabled', true);
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: mainurl+'/admin/order/email',
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'to'   : to
                  },
            success: function( data) {
          $('#eml').prop('disabled', false);
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        if(data == 0)
        $.notify("Oops Something Goes Wrong !!","error");
        else
        $.notify("Email Sent !!","success");
        $('.close').click();
            }

        });          
          return false;
        });
// SEND EMAIL SECTION ENDS


// **************************************  AJAX REQUESTS SECTION ENDS *****************************************


})(jQuery);