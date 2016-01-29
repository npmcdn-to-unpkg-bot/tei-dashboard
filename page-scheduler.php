<?php
/*
Template Name: Dashboard Scheduler Template
*/
//  echo "<div class='container'><pre>";

// global $wp_filter;
// $comment_filters = array ();
//     $h1  = '<h1>Current Comment Filters</h1>';
//     $out = '';
//     $toc = '<ul>';
//     foreach ( $wp_filter as $key => $val )
//     {
//         if ( FALSE !== strpos( $key, '' ) )
//         {
//             $comment_filters[$key][] = var_export( $val, TRUE );
//         }
//     }
//     foreach ( $comment_filters as $name => $arr_vals )
//     {
//         $out .= "<h2 id=$name>$name</h2><pre>" . implode( "\n\n", $arr_vals ) . '</pre>';
//         $toc .= "<li><a href='#$name'>$name</a></li>";
//     }
//     print "$h1$toc</ul>$out";

//  echo "</pre></div";
?>
<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <?php // Google Chrome Frame for IE ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if (is_front_page()) { bloginfo('name'); } else { wp_title(''); } ?></title>
    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, shrink-to-fit=no">
    <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v=1">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#2a5781">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>
    <?php // drop Google Analytics Here ?>
    <?php // end analytics ?>
    <script type="text/javascript">
    var templateDir = "<?php bloginfo('template_directory') ?>";
    </script>
</head>
<body <?php body_class(); ?>>

<div class="container" style="margin-left: 0">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 text-center">
            <h1 class="share-case-title ">
            <!-- TITLE GOES HERE -->
            <?php echo $Opp_name; ?>
            </h1>
            <div class="content">
                <? echo $greeting; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- TEI-SCHEDULER CARD -->    
        <div class="col-sm-10 col-sm-offset-1">
            <?php echo do_shortcode('[tei-scheduler]'); ?>

            <div id="del_avail_confim" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                    <p>One fine body&hellip;</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 text-center">
            <div class="tei-card">
                <div class="header">
                    Select timezone
                </div>
                <div class="content">
                    <select id="timezone-selector">                
                                    <!-- <option value="" >none</option> -->
                                    <option value="local" selected>Local</option>
                                    <option value="UTC">UTC</option>
                                    <option value="EST">Eastern</option>
                                    <option value="CST">Central</option>
                                    <option value="MST">Mountain</option>
                                    <option value="PST">Pacific</option>
                    </select>
                        <div id="available"></div>
                </div>
            </div>
        </div>


    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.1/iframeResizer.contentWindow.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>
