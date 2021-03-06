$(document).ready(function() {
    console.log('Case Details Script running....');

    //init iframe 
    window.iFrameResizer = {
        readyCallback: function() {
            if ('parentIFrame' in window) {
                window.parentIFrame.sendMessage('loading-hide');
                window.parentIFrame.scrollToOffset(0, 0);

            }

        },
        messageCallback: function(message) {
            console.dir(message);
            if (message.action == 'HIRE') {
                hireExpert(message.expertURL);
            }
        }
    };

    //on page change - show loading 
    $(window).on('beforeunload ', function() {
        if ('parentIFrame' in window) {
            window.parentIFrame.sendMessage('loading-show');
            window.parentIFrame.scrollToOffset(0, 0);
        }
    });


    /*Remove salesforce default styles */
    $("link.user").each(function() {       
        $(this).remove();
    });

    /*Variables */
    var $Chattertoggle = $('#Chattertoggle'),
        $ChatterHeading = $Chattertoggle.parent().parent(),
        $chatterbox = $('#chatterbox'),
        $Attachtoggle = $('#Attachtoggle'),
        $attachbox = $('#attachbox');

    $ChatterHeading.css('margin-bottom', '40px');


    /* enable toggle*/
    $Chattertoggle.on('click', function(e) {
        e.preventDefault();
        $chatterbox.collapse('toggle');
        $Chattertoggle.find('.indicator').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    });
    $Attachtoggle.on('click', function(e) {
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

    //hide loading overlay on attachment download 
    $('a[href*="download_attachment"]').on('click', function(event) {
        event.preventDefault();
        var url = $(this).attr("href");
        window.location = url;


        setTimeout(function() {
            if ('parentIFrame' in window) {
                window.parentIFrame.sendMessage('loading-hide');
            }
        }, 1000);
    });

    /* Hire Button confirm dialog */
    $('.btn-hire').on('click', function(event) {
        event.preventDefault();
        var addressValue = $(this).attr("href");


        if ('parentIFrame' in window) {
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
    function hireExpert(address) {
        window.location.replace(address);
    }

    // show loader for links on Case Details
     $("a:not(#Chattertoggle,#Attachtoggle,.btn-hire)").attr("target","_self").on('click', function(e){
        if('parentIFrame' in window) {
          window.parentIFrame.sendMessage('loading-show');
        }    

    });
});
