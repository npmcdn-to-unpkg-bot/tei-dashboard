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
    showOnboarding();
    function showOnboarding() {
        $obModal=$('#onboardModal');
        $obModal.modal('toggle');
        $obModal.on("show", function () {
          $("body").addClass("modal-open");
          $('.content-wrap').click(function(e){
            alert(e.target);
          })
        }).on("hidden", function () {
          $("body").removeClass("modal-open")
        });
    }
    function counter(event) {
        var $title = $('#onboard-modal-title');
        var $subtitle = $('.onboard-modal-subtitle');
        var $stepText = $('.onboard-step-description');
        var element   = event.target;         // DOM element, in this example .owl-carousel
        var items     = event.item.count;     // Number of items
        var item      = event.item.index + 1;     // Position of the current item
        
        switch(item){           
            case 1:
                $title.html('Welcome to Your Dashboard');
                $subtitle.html('This quick tour will show a few of the ways you can use the dashboard');
                $stepText.html('<p>The dashboard summary gives you an overview of your open / closed cases, case activity, and conference calls</p>'+                               '<p>The left sidebar lets you switch between tasks</p>');
                break;
            case 2:
                $title.html('Submit a New Case');
                $subtitle.html('Submit a new inquiry directly to our Research Team');
                $stepText.html('<p>submit away</p>');
                break;
            case 3:
                $title.html('View Case Details');
                $subtitle.html('All actions related a case');
                $stepText.html('<p>The Case Detail page allows you to upload documents, message your researcher, view expert responses, hire experts, and schedule conference calls</p>');
                break;
            case 4:
                            $title.html('Schedule Conference Calls');
                $subtitle.html('Eliminate scheduling conflicts');
                $stepText.html('<p>You can set blocks of time that you have available for conference calls</p>');
                break;
            default:
                break;
        }      
    }

});