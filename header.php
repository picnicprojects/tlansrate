<?php
require('php/require_once.inc.php');

html_header();

printf("<body>\n");
printf("<center>\n");

debug_print($_GET['url']);

if (isset($_GET['url']))
{
   $url = 'index.php?url='.strip_tags($_GET['url']);
   $banner_url = 'index.php?input='.strip_tags($_GET['url']);
}
else
{
   $url = 'index.php';
   $banner_url = $url;
}

printf("<a target='_parent' href='%s'><img height=60 src='img/tlansrate.png' alt='tlansrate'></a>\n", $banner_url);
printf("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n");
printf("</center>");
printf("</body>\n");
printf("</html>\n");

?>