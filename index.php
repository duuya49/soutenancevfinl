<?php
require_once ("connexion.php");
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Bienvenue!!</title>
<meta charset="utf-8">
<meta name="keywords" content="Graduation a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

<link href="style/theme.css" rel='stylesheet' type='text/css' >
 <link href="style/bootstrap.css" rel='stylesheet' type='text/css' /> 
</head>
<body>
<!-- TOP HEADER -->
<div class="top">
	<div class="container">
	 <div class="row">
		   <div class="col-md-6 top-left">
			  <img src="style/img/logo.png" alt="Accueil">		
		    </div>
		
		    <div class="col-md-6 top-right">
			<button onclick="myFunction()">Toggle dark mode</button>
			 <a href="#pop" onclick="document.getElementById('modal-wrapper').style.display='block'"><span></span> Connexion</a>
		    </div>
	  </div>
		<div class="clearfix"></div>
	</div>
</div>

<!-- Pop-Up -->
<div id="modal-wrapper" class="modal">
  
  <form class="modal-content animate" action="session.php" method="POST">
        
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="style/img/avatar.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center">Gestion Des PFE</h1>
    </div>

    <div class="container">
		<center><input type="email" placeholder="Enter Username" name="email_account" id="email_account">
		<input type="password" placeholder="Enter Password" name="passwd" id="passwd">  
		<button type="submit" name="submit" id="submit">Se Connecter</button></center>
           
    </div>
    
  </form>
  
</div>
<!-- Pop-Up -->	
<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}



</script>
</body>
</html>


