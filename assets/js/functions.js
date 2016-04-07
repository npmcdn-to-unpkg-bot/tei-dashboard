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
    // $('.register-switch').click(function(e){
    //     e.preventDefault();
    //     $('#login-form').toggleClass('hidden');
    //     $('#register-form').toggleClass('hidden');
    // });

    /* Boolean Badges */
    $('.availability-badge').hide();

    /* check for old IE versions */
    var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below
    

    /*iFrameResizer plugin*/
    var $iframe = $('iframe#salesforce-content');


    $iframe.iFrameResize({
        checkOrigin: false,
        heightCalculationMethod: isOldIE ? 'max' : 'lowestElement',
        log: false, // Enable console logging
        enablePublicMethods: true, // Enable methods within iframe hosted page
        inPageLinks: true,
        readyCallback: function(){
            console.log('iframe ready');
            alert('iframe ready');
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
            console.dir(messageData);

            /*HANDLE LOADING */
            if (messageData.message == "loading-show") {            
                $('#loading-overlay').show();
                console.log('SHOW LOADING');
            }
            if (messageData.message == "loading-hide") {                
                $('#loading-overlay').hide();
                console.log('HIDE LOADING');
            }

            /*SET BADGE COUNTS*/
            if (messageData.message.action == 'setDashboardStatus'){
                window.dashboardStatus = messageData.message;
                $('.open-cases-badge').html(dashboardStatus.CountOpen);
                $('.closed-cases-badge').html(dashboardStatus.CountClosed);
                $('.calls-badge').html(dashboardStatus.CountCalls);
                if (dashboardStatus.ContactTimeSet) {
                    $('.availability-badge').show();
                }
            }
            if (messageData.message.action == 'showHireAlert'){
                // alert(messageData.message.content);
                showHireAlert(messageData);
                
            }


        },
        closedCallback: function(id) { // Callback fn when iFrame is closed
            // $('p#callback').html(
            //     '<b>IFrame (</b>' + id +
            //     '<b>) removed from page.</b>'
            // );

        }
    });

function showHireAlert(messageData){
    swal({
            title: messageData.message.title,
            text: messageData.message.content,
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonClass: "btn-success",
            confirmButtonText: "OK",
            closeOnConfirm: true
        },
        function() {             
            console.dir(messageData);
            var confirmHireOBJ = {
                action: 'HIRE',
                expertURL: messageData.message.expertURL
            }                       
            $iframe[0].iFrameResizer.sendMessage(confirmHireOBJ);
        });
}

})(jQuery);
