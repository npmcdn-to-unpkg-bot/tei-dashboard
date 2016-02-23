$(document).ready(function() {
    console.log('Case Details Script running....');

    /*Remove salesforce default styles */
    console.log('removed Salesforce default styles');
    $("link.user").each(function(){
       // $(this).attr("disabled", "disabled");
       $(this).remove();
     });
    
    /*Variables */
    var $Chattertoggle =  $( '#Chattertoggle'),
        $ChatterHeading = $Chattertoggle.parent().parent(),
        $chatterbox = $('#chatterbox'),
        $Attachtoggle = $('#Attachtoggle'),
        $attachbox = $('#attachbox');
      

   
   /* enable toggle*/
   $Chattertoggle.on('click', function(e){
        e.preventDefault();
        $chatterbox.collapse('toggle');
        $Chattertoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    });
   $Attachtoggle.on('click', function(e){
      e.preventDefault();
      $attachbox.collapse('toggle');
      $Attachtoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
   });
  
    //check to see if coming from hash and show  chatterbox
    if (window.location.hash == '#chatter') {
      $chatterbox.collapse('show');
      $Chattertoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    if (window.location.hash == '#attachments') {
      $attachbox.collapse('show');
      $Attachtoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    
	/* Check if in iframe */
	 function inIframe () {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    }
    console.log("inIframe is " + inIframe());
    if (!inIframe()){
        // alert('page not inside iframe');
        //SHOW PAGE FOR TESTING -- COMMENT THIS OUT FOR LIVE

	
        window.location.replace('https://logintei.staging.wpengine.com/?return_url='+encodeURIComponent(window.location.href));
        // $('.main-container').show();
    } else {
        $('.main-container').show();
    }

    /* Hire Button confirm dialog - NEEDS TO BE MODAL */
    $('.btn-hire').on('click', function(event) {
      event.preventDefault();
      var addressValue = $(this).attr("href");
            
      // swal({   
      //     title:  "Select this expert?",   
      //     text: "",   
      //     // type: "warning",   
      //     showCancelButton: true,   
      //     confirmButtonColor: "#5cb85c",   
      //     confirmButtonText: "Yes",   
      //     closeOnConfirm: true 
      // }, function(){   
      //     alert('you selected this expert and are going to: ' + addressValue);
      //   });

      var r = confirm("Select this Expert?");
      if (r === true) {
          window.location.replace(addressValue);
      }
    });
    


});