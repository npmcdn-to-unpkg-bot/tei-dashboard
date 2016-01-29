/**
 * Theme functions file.
 *
 * 
 */

(function($) {
    'use strict';
    /*Initialize*/
    console.log('tei-dashboard scripts running....');

    var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below
    var $iframe = $('iframe');
    /*iFrameResizer plugin*/
    $iframe.iFrameResize({
        checkOrigin: false,
        heightCalculationMethod: isOldIE ? 'max' : 'lowestElement',
        log: true, // Enable console logging
        enablePublicMethods: true, // Enable methods within iframe hosted page
        inPageLinks: true,
        resizedCallback: function(messageData) { // Callback fn when resize is received
            console.log('RESIZE MESSAGE: ');
            console.dir(messageData);
            // $('p#callback').html(
            //     '<b>Frame ID:</b> ' + messageData.iframe.id +
            //     ' <b>Height:</b> ' + messageData.height +
            //     ' <b>Width:</b> ' + messageData.width +
            //     ' <b>Event type:</b> ' + messageData.type
            // );

        },
        messageCallback: function(messageData) { // Callback fn when message is received
            console.log('CALLBACK MESSAGE:');

            $('p#callback ').text(
                // '<b>Frame ID:</b> ' + messageData.iframe.id +
                // ' <b>Message:</b> ' + messageData.message

                JSON.stringify(messageData.message)
            );

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
