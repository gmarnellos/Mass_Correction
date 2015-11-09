<?php

$topdir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

require_once "$topdir/GlobalConfig.php";

$page  = new PageTemplate("Mass Correction Results");

if(isset($_POST['Output'])) $outfile=$_POST['Output'];

if (!isset($_POST['Output']) || $outfile == '') {
  $outfile = "mass_modified." . date("Y-m-d_H:i:s") . ".txt";
}

$uploaddir = '/tmp/';
$tempname = basename($_FILES['uploadFile']['tmp_name']);
$filename = basename($_FILES['uploadFile']['name']);
$uploadfile = $uploaddir . $filename;

$myerror = $_FILES['uploadFile']['error'];

if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadfile)) {
  //  echo "File was successfully uploaded.\n";
} else {
 //   echo "File $uploadfile  was not successfully uploaded.\n";
}

// Create temporary folder in /tmp for input and out files of the job.
system("mkdir -p /tmp/$tempname");
system("mv $uploadfile /tmp/$tempname/");

// Call to actual program that process the input and produces the output file
$output=system("perl mass_correction.pl  /tmp/$tempname/$filename  /tmp/$tempname/$outfile", $retval);

system("cp /tmp/$tempname/$outfile /var/www/html/minilims/files/");


// Can also have the output be printed directly under /var/www/html/minilims/files/
//$output=system("perl mass_correction.pl  /tmp/$tempname/$filename  /var/www/html/minilims/files/$outfile", $retval);


$htmlResults = '<br/><br/><br/> </pre><hr /> </pre>' . "The results have been written to: <a href=http://msprl.rc.fas.harvard.edu/minilims/misc/MiniFileView.php/$outfile> $outfile </a>" . ' </pre><hr /> </pre>';

print $page->toHTML("Mass Correction Results", $htmlResults);

?>

