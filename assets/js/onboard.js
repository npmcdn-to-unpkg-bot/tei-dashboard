'use-strict';

$(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        margin: 15,
        autoHeight:false,
        onInitialized: counter,
        onTranslated : counter //When the translation of the stage has finished.
    });
    var showOnboard = localStorage.getItem('showOnboard');

    if((showOnboard == "true") || (showOnboard == null)){        
        showOnboarding();    
    };
    
    function showOnboarding() {

        $obModal=$('#onboardModal');
        $obModal.modal('toggle');
        $obModal.on("show", function () {
          $("body").addClass("modal-open");
        }).on("hidden", function () {
          $("body").removeClass("modal-open")
        });
    }
    function counter(event) {
        var $title = $('.onboard-modal-title');
        var $stepText = $('.onboard-step-description');
        var element   = event.target;         // DOM element, in this example .owl-carousel
        var items     = event.item.count;     // Number of items
        var item      = event.item.index + 1;     // Position of the current item
        
        switch(item){           
            case 1:
                $title.html('Welcome to Your Dashboard');
                $stepText.html('<p>At a glance, see your open / closed cases, case activity, and conference calls</p>'+                               '<p>The left sidebar lets you switch between tasks</p>');
                break;
            case 2:
                $title.html('Submit a New Case');
                $stepText.html('<p>You can submit a new inquiry directly to our Research Team</p>');
                break;
            case 3:
                $title.html('View Case Details');
                $stepText.html('<p>After selecting a case, this page allows you to upload documents, message your researcher, view expert responses, hire experts, and request conference calls</p>');
                break;
            case 4:
                $title.html('Schedule Conference Calls');
                $stepText.html('<p>You can set blocks of time that you have available for conference calls, \'Your Availability\' applies these times to all future conference calls.</p>');
                break;
            default:
                break;
        }      
    }
    /* Handle onboarding opt out */
    $('#onboardOptOut').change(function(event) {
        if(this.checked){
            localStorage.setItem('showOnboard', false);
        } else {
            localStorage.setItem('showOnboard', true);
        }
    });

});