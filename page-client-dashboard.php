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

    <!-- Onboard tour -->
    <ul class="cd-tour-wrapper">
      <li class="cd-single-step">
        <span>Step 1</span>

        <div class="cd-more-info bottom">

          <h2>Welcome to your Dashboard Summary</h2>
          <p>At a glance, you can see the status of your open and closed cases and conference calls.</p>          
          <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470857602/cdn/dashboard-onboarding/main-step1.jpg" class="img-responsive"  alt="Welcome to your Dashboard"/>
            <div class="checkbox">
              <label><input type="checkbox" id="onboardOptOut" value=""> Hide these tips </label>
            </div>
        </div>

      </li> <!-- .cd-single-step -->

      <li class="cd-single-step">
        <span>Step 2</span>

        <div class="cd-more-info top">
          <h2>Submit a New Inquiry</h2>
          <p>You can submit a new inquiry directly to our Research Team</p>
          <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470859790/cdn/dashboard-onboarding/main-step2.jpg" class="img-responsive" alt="Submit a New Inquiry" />
        </div>
      </li> <!-- .cd-single-step -->

      <li class="cd-single-step">
        <span>Step 3</span>

        <div class="cd-more-info right">
          <h2>View Case Details</h2>
          <p>After selecting a case, this page allows you to upload documents, message your researcher, view expert responses, hire experts, and request conference calls</p>
          <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470862192/cdn/dashboard-onboarding/case-detail-animation.gif" class="img-responsive" alt="Third slide" />
        </div>
      </li> <!-- .cd-single-step -->

      <li class="cd-single-step">
        <span>Step 4</span>

        <div class="cd-more-info right">
          <h2>Schedule Conference Calls</h2>
          <p>You can set blocks of time that you have available for conference calls, 'Your Availability' applies these times to all future conference calls.</p>
          <img src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/v1470862458/cdn/dashboard-onboarding/main-step-schedule.jpg" class="img-responsive" alt="Fourth slide" />
        </div>
      </li> <!-- .cd-single-step -->
    </ul> <!-- .cd-tour-wrapper -->




    <div class="cd-cover-layer"></div>
   



    <!-- end of page scripts -->

<?php wp_footer(); ?>
</body>
</html>
 