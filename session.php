<?php
require_once ("connexion.php");

$email_account = $_POST['email_account'];
$passwd = $_POST['passwd'];
//$passwd = md5($passwd);
$query = "select t_account, email_account, passwd, user_name from account where email_account = '$email_account' and passwd = '$passwd' ";
$result = $conn->query($query);
$row = $result->fetch_assoc(); 
	if( $row['t_account'] == "etudiant" && $row['email_account'] == $email_account && $row['passwd'] == $passwd){
        session_start(); 
        $_SESSION['NIV']=$row['t_account'];
        $_SESSION['USERNAME']=$row['user_name'];
        $_SESSION['EMAIL'] = $email_account;
        header('Location: ./etudiant/index.php');
        }   
    else if($row['t_account'] == "encadrant" && $row['email_account'] == $email_account && $row['passwd'] == $passwd){ 
        session_start();
        $_SESSION['NIV']=$row['t_account'];
        $_SESSION['USERNAME']=$row['user_name'];
        $_SESSION['EMAIL'] = $email_account;
        header('Location: ./encadrant/index.php');
        }
    else if($row['t_account'] == "administrateur" && $row['email_account'] == $email_account && $row['passwd'] == $passwd){ 
        session_start();
        $_SESSION['NIV']=$row['t_account'];
        $_SESSION['USERNAME']=$row['user_name'];
        $_SESSION['EMAIL']= $email_account;
        header('Location: ./administrateur/index.php');
                }
    else { echo "
        <html>
</script>
<body> 
<script> 
if(confirm('email ou password incorrect')) {
    window.location.href = 'index.php';
}
else {
    window.location.href = 'index.php';
}
</script>
</body> 
</html";
        
     }
        
?>
