$(document).ready(function() {
    console.log('Case Intake Script running....');


    //init iframe 
    window.iFrameResizer = {
      readyCallback: function(){
        //hide loader 
       console.log('iframe loaded');
       window.parentIFrame.sendMessage('loading-hide');
      },
      messageCallback: function(message){
        console.dir(message);

      }
    };

    //on page change - show loader
    $(window).on('beforeunload ',function() { 
      if('parentIFrame' in window) {
        window.parentIFrame.sendMessage('loading-show');
      }    
    }); 
    //hide account access badge 
    $('#AccountAccess').hide();

    /*Variables */
    var $Chattertoggle =  $( '#Chattertoggle'),
        $ChatterHeading = $Chattertoggle.parent().parent(),
        $chatterbox = $('#chatterbox')
        
    //space collapsed chatterheading 
    $ChatterHeading.css('margin-bottom', '60px');
   
   /* enable toggle*/
   $Chattertoggle.on('click', function(e){
        e.preventDefault();
        $chatterbox.collapse('toggle');
        $Chattertoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    });
  
    //check to see if coming from hash and show  chatterbox
    if (window.location.hash == '#chatter') {
      $chatterbox.collapse('show');
      $Chattertoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }   

     $("a:not(#Chattertoggle,.tipsLink)").attr("target","_self").on('click', function(e){
        if('parentIFrame' in window) {
          window.parentIFrame.sendMessage('loading-show');
        }    

    });

     // show loader for any links to Case Details
     var CDPageLinks =$('a[href*="https://theexpertinstitute.secure.force.com/Client/ClientCaseDetail"]');

       CDPageLinks.click(function(event) {
         if('parentIFrame' in window) {
           window.parentIFrame.sendMessage('loading-show');
         }    
       });

     

});