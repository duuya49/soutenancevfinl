<?php
require_once ("../connexion.php");
session_start();
if(!isset($_SESSION['NIV'])){
  header ('location: ../index.php');
} 
?>
<?php if($_SESSION['NIV'] == "encadrant"){ 
  include('includes/header.php'); 
  include('includes/navbar.php');
  ?>
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card-body">

    <div class="table-responsive">
    <?php 
        $EMAIL = $_SESSION['EMAIL'];
        $TRUE = "oui";
        $etudiant_info = "SELECT id_soutenance, nom_etudiant, prenom_etudiant, sujet, resumee, email_encadrant, validation_encadrant from soutenance where email_encadrant = '$EMAIL' AND validation_encadrant = '$TRUE'";
        $res = $conn->query($etudiant_info);
        echo "<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'><tr><th>Numéro de demande</th><th>Nom Etudiant</th><th>Prenom Etudiant</th><th>Sujet</th><th>Resumee</th></tr>";
        while($row = $res->fetch_assoc()) { 
             echo "<tr><td>".$row["id_soutenance"]."</td><td>".$row["nom_etudiant"]."</td><td>".$row["prenom_etudiant"]."</td><td>".$row["sujet"]."</td><td>".$row["resumee"].  "</td></tr>";
    }    
      echo "</table>";
         ?>
  <form action="encadrantinsert.php" method="POST">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead align="center">
          <tr>
          <th> </th>
            <th> le président </th>
            <th>L'examinateur </th>
            <th>L'invité </th>
            <th>Numéro de demande </th>
          </tr>
        </thead>
        <tbody align="center">
     
          <tr>
       <td>Nom jury</td>
        <td><input type='text' name='nom_jury_president'  ></td>
        <td><input type='text' name='nom_jury_examinateur'  ></td> 
        <td><input type='text' name='nom_jury_invite'  ></td> 
        <td rowspan="4" >
        <select name="id_soutenance" id="id_soutenance"><br>
              <?php  $select_encadrant = "SELECT 	id_soutenance FROM soutenance where email_encadrant = '$EMAIL' AND validation_encadrant = '$TRUE' ";
              $result = $conn->query($select_encadrant);
              while ($row = $result->fetch_assoc()){  ?>
                  <option value="<?php echo $row['id_soutenance']; ?>"><?php echo $row['id_soutenance']; ?></option>
        <?php } ?>
       </select></td>
          </tr>
          <tr>
          <td>prenom jury</td>
   <td><input type='text' name='prenom_jury_president'  required></td>
   <td><input type='text' name='prenom_jury_examinateur' required ></td> 
   <td><input type='text' name='prenom_jury_invite' required ></td> 
    </tr>
    <tr>
   <td>etablissement</td>
     <td><input type='text' name='etablissement_jury_president' required></td> 
     <td><input type='text' name='etablissement_jury_examinateur' required></td> 
     <td><input type='text' name='etablissement_jury_invite' required></td> 
    </tr>
    <tr>
    <td>email jury</td>
   <td><input type='email' name='email_jury_president' required></td>
   <td><input type='email' name='email_jury_examinateur' required></td>
   <td><input type='email' name='email_jury_invite' required></td>
          </tr>
    <tr>
 
    </tr>
        </tbody>
      </table>
      <p>Date de soutenance</p>
      <input type="datetime-local" name="date_soutenance" required>
      <center><button type="submit" name="button" class="btn btn-primary">Enregister</button></center>
</form>
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