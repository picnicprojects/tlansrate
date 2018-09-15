<?php
require('php/require_once.inc.php');

$url_list = array(
   'http://www.engrish.com/',
   'en.wikipedia.org/wiki/Chinglish',
   'brog.engrish.com',
   'http://chineseculture.about.com/od/mediainchina/fr/Chinglish.htm',
   'http://en.wikipedia.org/wiki/Chinese_culture',
   'http://en.wikipedia.org/wiki/Traditional_Chinese_characters',
   'http://www.nytimes.com/2010/05/03/world/asia/03chinglish.html?pagewanted=all&_r=0',
   'http://www.imdb.com/title/tt0335266/',
   'http://en.wikipedia.org/wiki/Lost_in_Translation_%28film%29',
   'http://www.rottentomatoes.com/m/lost_in_translation/',
   'http://mandarin.about.com/u/ua/pronunciation/Mandarin-Mistakes-Embarrassing-Or-Amusing-Mandarin-Mistakes.htm',
   'http://www.sacred-texts.com/tao/taote.htm',
   'http://www.nu.nl/achterklap/3654956/chinese-restaurants-pakken-gordon-terug.html',
   'http://www.dailymail.co.uk/news/article-497544/Chinglish-Hilarious-examples-signs-lost-translation.html');
   
if ((isset($_GET['url'])) | (isset($_GET['lucky'])))
{
   if (isset($_GET['url']))
   {
      $url = strip_tags($_GET['url']);
   }
   else
   {
      $url = $url_list[array_rand($url_list)];
   }
   html_show_translation($url);
}
elseif (isset($_GET['kees']))
{
   if (((int)$_GET['kees']) == $_GET['kees'])
   {
      $url = $url_list[$_GET['kees']];
      html_show_translation($url);
   }
   else
   {
      printf("<script>function showonload(){\n");
      foreach($url_list as $url)
      {
         printf("window.open('index.php?url=%s', '_blank');\n", $url);
      }
      printf("}</script>\n");
      printf("<body onload='javascript: showonload()'>\n");
      printf("Many pages\n");
      printf("</body>\n");
   }
}
else
{
   $error = 0;
   if (isset($_GET['error']))
   {
      $url = strip_tags($_GET['error']);
      $error = 1;
   }
   elseif (isset($_GET['input']))
   {
      $url = strip_tags($_GET['input']);
   }
   else
   {
      $url = 'www.example.com';
   }
   html_search_page($url, $error);
}
?>
