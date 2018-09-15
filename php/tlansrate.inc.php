<?php
function translate_replace_host($a, $hup, $translate=0)
{
   if (substr($a, 0, 2) == '//')
   {
      $x = 'http:'.$a;
   }
   elseif ((substr($a, 0, 7) <> 'http://') AND (substr($a, 0, 8) <> 'https://'))
   {
      # /img/bla.jpg
      if (substr($a, 0, 1) == '/')
      {
         $x = $hup[0].$a;
      }
      # img/bla.jpg
      elseif (substr($a,0, 1) <> '/')
      {
         $x = $hup[2].$a;
      }
      else
      {
         $x = $hup[0].$a;
      }
   }
   else
   {
      $x = $a;
   }
   return($x);
}

function translate_replace_tag($dom, $tag, $attribute, $hup, $translate=0)
{
   $tags = $dom->getElementsByTagName($tag);
   foreach($tags as $t)
   {
      $a = $t->getAttribute($attribute);
      // if (strstr($a, '#') <> FALSE)
      // {
         // print (strstr($a, '#') == FALSE);
         // print $a."<br>";
      // }
      if ((strlen($a)>0) AND (strstr($a, '#') == FALSE))
      {
         $a = translate_replace_host($a, $hup, $translate);
         if ($translate == 1)
         {
            $a = 'index.php?url='.$a;
            $t->setAttribute('target', '_parent');
         }
         $t->setAttribute($attribute, $a);
      }
   }
   return($dom);
}

function translate_add_http_to_url($url)
{
   if ((substr($url, 0, 7) <> 'http://') AND (substr($url, 0, 8) <> 'https://'))
   {
      $url = 'http://'.$url;
   }
   return($url);
}


function translate_get_host_url_path($url)
{
   $url  = translate_add_http_to_url($url);

   $a = parse_url($url);
   if ($a['scheme'] == '')
   {
      $scheme = 'http';
   }
   else
   {
      $scheme = $a['scheme'];
   }
   $url_out = $scheme.'://'.$a['host'].$a['path'];
   $a = parse_url($url_out);
   $p = explode('/', $a['path']);
   $p2 = '';
   foreach ($p as $y)
   {
      if (strstr($y, '.') == FALSE)
      {
         $p2 = $p2.$y.'/';
      }
   }
   $host    = $scheme.'://'.$a['host'];
   $url_out = $scheme.'://'.$a['host'].$a['path'];
   $path    = $scheme.'://'.$a['host'].$p2;
   
   debug_print($host);
   debug_print($url_out);
   debug_print($path);
   return(array($host, $url_out, $path));
}


function tlansrate_get_search_host_url_path($url)
{
   $scheme = 'http';
   $host   = 'www.bing.com';
   $path   = '/search?q='.str_replace(' ','+',trim($url));

   $host_out = $scheme.'://'.$host;
   $url_out  = $scheme.'://'.$host.$path;
   $path_out = $scheme.'://'.$host.$path;

   debug_print($host_out);
   debug_print($url_out);
   debug_print($path_out);
   return(array($host_out, $url_out, $path_out));
}


function tlansrate_check_if_url($url)
{
   if(strstr($url, "://") == False) 
   { 
      $url = "http://$url";
   }
   if (filter_var($url, FILTER_VALIDATE_URL))
   {
      $is_url = 1;
   }
   else
   {
      $is_url = 0;
   }
   return($is_url);
}

function translate_replace_dom_node(DOMNode $dom_node)
{
   $tmp_string = "qqbz";
   foreach ($dom_node->childNodes as $node)
   {
      if($node->hasChildNodes())
      {
         translate_replace_dom_node($node);  
      }
      else
      {
         if ($node->nodeName == '#text')
         {
            $node->nodeValue = str_replace("l",$tmp_string, $node->nodeValue);
            $node->nodeValue = str_replace("r","l", $node->nodeValue);
            $node->nodeValue = str_replace($tmp_string,"r", $node->nodeValue);

            $node->nodeValue = str_replace("L",$tmp_string, $node->nodeValue);
            $node->nodeValue = str_replace("R","L", $node->nodeValue);
            $node->nodeValue = str_replace($tmp_string,"R", $node->nodeValue);
         }
      }
   }    
}
?>