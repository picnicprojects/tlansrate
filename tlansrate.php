<?php
require('php/require_once.inc.php');

if (isset($_GET['url']))
{
   $url = strip_tags($_GET['url']);
}
else
{
   printf("<script>window.open('index.php', '_parent', '')</script>");
}

error_reporting(0);
libxml_use_internal_errors(true);


$search = 1;
if (tlansrate_check_if_url($url))
{
   $hup  = translate_get_host_url_path($url);
   $html = file_get_contents($hup[1]);
   if ($html <> False)
   {
      $search = 0;
   }
}

if ($search == 1)
{
   $hup = tlansrate_get_search_host_url_path($url);
   $html = file_get_contents($hup[1]);
}

$dom = new DOMDocument();
$dom->loadHTML($html);
translate_replace_dom_node($dom->getElementsByTagName("body")->item(0));
$dom = translate_replace_tag($dom, 'img', 'src', $hup);
$dom = translate_replace_tag($dom, 'link', 'href', $hup);
$dom = translate_replace_tag($dom, 'script', 'src', $hup);
$dom = translate_replace_tag($dom, 'a', 'href', $hup, 1);
$dom = translate_replace_tag($dom, 'form', 'action', $hup);
echo $dom->saveHTML();

?>