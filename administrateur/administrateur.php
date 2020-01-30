<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} 
?>
<?php if($_SESSION['NIV'] == "administrateur"){
include('includes/header.php'); 
include('includes/navbar.php');
  $TRUE = "oui";
  $etudiant_info = "SELECT id_soutenance, nom_etudiant, prenom_etudiant, sujet, email_encadrant, validation_encadrant,nom_jury_president, 
  nom_jury_examinateur, nom_jury_invite, prenom_jury_president, prenom_jury_examinateur, prenom_jury_invite, 
  etablissement_jury_president, etablissement_jury_examinateur, etablissement_jury_invite, 
  email_jury_president, email_jury_examinateur, email_jury_invite
  from soutenance where  validation_encadrant = '$TRUE'";
  $res = $conn->query($etudiant_info);
 
  while($row = $res->fetch_assoc()) { 
    echo " <style>
    .tb {
      border-style: solid;
      border-color: #4066D5;
      border-width: 5px;
    }
    </style>
    <div class='tb'>";
    echo " <table class='table table-bordered' cellspacing='0'><thead align='center'>
    <tr><th>Numéro de demande</th><th>Nom Etudiant</th><th>Prenom Etudiant</th><th>Sujet</th></tr></thead>";
       echo "<tbody align='center'><tr><td>".$row["id_soutenance"]."</td><td>".$row["nom_etudiant"]."</td><td>".$row["prenom_etudiant"]."</td><td>".$row["sujet"]."</td></tr></tbody>";
       echo "</table>";
       echo "</br>";
       echo"<table class='table table-bordered' cellspacing='0' align='center'>
       <thead align='center'>
      <tr>
      <th></th>
        <th>Le président</th><th>L'examinateur</th><th>L'invité</th>
      </tr>
      </thead>
      <tbody align='center'>
      <tr>
        <td>Nom</td>
        <td>".$row['nom_jury_president']."</td>
        <td>".$row['nom_jury_examinateur']."</td>
        <td>".$row['nom_jury_invite']."</td>
      </tr>
      <tr>
        <td>Prenom</td>
        <td>".$row['prenom_jury_president']."</td>
        <td>".$row['prenom_jury_examinateur']."</td>
        <td>".$row['prenom_jury_invite']."</td>
      </tr>
      <tr>
        <td>etablissement</td>
        <td>".$row['etablissement_jury_president']."</td>
        <td>".$row['etablissement_jury_examinateur']."</td>
        <td>".$row['etablissement_jury_invite']."</td>
      </tr>
      <tr>
        <td>email</td>
        <td>".$row['email_jury_president']."</td>
        <td>".$row['email_jury_examinateur']."</td>
        <td>".$row['email_jury_invite']."</td>
      </tr>
      </tbody>
    </table><br><br>";
      }    
echo "</div><br><br>";
echo "<form action='' method='POST' > <table class='table table-bordered' cellspacing='0' align='center'>
<thead align='center'>
<tr>
<th>Numéro de demande</th><th>Validation des demandes</th><th>Les invitations</th><th>Envoie des email</th>
</tr>
<tr>
<td>
<select name='id_soutenance' ><br>";
$TRUE = "oui";
       $select_administrateur = "SELECT 	id_soutenance, validation_encadrant FROM soutenance where validation_encadrant = '$TRUE' ";
      $result = $conn->query($select_administrateur);
      while ($row = $result->fetch_assoc()){ 
         echo " <option value='$row[id_soutenance]'>$row[id_soutenance]</option>"; }
echo "</select></td>
<td><select name='choix' >
<option value='non'>non</option>
<option value='oui'>oui</option>
</select ><button type='submit' name='Validation' class='btn btn-primary'>Validation</button></td>
<td><button type='submit' name='Telecharger' class='btn btn-primary'>Télécharger</button></td>
<td><button type='submit' name='Envoyer' class='btn btn-primary'>Envoyer</button></td>
</tr></thead></table></form>";
// VALIDATION des demandes
if(isset($_REQUEST['Validation'])){ 
  $id_soutenance = $_POST['id_soutenance'];
  $choix = $_POST['choix'];
  $sql = "UPDATE  soutenance  SET  validation_administrateur = '$choix' where id_soutenance = '$id_soutenance'";
  $conn->query($sql);
  echo "La demande a été valider";
}
//Télecharger le formulaire
if(isset($_REQUEST['Telecharger'])){
}
// envoie d'email
if(isset($_REQUEST['Envoyer'])){
  $id_soutenance = $_POST['id_soutenance'];
  $sql = "SELECT id_soutenance, nom_etudiant, email_etudiant, nom_encadrant, email_encadrant, date_soutenance FROM soutenance where id_soutenance = '$id_soutenance'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $nom_etudiant = $row['nom_etudiant'];
 $email_etudiant = $row['email_etudiant'];
 $nom_encadrant = $row['nom_encadrant'];
 $email_encadrant = $row['email_encadrant'];
 $date_soutenance = $row['date_soutenance'];
$message_etudiant = "Bonjour  $nom_etudiant votre demande de soutenance a été valider, la date est $date_soutenance ";
$objet_etudiant ="demande de soutenance";
$message_encadrant = "Bonjour   $nom_encadrant  votre demande de soutenance a été valider, la date est  $date_soutenance";
$objet_encadrant = "Confirmation de soutenance";
mail($email_etudiant,$objet_etudiant,$message_etudiant); 
mail($email_encadrant,$objet_encadrant,$message_encadrant); 
echo "les mail sont envoyées";
}}
else  { 
  //if not administrateur 
  header ('location: ../index.php'); }  
?>