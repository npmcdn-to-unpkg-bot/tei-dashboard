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
  
  $url_frame="https://theexpertinstitute.secure.force.com/NewCase/?IDU=$id_sf&NC=hidden&OC=hidden&CC=hidden&CCL=hidden&WP=$wp";
  
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


    <!-- end of page scripts -->

<?php wp_footer(); ?>
</body>
</html>
 