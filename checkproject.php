<?php
require('./config/db.php');
require('./config/actions.php');
if (isset($_SESSION['ROLE'])){
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Volet de navigation</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
        <?php include './includes/sidenav.php'?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Risk Management</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Administration</li>
                        </ol>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><?php echo delais($_GET['checkproject']); ?></div>
                                </div>
                            </div>
                            <?php if($_SESSION['ROLE']==2){?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Nombre des risques critiques: <?php echo nombretachecritiquebytypeandproject($_SESSION['ROLE'],$_SESSION['idrisque'],$_GET['checkproject']); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#risk">Voir les statistiques</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Nombre de personnel avec tache active: <?php echo nombrepersonnelbytypeandproject($_SESSION['ROLE'],$_SESSION['idrisque'],$_GET['checkproject']); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#risk">Voir les statistiques</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="card mb-4" id="listeprojet">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Assigner une tache
                                                        </div>
                            <div class="card-body">
                            <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Ajouter une tache</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="./config/actions.php" name="assignertache">
                                            <div class="row mb-3">
                                                <div style="display:none;" class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <?php echo "<input class='form-control' id='projetid' type='text' name='projetid' value='".$_GET['checkproject']."'/>"; ?>                                                       
                                                    <?php echo checkprojects($_GET['checkproject']); ?>
                                                </div>
                                                </div>
                                                <div  class="form-floating mb-3">
                                                    <div>
                                                        <select class="form-control" id="personnelselect" name="personnelselect" required/>
                                                        <label for="personnelselect">Personnel</label>
                                                        <option value="">--- Selectionner Personnel ---</option>  
                                                        <?php echo showpersonneltoselect(); ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="description" name="description" type="text" required/>
                                                <label for="description">Description</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-control" id="prioriteselect" name="prioriteselect" required/>
                                                        <label for="prioriteselect">Priorité</label>
                                                        <option value="">--- Selectionner Priorité ---</option>  
                                                        <option value="1">Mineur</option>  
                                                        <option value="2">Majeur</option>  
                                                        <option value="3">Grave</option>  
                                                        <option value="4">Catastrophique</option>  
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-control" id="probabiliteselect" name="probabiliteselect" required/>
                                                        <label for="probabiliteselect">Probabilité</label>
                                                        <option value="">--- Selectionner Probabilité ---</option>  
                                                        <option value="1">Improbable</option>  
                                                        <option value="2">Peu Probable</option>  
                                                        <option value="3">Probable</option>  
                                                        <option value="4">Très Probable</option>  
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <?php  if($_SESSION['ROLE'] == 2) {
                                           echo "<input style='display:none;' class='form-control' id='typerisquenow' type='text' name='typerisquenow' value='".$_SESSION["idrisque"]."'/>";
                                             echo "<label style='display:none;' for='typerisquenow'>".$_SESSION["nomrisque"]."</label>";
                                                }else if($_SESSION['ROLE'] == 1){?>
                                                   <select class="form-control" id="typerisquenow" name="typerisquenow" required/>
                                                        <label for="probabiliteselect">Selectionné type risque</label>
                                                        <option value="">--- Selectionner Risque ---</option>  
                                                        <option value="1">Technique</option>  
                                                        <option value="2">Humain</option>  
                                                        <option value="3">Juridique</option>  
                                                        <option value="4">Delais</option>
                                                        <option value="5">Intrinseque</option>    
                                                    </select>
                                                    <?php } ?>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <center>
                                            <input type="submit" value="Assigner la tache" name="assignertache" class="btn btn-primary btn-block"></input>
</center>
                                            </div>
                                        </form>
                                    </div>
</br>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
</div>

                        </div>
                        <div class="card mb-4" id="listeprojet">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Liste des taches
                                                        </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nom du projet</th>
                                            <th>Description de la tache</th>
                                            <th>Assigné à</th>
                                            <th>Criticité du risque</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
if($_SESSION['ROLE'] == 2)
showtachesperprojects($_GET['checkproject'],$_SESSION['idrisque']);
else if($_SESSION['ROLE'] == 1)
showtachesperproject($_GET['checkproject']);

?>
                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" id="risk">
                        <?php  if($_SESSION['ROLE'] == 1){ echo'<center>';}?>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Nombre de personnels avec tache assignée par projet
                                    </div>
                                    <img src="./assets/img/matrice.PNG" width="500" height="500"></img>
                
                                   <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>-->
                                </div>
                            </div>
                            <?php  if($_SESSION['ROLE'] == 1){ echo'</center>';} ?>
                            <?php  if($_SESSION['ROLE'] == 2){ ?>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Nombre des taches avec priorité critique non réalisé par projet
                                    </div>
                                    <?php 
                               
                                    if($_SESSION['idrisque'] == 1){echo '<div class="card-body"><canvas id="myTacheChartTechnique" width="100%" height="40"></canvas></div>';}
                                    else if($_SESSION['idrisque'] == 2){echo '<div class="card-body"><canvas id="myTacheChartHumaine" width="100%" height="40"></canvas></div>';}
                                    else if($_SESSION['idrisque'] == 3){echo '<div class="card-body"><canvas id="myTacheChartJuridique" width="100%" height="40"></canvas></div>';}
                                    else if($_SESSION['idrisque'] == 4){echo '<div class="card-body"><canvas id="myTacheChartDelais" width="100%" height="40"></canvas></div>';}
                                    else if($_SESSION['idrisque'] == 5){echo '<div class="card-body"><canvas id="myTacheChartIntrinseque" width="100%" height="40"></canvas></div>';};
                                ?>
                                </div>
                            </div>
                       <?php }  ?>
                        </div>
                    </div>
                </main>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/chartpersoperproj.js"></script>
        <script src="js/tachecritique.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php }else {header('location:login.php');} ?>