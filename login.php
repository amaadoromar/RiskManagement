<?php
require('./config/db.php');
session_start();
$error='';

if(isset($_POST['login'])){
    session_start();
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="select * from personnel where user='$username' and password='$password'";
	$res=mysqli_query($connection,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['role'];
		$_SESSION['IS_LOGIN']='yes';
        $_SESSION['nom']=$row['nom'];
        $_SESSION['prenom']=$row['prenom'];
        $_SESSION['id'] = $row['idpersonnel'];
        if($row['role']== 2)
        {
        $sql="select typerisque.nom AS nomrisque,typerisque.idtype AS idrisque from managers,typerisque where managers.idpersonnel =" .$_SESSION['id'] ." and typerisque.idtype = managers.idtyperisque";
	    $res=mysqli_query($connection,$sql);
	    $count=mysqli_num_rows($res);
	     if($count>0){
		   $row=mysqli_fetch_assoc($res);
           $_SESSION['nomrisque'] = $row['nomrisque'];
           $_SESSION['idrisque'] = $row['idrisque'];
        }
    }
    if($_SESSION['ROLE'] == 1)
    {
			header('location:panel.php');
			die();
        }
    else if($_SESSION['ROLE'] == 2)
    {
       if($row['idrisque'] == 1){
           header('location:TechniquesAD.php');
        die();}
       if($row['idrisque'] == 2){
        header('location:HumainsAD.php');
        die();
       }
       if($row['idrisque'] == 3){
        header('location:JuridiquesAD.php');
        die();
       }
       if($row['idrisque'] == 4){
        header('location:DelaisAD.php');
        die();
       }
       if($row['idrisque'] == 5){
        header('location:IntrinsequesAD.php');
        die();
       }
    }
    else if ($_SESSION['ROLE'] == 3)
    {
        header('location:personnelpage.php');
        die();
    }
	}else{
		$error='Please enter correct login details';
	}
}
else if(isset($_SESSION['IS_LOGIN'])){
    header('location:panel.php');
    die();
};
if(!(isset($_SESSION['IS_LOGIN']))){
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Espace administratif</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Espace Administratif</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="login.php">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username"  name="username" placeholder="Nom d'utilisateur" />
                                                <label for="inputEmail">Nom d'utilisateur</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Mot de passe" />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" name="login" class="btn btn-primary">Se Connecter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Risk Management 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php } ?>