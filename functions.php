<?php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );

include "theme-functions/scripts.php";

include "theme-functions/setup.php";

include "theme-functions/post-types/slider.php";

include "theme-functions/post-types/events.php";

include "theme-functions/admin-panel.php";

include "theme-functions/curl.php";

include "theme-functions/breadcrumbs.php";
