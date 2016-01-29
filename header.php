<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



/*SALESFORCE VARIABLES*/
$user_id= get_current_user_id();
$user_info= get_userdata($user_id);
$field_meta="user_".$user_id;
$id_sf= get_field('id_sf_contact', $field_meta);
$cid= get_field('cid', $field_meta);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <script src="https://use.typekit.net/wht0akz.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

    <title>The Expert Institute - Dashboard</title>
		<?php wp_head(); ?>


    <style type="text/css" media="screen">

      <?php 
        if ( is_admin() ) { ?>
             /* ADMIN BAR SPACING - REMOVE THIS */
             html { margin-top: 32px !important; }
             * html body { margin-top: 32px !important; }
             @media screen and ( max-width: 782px ) {
               html { margin-top: 0 !important; }
               *  body { margin-top: 46px !important; }
        }
       <?php } else {
             
        }

      ?>

    </style>
                
</head>
<body>

    <!-- Dash Navbar Top 
    Available versions: dnl-visible, dnl-hidden -->
    <nav class="navbar navbar-static-top dash-navbar-top dnl-visible">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dnt-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-ellipsis-v"></span>
          </button>
          <button class="dnl-btn-toggle">
            <span class="fa fa-bars"></span>
          </button>
          <a class="navbar-brand" href="<?php echo get_site_url(); ?>/client-dashboard"><img src="<?php echo get_template_directory_uri(); ?>/assets/dashboard-assets/images/login-logo-inverse.svg" alt="tei-logo" class="header-tei-logo"><span class="beta-tag hidden-xs">beta</span></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="dnt-collapse">
          <!-- This dropdown is for avatar -->
          <ul class="nav navbar-nav navbar-right navbar-avatar">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="ExpertListPic dnt-avatar" src="https://res.cloudinary.com/theexpertinstitute-com/image/upload/c_thumb,h_40,w_40/v50/contacts/<?php echo "$cid";?>.jpg" alt="<?php global $current_user; echo $current_user->user_firstname  ?>"></a>
              <ul class="dropdown-menu" role="menu">
                <!-- <li><a href="#">Standard <span>go pro</span></a></li> -->
                <!-- <li><a href="#">Upload</a></li> -->
                <!-- <li class="active"><a href="#">Active link</a></li> -->
                <li><? echo do_shortcode( '[wppb-logout]' );?></li>
              </ul>
            </li>
          </ul>
<!--           <form class="navbar-form navbar-right dnt-navbar-form" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn"><span class="fa fa-search"></span></button>
          </form>   -->
          <!-- This dropdown is for normal links -->
          <ul class="nav navbar-nav navbar-right">
            <li>
            	<a href="#">
                </a>
            </li>

            <li class="">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php global $current_user;
            		echo "$current_user->user_firstname $current_user->user_lastname";
                    get_currentuserinfo();
                	?> <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><? echo do_shortcode( '[wppb-logout]' );?></li>
<!--                 <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li> -->
              </ul>
            </li>
          </ul>        
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav> <!-- /.navbar -->


    <!-- Dash Navbar Left 
    Available versions: dnl-visible, dnl-hidden -->
    <div class="dash-navbar-left dnl-visible">
      <p class="dnl-nav-title">MAIN</p>
      <ul class="dnl-nav">
        <!-- NEW CASE -->
        <li>
          <a href="https://theexpertinstitute.secure.force.com/NewCase/?IDU=<?php echo $id_sf;?>&OC=hidden&CC=hidden&CCL=hidden" target="MainIframe">
            <span class="fa fa-file-text dnl-link-icon"></span>
            <span class="dnl-link-text">New Case</span>
          </a>
        </li>
          <!-- Open Cases -->
          <li>
          <a href="https://theexpertinstitute.secure.force.com/NewCase/?IDU=<?php echo $id_sf;?>&NC=hidden&CC=hidden&CCL=hidden" target="MainIframe">
            <span class="glyphicon glyphicon-folder-open dnl-link-icon"></span>
            <span class="dnl-link-text">Open Cases</span>
          </a>
        </li>
        <!-- Closed Cases -->
            <li>
          <a href="https://theexpertinstitute.secure.force.com/NewCase/?IDU=<?php echo $id_sf;?>&OC=hidden&NC=hidden&CCL=hidden" target="MainIframe">
            <span class="glyphicon glyphicon-folder-close dnl-link-icon"></span>
            <span class="dnl-link-text">Closed Cases</span>
          </a>
        </li>

           <li>
          <a href="https://theexpertinstitute.secure.force.com/NewCase/?IDU=<?php echo $id_sf;?>&OC=hidden&NC=hidden&CC=hidden" target="MainIframe">
            <span class="fa fa-phone dnl-link-icon"></span>
            <span class="dnl-link-text">Conference Calls</span>
          </a>
        </li>
