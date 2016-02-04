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
        $chatterbox = $('#chatterbox');
        
    //space collapsed chatterheading 
    $ChatterHeading.css('margin-bottom', '60px');
   
   /* enable toggle*/
   $Chattertoggle.on('click', function(e){
        e.preventDefault();
        $('#chatterbox').collapse('toggle');
    });
  
    //check to see if coming from hash and show  chatterbox
    if (window.location.hash == '#chatter') {
      $chatterbox.collapse('show');
    }
  
    // toggle icon based on chatterbox collapse
    function toggleChevron(e) {
        $('.indicator')
          .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    $chatterbox.on('hidden.bs.collapse', toggleChevron);
    $chatterbox.on('shown.bs.collapse', toggleChevron);


});