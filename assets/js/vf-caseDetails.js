$(document).ready(function() {
    console.log('Case Details Script running....');

    //init iframe 
    window.iFrameResizer = {
      readyCallback: function(){  
          if('parentIFrame' in window) {
           window.parentIFrame.sendMessage('loading-hide');

          }  
           
      },
      messageCallback: function(message){
        console.dir(message);
        if (message.action ==  'HIRE'){
            hireExpert(message.expertURL);
        }
      }
    };

    //on page change - show loading 
    $(window).on('beforeunload ',function() { 
      if('parentIFrame' in window) {
        window.parentIFrame.sendMessage('loading-show');
      }    
    }); 


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
      
        $ChatterHeading.css('margin-bottom', '40px');

   
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
    //check has for #slected-expert
    if (window.location.hash == 'selected') {

        $('.EID').prepend('<div id="selected-expert">SELECTED</div>');
    }
    


    /* Hire Button confirm dialog */
    $('.btn-hire').on('click', function(event) {
      event.preventDefault();
      var addressValue = $(this).attr("href");

      
      if('parentIFrame' in window) {
        var hireOBJ = {
          title: 'Retain This Expert?',
          action: 'showHireAlert',
          content: 'By clicking \'OK\' you are choosing to retain this expert for your case',
          expertURL: addressValue          

        }
        window.parentIFrame.sendMessage(hireOBJ);
      }

    });

    // HIRE FUNCTION 
    function hireExpert(address){
        window.location.replace(address);
    }
});