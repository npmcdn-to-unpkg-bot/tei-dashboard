$(document).ready(function() {
    console.log('Case Intake Script running....');

    //hide account access badge 
    $('#AccountAccess').hide();

    // Remove salesforce default styles 
        // console.log('removed Salesforce default styles');
        // $("link.user").each(function(){
           
        //    $(this).remove();
        //  });
    
    //check if running inside iframe 
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
        window.location.replace("https://logintei.staging.wpengine.com");
        $('.main-container').show();
    } else {
        $('.main-container').show();
    }
    
    




    

    
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

});