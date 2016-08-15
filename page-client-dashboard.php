<?php 
/*
Template Name: Dashboard - Main Page
*/


$user_id= get_current_user_id();
$user_info = get_userdata($user_id);      
$role=$user_role->roles[0];
$site_url=site_url();
$return_url=$_GET['redirect_url'];

$wp=1;
if (($site_url=="https://logintei.staging.wpengine.com")||($site_url=="http://logintei.staging.wpengine.com")){$wp=0;}
if (($site_url=="https://login.theexpertinstitute.com")||($site_url=="http://login.theexpertinstitute.com")){$wp=1;}


$site_url=site_url();

/* If user not logged in with ID, Redirect to home */
if ($user_id==""){ ?>
    <META http-equiv="refresh" content="0;URL=<? echo $site_url; ?>">
 <?php   die();}

get_header(); ?>
<?php 




  global $current_user;
  get_currentuserinfo();
  $user_id= get_current_user_id();
  $user_info= get_userdata($user_id);
  $field_meta="user_".$user_id;
  $id_sf= get_field('id_sf_contact', $field_meta);
  $cid= get_field('cid', $field_meta);
  
  $url_frame="https://theexpertinstitute.secure.force.com/Client/ClientDashboard?IDU=$id_sf&WP=$wp";
  
  if ($return_url!='')
  {$url_frame=$return_url;}
?>

  <!-- DASHBOARD CONTENT  -->
    <div class="content-wrap dnl-visible content-opacity" data-effect="dnl-overlay" >
      <div class="container-fluid">
        <div id="content">
            <p id="callback"></p>

              <iframe id="salesforce-content" src="<? echo $url_frame; ?>" frameborder="0" scrolling="no" name="MainIframe">
            <p>Your browser does not support iframes.</p>
             </iframe>
        </div>

      </div>
    </div> <!-- /.content-wrap -->

    <!-- Onboard Modal -->

    <!-- Modal -->
    <div class="modal right fade onboard-modal" id="onboardModal" tabindex="-1" role="dialog" aria-labelledby="onboardModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

<!--           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
          </div> -->

          <div class="modal-body">
            <div class="row">
              <div class="_col-sm-12">
                <div class="owl-carousel owl-theme">
                  <!--                Slide 1 - Intro  -->
                  <div class="walkthrough-slide">
                    <div class="item-image-container">
                      <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470857602/cdn/dashboard-onboarding/main-step1.jpg" class="img-responsive" alt="First slide" />
                    </div>
                    <div class="item-text-container">
                      <h4 class="onboard-modal-title">Welcome!</h4>
                      <div class="item-text onboard-step-description"></div>
                    </div>
                  </div>
                  <!--                Slide 2 - New Case -->
                  <div class="walkthrough-slide">
                    <div class="item-image-container">
                      <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470859790/cdn/dashboard-onboarding/main-step2.jpg" class="img-responsive" alt="Second slide" />
                    </div>
                    <div class="item-text-container">
                      <h4 class="onboard-modal-title">New Case</h4>
                      <div class="item-text onboard-step-description"></div>
                    </div>
                  </div>
                  <!--                Slide 3 - Case Detail -->
                  <div class="walkthrough-slide">
                    <div class="item-image-container">
                      <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470862192/cdn/dashboard-onboarding/case-detail-animation.gif" class="img-responsive" alt="Third slide" />
                    </div>
                    <div class="item-text-container">
                      <h4 class="onboard-modal-title">Case Details</h4>
                      <div class="item-text onboard-step-description"></div>
                    </div>
                  </div>
                  <!--                Slide 4 - Schedule -->
                  <div class="walkthrough-slide">
                    <div class="item-image-container">
                      <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470862458/cdn/dashboard-onboarding/main-step-schedule.jpg" class="img-responsive" alt="Fourth slide" />
                    </div>
                    <div class="item-text-container">
                      <h4 class="onboard-modal-title">Schedule Calls</h4>
                      <div class="item-text onboard-step-description"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div data-dismiss="modal" aria-label="Close" class="btn btn-block btn-default btn-onboard">Get Started</div>
                <div class="checkbox">
                  <label><input id="onboardOptOut" type="checkbox" value="">Don't Show This Again</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- modal-content -->
      </div>
      <!-- modal-dialog -->
    </div>
    <!-- modal -->



    <!-- end of page scripts -->

<?php wp_footer(); ?>
</body>
</html>
 