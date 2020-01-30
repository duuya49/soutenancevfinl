<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} ?>
<?php
if($_SESSION['NIV'] == "etudiant"){ 
  include('includes/header.php'); 
include('includes/navbar.php'); ?>
<head><link rel='stylesheet' href='style/css/intlTelInput.css'></head>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
</div>
  <!-- Page Heading -->


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="etudiant.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Nom Etudiant </label>
                <input type="text" name="nom_etudiant" class="form-control" placeholder="Saisissez votre nom" required>
            </div>
            <div class="form-group">
                <label> Prenom Etudiant </label>
                <input type="text" name="prenom_etudiant" class="form-control" placeholder="Saisissez votre prenom" required>
            </div>
            <div class="form-group">
                <label> CIN </label>
                <input type="text" name="cin" class="form-control" placeholder="Saisissez votre CIN" required>
            </div>
            <div class="form-group">
                <label> CNE </label>
                <input type="text" name="cne" class="form-control" placeholder="Saisissez votre CNE" required>
            </div>
            <div class="form-group">
                <label> Date de naissance </label>
                <input type="date" name="date_n" class="form-control" placeholder="Saisissez votre date de naissance" required>
            </div>
            <div class="form-group">
                <label> lieu de naissance </label>
                <input type="text" name="lieu_n" class="form-control" placeholder="Saisissez votre lieu de naissance" required>
            </div>
            <div class="form-group">
                <label>Email d'etudiant</label>
                <input type="email" name="email_etudiant" class="form-control" placeholder="Saisissez votre Email" required>
            </div>
            <div class="form-group">
                <label> Numero de telephone </label>
                <input type="tel" name="num_tele" class="form-control" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  placeholder="Saisissez votre telephone" required>
                
            </div>
            <div class="form-group">
                <label> Adresse d'etudiant </label>
                <input type="text" name="adresse_etudiant" class="form-control" placeholder="Saisissez votre Adresse" required>
            </div>
            <div class="form-group">
                <label> Filiére d'etudiant </label>
                <input type="text" name="filiere_etudiant" class="form-control" placeholder="Saisissez votre Filiére" required>
            </div>
            <div class="form-group">
                <label> Specialite d'etudiant </label>
                <input type="text" name="specialite_etudiant" class="form-control" placeholder="Saisissez votre Specialite" required>
            </div>
            <div class="form-group">
                <label>Sujet</label>
                <input type="text" name="sujet" class="form-control" placeholder="Saisissez votre sujet" required>
            </div>
            <div class="form-group">
                <label>Résumee</label>
                <input type="text" name="resumee" class="form-control" placeholder="Saisissez votre résumée" required>
            </div>
            <div class="form-group">
                <label>Encadrant</label>
                <select name="nom_encadrant" id="nom_encadrant" class="form-control" required>
<?php
$select_encadrant = "SELECT nom_encadrant, email_encadrant FROM encadrant";
$result = $conn->query($select_encadrant);
  while ($row = $result->fetch_assoc()){  ?>
      <option value="<?php echo $row['nom_encadrant']; ?>"><?php echo $row['nom_encadrant']; ?></option>

  <?php } ?>
</select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" name="button" class="btn btn-primary">Enregister</button>

        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">Nouveau Formulaire </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Username </th>
            <th>Email </th>
            <th>Telecharger </th>
            <th>affichier vos informations </th>
          </tr>
        </thead>
        <tbody>
     
          <tr>
            <td> <?php $USERNAME = $_SESSION['USERNAME']; echo $USERNAME;?></td>
            <td><?php $EMAIL = $_SESSION['EMAIL']; echo $EMAIL;?></td>
            <td>
                <form action="pdfinfo.php" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="telechargement" class="btn btn-danger"> Telecharger</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="affiche" class="btn btn-danger"> affichier</button>
                </form>

            </td>
          </tr>
        
        </tbody>
      </table>
      <?php  if(isset($_REQUEST['affiche']))
{
$EMAIL = $_SESSION['EMAIL'];
$info_encadrant = "SELECT  nom_etudiant, prenom_etudiant, cin, cne, date_n, lieu_n, email_etudiant, num_tele, adresse_etudiant, filiere_etudiant, specialite_etudiant, sujet, resumee, nom_encadrant
FROM  etudiant where  email_etudiant ='$EMAIL'";
$result = $conn->query($info_encadrant);
while($row = $result->fetch_assoc()){ 
  echo"<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'>";
  echo "<tr><td>nom : ".$row['nom_etudiant']."</td><td> "."prenom : ".$row['prenom_etudiant']."</td><tr>";
  echo "<tr><td>CIN : ".$row['cin']."</td><td>"."CNE :  ".$row['cne']."</td><tr>";
  echo "<tr><td>Date de naissance : ".$row['date_n']."</td><td>"."lieu de naissance : ".$row['lieu_n']."</td><tr>";
  echo "<tr><td>email : ".$row['email_etudiant']." </td><td>"."telephone : ".$row['num_tele']."</td><tr>";
  echo "<tr><td>adresse : ".$row['adresse_etudiant']."</td><td>"."filiére : ".$row['filiere_etudiant']."</td><tr>";
  echo "<tr><td>spécialité : ".$row['specialite_etudiant']."</td><td>"."sujet : ".$row['sujet']."</td><tr>";
  echo "<tr><td>résumée : ".$row['resumee']."</td><td>"."encadrant : ".$row['nom_encadrant']."</td><tr>";
  echo"</table>";
}
} 
?>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
} 
else  { 
  //if not etudiant 
  header ('location: ../index.php'); }
?>