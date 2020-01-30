<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
}
//if not etudiant
if($_SESSION['NIV'] == "etudiant"){ 
$nom_etudiant = $_POST['nom_etudiant'];
$prenom_etudiant = $_POST['prenom_etudiant'];
$cin = $_POST['cin'];
$cne = $_POST['cne'];
$date_n = $_POST['date_n'];
$lieu_n = $_POST['lieu_n'];
$email_etudiant = $_POST['email_etudiant'];
$num_tele = $_POST['num_tele'];
$adresse_etudiant = $_POST['adresse_etudiant'];
$filiere_etudiant = $_POST['filiere_etudiant'];
$specialite_etudiant = $_POST['specialite_etudiant'];
$sujet = $_POST['sujet'];
$resumee = $_POST['resumee'];
$nom_encadrant = $_POST['nom_encadrant'];
$sql = "INSERT INTO etudiant (nom_etudiant, prenom_etudiant, cin, cne, date_n, lieu_n, email_etudiant, num_tele, adresse_etudiant, filiere_etudiant, specialite_etudiant, sujet, resumee, nom_encadrant)
VALUES ('$nom_etudiant', '$prenom_etudiant', '$cin', '$cne', '$date_n' , '$lieu_n', '$email_etudiant', '$num_tele', '$adresse_etudiant', '$filiere_etudiant', '$specialite_etudiant', '$sujet', '$resumee', '$nom_encadrant')";
$etudiant_info = "SELECT nom_encadrant, email_encadrant from encadrant where nom_encadrant = '$nom_encadrant' ";
$result = $conn->query($etudiant_info);
$row = $result->fetch_assoc();
$sql1 = "INSERT INTO soutenance (nom_etudiant, prenom_etudiant, email_etudiant, sujet, resumee, nom_encadrant, email_encadrant)
VALUES ('$nom_etudiant', '$prenom_etudiant', '$email_etudiant', '$sujet', '$resumee','$nom_encadrant', '$row[email_encadrant]')";
$conn->query($sql);
$conn->query($sql1);
$conn->close(); header ('location: ../etudiant/register.php');
}
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>