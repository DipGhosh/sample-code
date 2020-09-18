<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;


class Pdfgenerator {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    /*$dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }*/

//echo $html;

//die();
$dompdf = new Dompdf();

//print_r($dompdf);

$dompdf->setBasePath(realpath(FCPATH.'public/admin/images/'));

$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation portrait landscape
$dompdf->setPaper('a3', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

 file_put_contents(FCPATH.'/public/uploads/certificate/'.$filename, $dompdf->output());
return $output = FCPATH.'/public/uploads/certificate/'.$filename;
//$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

//$dompdf->stream($filename);



  }


  public function generateOutput($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    /*$dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }*/

//echo $html;

//die();
$dompdf = new Dompdf();

//print_r($dompdf);

$dompdf->setBasePath(realpath(FCPATH.'public/admin/images/'));

$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation portrait landscape
$dompdf->setPaper('a3', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

 //file_put_contents(FCPATH.'/public/uploads/certificate/'.$filename, $dompdf->output());
//return $output = FCPATH.'/public/uploads/certificate/'.$filename;
//$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

$dompdf->stream($filename, array("Attachment" => false));

//exit(0);
//$dompdf->stream($filename);



  }


}