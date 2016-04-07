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

    // Remove salesforce default styles 
        // console.log('removed Salesforce default styles');
        // $("link.user").each(function(){
           
        //    $(this).remove();
        //  });

    
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
        $Chattertoggle.find('.indica