<!DOCTYPE html>
<!--shottily designed by Kevin Law @thatarchguy-->
<!--LocalHomePage Originally by @cmall -->
<!--KanBan Originally by @alexisgo -->

<html>
<head>
<meta charset="utf-8">
<title>@localhost</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/kanban.css">

<?php require('config.php'); ?>
</head>

<body>

<div id="wrapper">
  <h2 align='center'>@Localhost</h2>
  <div id="tabContainer">
    <div class="tabs">
      <ul>
        <li id="tabHeader_1">life</li>
        <li id="tabHeader_2">dev</li>
        <li id="tabHeader_3">todo</li>
      </ul>
      
      <a href="http://time.is/Atlanta" id="time_is_link"></a>
      <span id="Atlanta_z161"></span>
      <script src="http://widget.time.is/t.js"></script>
      <script>
      time_is_widget.init({Atlanta_z161:{time_format:"hours:minutes"}});
      </script>
      <div style='clear:both'></div>
    </div>
    <div class="tabscontent">
      <div class="tabpage" id="tabpage_1">
        
        <p>
          <div class ="links">
            <div class = "boards">
            <h2>boards </h2>  
            <a href="http://boards.4chan.org/g/"><span id="chan">/g/</span></a>
            <a href="http://boards.4chan.org/pol/"><span id="chan">/pol/</span></a>
            <div style='clear:both'></div>
            <a href="http://boards.4chan.org/wg/"><span id="chan">/wg/</span></a>
            <a href="http://boards.4chan.org/r9k/"><span id="chan">/r9k/</span></a>
            <div style='clear:both'></div>
            </div>

            <div class = "subs">
            <h2>subs</h2>
            <a href="http://reddit.com/r/netsec"><span id="subs">/netsec/</span></a>
            <a href="http://reddit.com/r/technology"><span id="subs">/tech/</span></a>
            <div style='clear:both'></div>
            <a href="http://reddit.com/r/all"><span id="subs">/all/</span></a>
            <a href="http://reddit.com/r/linux"><span id="subs">/linux/</span></a>
            <div style='clear:both'></div>
            </div>
            <div style='clear:both'></div>
          </div>

          

        </p>
      </div>
      <div class="tabpage" id="tabpage_2">
        <h2 align='center'>dev</h2>

        <!-- begin heavily LocalHomePage inspired code-->
        <div class="canvas">
<?php
        foreach ( $dir as $d ) {
        echo "<div style='clear:both' class='mycss'>$d</div>";
          $dirsplit = explode('/', $d);
          $dirname = $dirsplit[count($dirsplit)-2];

        printf( '<ul class="sites %1$s">', $dirname );

            foreach( glob( $d ) as $file )  {

              $project = basename($file);

              if ( in_array( $project, $hiddensites ) ) continue;

                echo '<li>';
          

          //define Custom VHOSTS
          if ($project == "laundry") {
            $siteroot = "http://$project.$tld";
          } else {
                //$siteroot = sprintf( 'http://%1$s.%2$s', $project,$tld );
          $siteroot = "file://".$file;
          }

                // Display an icon for the site
                $icon_output = '<span class="no-img"></span>';
                foreach( $icons as $icon ) {

                  if ( file_exists( $file . '/' . $icon ) ) {
                    $icon_output = sprintf( '<img src="%1$s/%2$s">', $siteroot, $icon );
                    break;
                  } // if ( file_exists( $file . '/' . $icon ) )

                } // foreach( $icons as $icon )
                echo $icon_output;

                // Display a link to the site
                $displayname = $project;
                if ( array_key_exists( $project, $siteoptions ) ) {
                  if ( is_array( $siteoptions[$project] ) )
                    $displayname = array_key_exists( 'displayname', $siteoptions[$project] ) ? $siteoptions[$project]['displayname'] : $project;
                  else
                    $displayname = $siteoptions[$project];
                }
                printf( '<a class="site" href="%1$s">%2$s</a>', $siteroot, $displayname );


          // Display an icon with a link to the admin area
          $adminurl = '';
          // We'll start by checking if the site looks like it's a WordPress site
          if ( is_dir( $file . '/wp-admin' ) )
            $adminurl = sprintf( 'http://%1$s/wp-admin', $siteroot );

          // If the user has defined an adminurl for the project we'll use that instead
                if (isset($siteoptions[$project]) &&  is_array( $siteoptions[$project] ) && array_key_exists( 'adminurl', $siteoptions[$project] ) )
                  $adminurl = $siteoptions[$project]['adminurl'];

                // If there's an admin url then we'll show it - the icon will depend on whether it looks like WP or not
                if ( ! empty( $adminurl ) )
                  printf( '<a class="%2$s icon" href="%1$s">Admin</a>', $adminurl, is_dir( $file . '/wp-admin' ) ? 'wp' : 'admin' );


                echo '</li>';

        } // foreach( glob( $d ) as $file )

            echo '</ul>';


        } // foreach ( $dir as $d )
?>
 <div style='clear:both'></div>
</div>
     
      </div>
      <div class="tabpage" id="tabpage_3">
        <h2 align='center'>To Do</h2>

      <!-- initiate Kanban -->
        <div id="todo">
          <div class="title">To Do</div>
            <div id="item1" draggable="true">
              <div class="cardTitle">
                  Get Stuff
              </div>
            </div>
            <div id="item2" draggable="true">
              <div class="cardTitle">
                   Learn stuff
              </div>
            </div>
            <div id="item3" draggable="true">
              <div class="cardTitle">
                  Forget stuff
              </div>
            </div>
        </div>

        <div id="inprogress">
          <div class="title">In Progress</div>
        </div>
      
        <div id="done">
          <div class="title">Done</div>
        </div>

      <div style='clear:both'></div>
    
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/dragndrop.js"></script>
        <div style='clear:both'></div>
    

    </div>
  </div>
<script src="js/tabs.js"></script>
</body>

</html>
