/**
 * Theme functions file.
 *
 * 
 */

(function($) {
    'use strict';
    /*Initialize*/
    console.log('tei-dashboard scripts running....');


    /* Login / Register switcher */
    $('.register-switch').click(function(e){
        e.preventDefault();
        $('#login-form').toggleClass('hidden');
        $('#register-form').toggleClass('hidden');
    });

    /* check for old IE versions */
    var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below
    

    /*iFrameResizer plugin*/
    var $iframe = $('iframe#salesforce-content');
    $iframe.iFrameResize({
        checkOrigin: false,
        heightCalculationMethod: isOldIE ? 'max' : 'lowestElement',
        log: true, // Enable console logging
        enablePublicMethods: true, // Enable methods within iframe hosted page
        inPageLinks: true,
        readyCallback: function(){
            console.log('iframe ready');
        },
        resizedCallback: function(messageData) { // Callback fn when resize is received
            console.log('RESIZE MESSAGE: ');
            console.dir(messageData);

            // $('p#callback').html(

                // '<b>Frame ID:</b> ' + messageData.iframe.id +
                // ' <b>Height:</b> ' + messageData.height +
                // ' <b>Width:</b> ' + messageData.width +
                // ' <b>Event type:</b> ' + messageData.type
            // );

        },
        messageCallback: function(messageData) { // Callback fn when message is received
            console.log('CALLBACK MESSAGE:');
            console.dir(messageData.message);
            window.dashboardStatus = messageData.message;
            $('.open-cases-badge').html(dashboardStatus.CountOpen);
            $('.closed-cases-badge').html(dashboardStatus.CountClosed);
            $('.calls-badge').html(dashboardStatus.CountCalls);
            
            $('p#callback').html(
                messageData.message
                // '<b>Frame ID:</b> ' + messageData.iframe.id +
                // ' <b>Height:</b> ' + messageData.height +
                // ' <b>Width:</b> ' + messageData.width +
                // ' <b>Event type:</b> ' + messageData.type
            );
            // $('p#callback ').text(
                // '<b>Frame ID:</b> ' + messageData.iframe.id +
                // ' <b>Message:</b> ' + messageData.message

                // JSON.stringify(messageData.message)
            // );

            // alert('callback' + messageData.message);

        },
        closedCallback: function(id) { // Callback fn when iFrame is closed
            // $('p#callback').html(
            //     '<b>IFrame (</b>' + id +
            //     '<b>) removed from page.</b>'
            // );

        }
    });


})(jQuery);
