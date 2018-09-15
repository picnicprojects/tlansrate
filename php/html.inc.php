<?php
function html_header()
{
   printf("<!DOCTYPE html>\n");
   printf("<html xmlns='http://www.w3.org/1999/xhtml' lang='en'>\n");
   printf("<head>\n");
   printf("<title>Translate your web page into Chinglish, Engrish or any other funny Asian hodgepodge</title>\n");
   printf("<meta name='description' content='Free online language translation service instantly translates web pages from most roman character languages into a funny hodgepodge with Asian features. This translator supports: English, Afrikaans, Albanian, Basque, Catalan, Danish, Dutch, Esperanto, Estonian, French, German, Irish, Italian, Latin, Norwegian, Polish, Portuguese, Spanish, Swedish.'>\n");
   printf("<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />\n");
   printf("<link rel='stylesheet' type='text/css' href='css/reset.css' >\n");
   printf("<link rel='stylesheet' type='text/css' href='css/tlansrate.css' >\n");
   printf("<script language='javascript' type='text/javascript' src='js/jquery-1.4.4.min.js'></script>\n");
   printf("</head>\n");
}
function html_footer()
{
   printf("</html>\n");
}

function html_show_translation($url)
{
   $url = urlencode($url);
   
   html_header();
   printf("<FRAMESET ROWS='60, *'>\n");
   printf("<FRAME src='header.php?url=%s' frameborder='0' scrolling='NO'>\n", $url);
   printf("<FRAME src='tlansrate.php?url=%s'  frameborder='0' >\n",$url);
   printf("</FRAMESET>\n");
   html_footer();
}

function html_search_page($url, $error)
{
   html_header();
   printf("<body>\n");
   printf("<center>\n");
   printf("<img class='banner' src='img/tlansrate.png' alt='Tlansrate'>\n");
   if (isset($error))
   {
      printf("<div class='explanation'>Unfoltunatery youl website could not be tlansrated</div>\n");
   }
   else
   {
      printf("<div class='explanation'>Type the address of a website and have it tlansrated into Chinglish or Engrish:</div>\n");
   }

   printf("<form method='get' action='index.php'>\n");
   
   printf("<input name=\"url\" type=\"text\" size=\"90\" id=\"urlinput\" tabindex=\"1\" value=\"%s\"
                    onfocus=\"if (this.value == 'www.example.com') {this.value = '';}\"
                    onblur=\"if (this.value == '') {this.value = 'www.example.com';}\"/> \n", $url);
                    
   printf("<br><br><br>\n");
   printf("<a class='lucky'  href='#' onclick='$(this).closest(\"form\").submit()'>Tlansrate</a>\n");
   printf("<a class='lucky' href='index.php?lucky=1'>I'm Feeling Lucky</a>\n");
   printf("</form></center>\n");
   printf("</body>\n");
   html_footer();
}

function html_print($x)
{
   printf("<div>".$x."</div>\n");
}
?>
