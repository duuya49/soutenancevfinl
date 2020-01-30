<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} ?>
<?php
if($_SESSION['NIV'] == "etudiant"){ 

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
$pdf->AddPage();
// variables add
$EMAIL = $_SESSION['EMAIL'];
$pdf_download = "SELECT nom_etudiant, prenom_etudiant, cin, cne, date_n, lieu_n, email_etudiant, num_tele, adresse_etudiant, filiere_etudiant, specialite_etudiant, sujet, resumee, nom_encadrant
FROM etudiant where email_etudiant ='$EMAIL' ";
$id_soutenance = "SELECT id_soutenance FROM soutenance where email_etudiant ='$EMAIL' ";
$result = $conn->query($pdf_download);
$results = $conn->query($id_soutenance);
$row = $result->fetch_assoc(); 
$rows = $results->fetch_assoc(); 
$nom_etudiant = $row['nom_etudiant'];
$prenom_etudiant = $row['prenom_etudiant'];
$cin = $row['cin'];
$cne = $row['cne'];
$date_n = $row['date_n'];
$lieu_n = $row['lieu_n'];
$email_etudiant = $row['email_etudiant'];
$num_tele = $row['num_tele'];
$adresse_etudiant = $row['adresse_etudiant'];
$filiere_etudiant = $row['filiere_etudiant'];
$specialite_etudiant = $row['specialite_etudiant'];
$sujet = $row['sujet'];
$resumee = $row['resumee'];
$nom_encadrant = $row['nom_encadrant'];
$id_soutenance = $rows['id_soutenance'];
$date=date("Y/m/d");
// create some HTML content
$html = <<<EOD

<style>
h1{
     text-align:center;
     margin-bottom: 60px;
 }
     
 h3{
         text-align:right;
     }
	 
th td {
	
width:10px;
}
     </style>
 
     
    <h3 > $date </h3>
     <h1 >Formulaire </h1>

 <table style="width:100%">
 <tr>
    <th>Numéro de demande :</th>
    <td>$id_soutenance</td>
  </tr> <br><br>
 <tr>
    <th>Prénom :</th>
    <td> $prenom_etudiant  </td>
  </tr><br><br>
  <tr>
    <th >Nom :</th>
    <td > $nom_etudiant</td>
  </tr><br><br>
  <tr>
    <th>CIN :</th>
    <td> $cin</td>
  </tr><br><br>
  <tr>
    <th>CNE :</th>
    <td> $cne</td>
  </tr><br><br>
  <tr>
    <th>Date de naissance :</th>
    <td> $date_n</td>
  </tr><br><br>
  <tr>
    <th>  Lieu de naissance :</th>
    <td> $lieu_n</td>
  </tr><br><br>
  <tr>
    <th>EMAIL :</th>
    <td> $email_etudiant </td>
  </tr><br><br>
  <tr>
    <th>Telephone :</th>
    <td> $num_tele</td>
  </tr><br><br>
  <tr>
    <th>Adresse Etudiant:</th>
    <td> $adresse_etudiant</td>
  </tr><br><br>
  <tr>
    <th>Filière :</th>
    <td>$filiere_etudiant</td>
  </tr><br><br>
  <tr>
    <th>Specialite :</th>
    <td> $specialite_etudiant</td>
  </tr><br><br>
  <tr>
    <th>Sujet :</th>
    <td> $sujet</td>
  </tr><br><br>
  <tr>
  <th>Resumee :</th>
  <td> $resumee</td>
</tr><br><br>
  <tr>
    <th>Encadrant :</th>
    <td> $nom_encadrant</td>
  </tr>
 
</table>
EOD;


// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_end_clean(); 
//Close and output PDF document
$pdf->Output('recu.pdf', 'D');


include('includes/scripts.php');
include('includes/footer.php');
} 
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>
?>