<?php
function debug_get()
{
   if (!isset($_SESSION['debug']))
   {
      $_SESSION['debug'] = 0;
   }

   if (isset($_GET['debug']))
   {
      if ($_GET['debug'] == 1)
      {
         $_SESSION['debug'] = 1;
      }
      else
      {
         $_SESSION['debug'] = 0;
      }
   }

   if ($_SESSION['debug'] == 1)
   {
      $debug = 1;
   }
   else
   {
      $debug = 0;
   }
   return($debug);
}

function debug_print($p, $s="")
{
   if (debug_get())
   {
      printf ("<div class='debug'><pre>");
      if ($s != "")
      {
         printf ($s." = ");
      }
      print_r($p);
      printf ("</pre></div>\n");
   }
}

function debug_always($p, $s="")
{
   printf ("<div class='debug'><pre>");
   if ($s != "")
   {
      printf ($s." = ");
   }
   print_r($p);
   printf ("</pre></div>\n");
}

function debug_print_list($p, $s="")
{
   if (debug_get())
   {
      function_print_list($p,$s);
   }
}

?>