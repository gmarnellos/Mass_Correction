<?php

$topdir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

require_once "$topdir/GlobalConfig.php";

$page  = new PageTemplate("Mass Correction");

$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">

<html xmlns='http://www.w3.org/1999/xhtml'>
   <head >
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Protein Translation</title>
   </head>
<body>
<!-- <h1>Mass Correction</h1> -->

<form enctype='multipart/form-data' id='masscorrection' method='post' action='action_mc.php'>

   <p>
   Input file to upload: <input type='file' name='uploadFile'>
   </p>

   <br>

  <!--  
   <p>
   Output file name (enter string consisting only of alphanumeric characters, underscore \"_\" or period \".\", no spaces. Or leave bank for default output name. ) : <input type='text' name='Output' />
   </p> 
  -->

   <br>
   <p> 
     <input type='submit' name='Submit' value='Submit' />
   </p> 

   <!-- MAX_FILE_SIZE in bytes preceding the file input field -->
 <!--    <input type='hidden' name='MAX_FILE_SIZE' value='2000000' /> -->
   <!-- Name of input element determines name in $_FILES array -->

<!--   Input Fasta file to upload: <input type='file' name='uploadFile'>

   <input type='submit' value='Upload file and Process'>
   </p> -->


</form>

</body>
</html>";

print $page->toHTML("Mass Correction", $html);

?>
