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
      
        $ChatterHeading.css('margin-bottom', '82px');

   
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
    


    /* Hire Button confirm dialog - NEEDS TO BE MODAL */
    $('.btn-hire').on('click', function(event) {
      event.preventDefault();
      var addressValue = $(this).attr("href");

      var r = confirm("Select this Expert?");
         if (r === true) {

         var overlayMsg = "Selecting Expert.....";
         var overlay = jQuery('<div id="status-overlay" class="text-center"><h2 class="overlay-message">' + overlayMsg + '</h2></div>');

         overlay.appendTo(document.body);
         overlay.toggleClass('show');

         //relocate to hired expert
          window.location.replace(addressValue);
         console.log(addressValue);
      }
    });

    /* Modal on conf call */
    $('.btn-default').click(function(e){
        var overlayMsg = "Loading Conference Call Scheduler";
        var overlay = jQuery('<div id="status-overlay" class="text-center"><h2 class="overlay-message">' + overlayMsg + '</h2></div>');
        overlay.appendTo(document.body);

        overlay.toggleClass('show');

        $(this).fadeOut();
    });


});