<!--         <li>
          <a href="#">
            <span class="glyphicon glyphicon-comment dnl-link-icon"></span>
            <span class="dnl-link-text">Comments</span>
            <span class="badge">4</span>
          </a>
        </li> -->
        <li class="hidden">
          <a class="collapsed" data-toggle="collapse" href="#collapseLevelOne" aria-expanded="false" aria-controls="collapseLevelOne">
            <span class="fa fa-sort-amount-desc dnl-link-icon"></span>
            <span class="dnl-link-text">Dropdown level 1</span>
            <span class="fa fa-angle-up dnl-btn-sub-collapse"></span>
          </a>
          <!-- Dropdown level one -->
          <ul class="dnl-sub-one collapse" id="collapseLevelOne">
            <li>
              <a href="#">
                <span class="fa fa-slack dnl-link-icon"></span>
                <span class="dnl-link-text">Level 1</span>
              </a>
            </li>
            <li>
              <a class="collapsed" data-toggle="collapse" href="#collapseLevelTwo" aria-expanded="false" aria-controls="collapseLevelTwo">
                <span class="fa fa-level-down dnl-link-icon"></span>
                <span class="dnl-link-text">Dropdown level 2</span>
                <span class="fa fa-angle-up dnl-btn-sub-collapse"></span>
              </a>
              <!-- Dropdown level two -->
              <ul class="dnl-sub-two collapse" id="collapseLevelTwo">
                <li>
                  <a href="#">
                    <span class="fa fa-wifi dnl-link-icon"></span>
                    <span class="dnl-link-text">Level 2</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="fa fa-wifi dnl-link-icon"></span>
                    <span class="dnl-link-text">Level 2</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="fa fa-wifi dnl-link-icon"></span>
                    <span class="dnl-link-text">Level 2</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#">
                <span class="fa fa-slack dnl-link-icon"></span>
                <span class="dnl-link-text">Level 1</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="dnl-nav-title">Scheduled  Calls</p>
      <ul class="dnl-nav ">
        <li>
          <a href="https://logintei.staging.wpengine.com/scheduler/?ID=006E0000004dajd&IDCC=a1lE0000000NboUIAS&IDU=003E000000HTeqLIAT" target="MainIframe">
            <span class="fa fa-calendar dnl-link-icon"></span>
            <span class="dnl-link-text">Tom T vs USA</span>
          </a>
        </li>
      </ul>
      <!-- <p class="dnl-nav-title">Category</p> -->
      <ul class="dnl-nav hidden">
        <li>
          <a class="collapsed" data-toggle="collapse" href="#collapseCategoryAll" aria-expanded="false" aria-controls="collapseCategoryAll">
            <span class="glyphicon glyphicon-tags dnl-link-icon"></span>
            <span class="dnl-link-text">All</span>
            <span class="fa fa-angle-up dnl-btn-sub-collapse"></span>
          </a>
          <!-- Dropdown level one -->
          <ul class="dnl-sub-one collapse" id="collapseCategoryAll">
            <li>
              <a href="#">
                <span class="fa fa-dot-circle-o dnl-link-icon"></span>
                <span class="dnl-link-text">UI</span>
                <span class="badge">4</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="fa fa-dot-circle-o dnl-link-icon"></span>
                <span class="dnl-link-text">Design</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="fa fa-dot-circle-o dnl-link-icon"></span>
                <span class="dnl-link-text">App</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="fa fa-dot-circle-o dnl-link-icon"></span>
                <span class="dnl-link-text">Homepage</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#">
            <span class="fa fa-dot-circle-o dnl-link-icon"></span>
            <span class="dnl-link-text">Popular</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="fa fa-dot-circle-o dnl-link-icon"></span>
            <span class="dnl-link-text">Handpicked</span>
          </a>
        </li>
      </ul>
    </div> <!-- /.dash-navbar-left -->


