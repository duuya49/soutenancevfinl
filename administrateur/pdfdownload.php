<?php
//MAKE PDF


// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('fs tetouan ');
$pdf->SetTitle('recu');
$pdf->SetSubject('recu');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, '20', 'La Faculté des Sciences de Tétouan', 'fst.ac.ma - http://www.fst.ac.ma');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// set font
$pdf->SetFont('helvetica', '', 10, '', false);




// add a page

$pdf->AddPage('L', 'A4');
$pdf->Cell(0, 0, 'Invitation', 1, 1, 'C');

$pdf->AddPage('L', 'A4');
$pdf->Cell(0, 0, 'Invitation', 1, 1, 'C');

$pdf->AddPage('L', 'A4');
$pdf->Cell(0, 0, 'Invitation', 1, 1, 'C');
//set page 
$pdf->setPage(1, true);
$pdf->SetY(50);
$pdf->Cell(0, 0, '', 0, 0, 'C');
// create some HTML content
$html = <<<EOD
<style>
h1{
     text-align:center;
     margin-bottom: 60px;
 }
     
 p{
         text-align:left;
     }
	 
th td {
	
width:10px;
}
     </style>

<table style="width:100%">
 <tr>
    <th>Nom :</th>
    <td>           </td>
  </tr> <br><br>
  <tr>
    <th>Prénom :</th>
    <td>          </td>
  </tr> <br><br>
  <tr>
  <th>Etablissement :</th>
  <td>           </td>
</tr> <br><br>
<tr>
<th>Email :</th>
<td>        </td>
</tr> <br><br>
</table>
<br><br>
vous etes invites a la soutnance a la date 00/00/00
<br>
<br /><br /><br /><br /><br><br><br>
<p>signature</p>







EOD;
//print page 1
$pdf->writeHTML($html, true, 0, true, 0);
//page2
$pdf->setPage(2, true);
$pdf->SetY(50);

$pdf->Cell(0, 0, '', 0, 0, 'C');

// create some HTML content
$html = <<<EOD


<p>c est html</p> 


EOD;
//print page 2
$pdf->writeHTML($html, true, 0, true, 0);
//page 3
$pdf->setPage(3, true);
$pdf->SetY(50);
$pdf->Cell(0, 0, ' ', 0, 0, 'C');
// create some HTML content
$html = <<<EOD

c est page 3


EOD;


// print page 3
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_end_clean(); 
//Close and output PDF document
$pdf->Output('invitation.pdf', 'D');

?>