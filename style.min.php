<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} header("Content-type: text/css"); ?>

<?php if(extension_loaded('zlib')){ob_end_flush();}?>