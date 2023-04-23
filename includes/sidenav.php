<?php
if(isset($_SESSION['ROLE'])){
    if ($_SESSION['ROLE'] == 1){
?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home Page</div>
                            <a class="nav-link" href="panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Espace Admin
                            </a>
                            <div class="sb-sidenav-menu-heading">Risques</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Listes des risques
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="TechniquesAD.php">Techniques</a>
                                    <a class="nav-link" href="HumainsAD.php">Humaines</a>
                                    <a class="nav-link" href="JuridiquesAD.php">Juridiques</a>
                                    <a class="nav-link" href="DelaisAD.php">Délais</a>
                                    <a class="nav-link" href="IntrinsequesAD.php">Intrinsèques</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Accès direct</div>
                            <a class="nav-link" href="#risk">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistiques
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Listes des personnels
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion1">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="managers.php">Managers</a>
                                    <a class="nav-link" href="personnels.php">Employés</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que:</div>
                        <?php echo 'Administrateur : M. ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'];?>
                    </div>
                </nav>
            </div>
<?php } else if ($_SESSION['ROLE'] == 2) { ?>
    <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home Page</div>
                            <a class="nav-link" href="panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Espace Manager
                            </a>
                            <div class="sb-sidenav-menu-heading">Risques</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Listes des risques
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if($_SESSION['idrisque'] == 1) { ?>
                                    <a class="nav-link" href="TechniquesAD.php">Techniques</a>
                                    <?php } else if($_SESSION['idrisque'] == 2){?>
                                    <a class="nav-link" href="HumainsAD.php">Humaines</a>
                                    <?php } else if($_SESSION['idrisque'] == 3){?>
                                    <a class="nav-link" href="JuridiquesAD.php">Juridiques</a>
                                    <?php } else if($_SESSION['idrisque'] == 4){?>
                                    <a class="nav-link" href="DelaisAD.php">Délais</a>
                                    <?php } else if($_SESSION['idrisque'] == 5){?>
                                    <a class="nav-link" href="IntrinsequesAD.php">Intrinsèques</a>
                                    <?php }?>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Accès direct</div>
                            <a class="nav-link" href="#risk">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistiques
                            </a>
                            <a class="nav-link" href="projects.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Liste des projets
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Listes des personnels
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion1">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="managers.php">Managers</a>
                                    <a class="nav-link" href="personnels.php">Employés</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que:</div>
                        <?php echo 'Manager : M/Mme ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'];?>
                    </div>
                </nav>
            </div>
<?php } else if ($_SESSION['ROLE'] == 3) { ?>
    <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home Page</div>
                            <a class="nav-link" href="personnelpage.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Espace Personnel
                            </a>
                            <div class="sb-sidenav-menu-heading">Accès direct</div>
                            <a class="nav-link" href="#risk">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Statistiques
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que:</div>
                        <?php echo 'Personnel : M/Mme ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'];?>
                    </div>
                </nav>
            </div>
<?php }}?> 