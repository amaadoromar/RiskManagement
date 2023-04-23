<?php
include "db.php";
session_start();


if(isset($_GET['deletemanager']))
{
    $id=$_GET["deletemanager"];
    $query_delete_article = "DELETE FROM managers WHERE idpersonnel = $id ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $query_delete_article = "DELETE FROM personnel WHERE idpersonnel = $id ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $location="../managers.php";

    if(!$delete_article)
    {
        echo (mysqli_error($connection));
    }
   header('Location:'.$location);
}


if(isset($_GET['deletepersonnel']))
{
    $id=$_GET["deletepersonnel"];

    $sql="select * from tache where idpersonnel = $id";
	$res=mysqli_query($connection,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
    $query_delete_article = "DELETE FROM tache WHERE idpersonnel = $id ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    }

    $query_delete_article = "DELETE FROM personnel WHERE idpersonnel = $id ;";
    $delete_article = mysqli_query($connection,$query_delete_article);

    $location="../personnels.php";

    if(!$delete_article)
    {
        echo (mysqli_error($connection));
    }
   header('Location:'.$location);
}


if(isset($_POST['assignertache'])){
    include "db.php";
    $id = $_POST["projetid"];
    $personnelid = $_POST["personnelselect"];
    $priorite = $_POST["prioriteselect"];
    $probabilite = $_POST["probabiliteselect"];
    $description = $_POST["description"];
    $typerisque = $_POST["typerisquenow"];

    $query_add_article = "INSERT INTO tache(idprojet, idpersonnel, priorite,idtyperisque,description,probabilite)
    VALUES ('$id', '$personnelid', '$priorite', '$typerisque', '$description', '$probabilite');";
    $insert_new_article = mysqli_query($connection,$query_add_article);
    $location="../panel.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
   header('Location:'.$location);
   
}

if(isset($_POST['addpersonnel'])){
    include "db.php";
  
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $idrisque = $_POST["typerisquenow"];
    $role = $_POST["role"];

    $query_add_article = "INSERT INTO personnel(nom, prenom, user, password, role)
    VALUES ('$nom', '$prenom', '$username', '$password', '$role');";
    $insert_new_article = mysqli_query($connection,$query_add_article);

    if($role == 2){
       $query_projects = "SELECT * FROM personnel ORDER BY idpersonnel DESC LIMIT 1";
       $select_projects = mysqli_query($connection,$query_projects);
       while ($row = mysqli_fetch_assoc($select_projects)){
        $idpersonnel = $row['idpersonnel'];
        $query_add_article = "INSERT INTO managers(idpersonnel,idtyperisque)
        VALUES ('$idpersonnel', '$idrisque');";
        $insert_new_article = mysqli_query($connection,$query_add_article);
       }
       $location="../managers.php";
    }
    else{
        $location="../personnels.php";
    }

   
    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
    header('Location:'.$location);
   
}

if(isset($_POST['addproject'])){
    include "db.php";
  
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $datedebut = $_POST["datedebut"];
    $datefin = $_POST["datefin"];

    $query_add_article = "INSERT INTO projects(nom, description, datedebut,datefin)
    VALUES ('$nom', '$description', '$datedebut', '$datefin');";
    $insert_new_article = mysqli_query($connection,$query_add_article);
    $location="../panel.php";

   
    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
    header('Location:'.$location);
   
}


function countprojectsbytype($role,$type){
    include "db.php";
    if (isset($role))
     {
    $query_projects = "SELECT COUNT(DISTINCT projects.idprojet) as count FROM projects,tache WHERE projects.idprojet = tache.idprojet and tache.idtyperisque = $type LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['count'] . "</td>";
    }
}

function nombretachecritiquebytype($role,$type){
    include "db.php";
    if (isset($role))
     {
    $query_projects = "SELECT COUNT(*) FROM tache WHERE tache.priorite = 4 and tache.idtyperisque = $type LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function nombretachecritiquebytypeandproject($role,$type,$idproject){
    include "db.php";
    if (isset($role))
     {
    $query_projects = "SELECT COUNT(*) FROM tache WHERE tache.priorite = 4 and tache.idtyperisque = $type and idprojet = $idproject LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function nombrepersonnelbytypeandproject($role,$type,$idproject){
    include "db.php";
    if (isset($role))
     {
    $query_projects = "SELECT COUNT(DISTINCT idpersonnel) as count FROM tache WHERE tache.idtyperisque = $type and idprojet = $idproject LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['count'] . "</td>";
    }
}

function nombrepersonnelbytype($role,$type){
    include "db.php";
    if (isset($role))
     {
    $query_projects = "SELECT COUNT(*) FROM tache WHERE tache.idtyperisque = $type LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function nommanager($typerisque){
    include "db.php";
    $query_projects = "SELECT personnel.nom as NOM,personnel.prenom as PRENOM FROM personnel,managers WHERE personnel.idpersonnel = managers.idpersonnel and managers.idtyperisque = $typerisque LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td> <h5>Manager</h5> M./Mme : ". $row['NOM'] . " " . $row['PRENOM'] . "</td>";
    }

}

function delais($id){
    include "db.php";
    $query_projects = "SELECT *  from projects where projects.idprojet = $id LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td> <h5>Délais à respecter</h5>Nom Projet : " . $row['nom'] . "<br /> Date Début : ". $row['datedebut'] . "<br /> Date Fin : " . $row['datefin'] . "</td>";
    }

}


function nombrepersonnel($role){
    include "db.php";
    if ($role == 1)
     {
    $query_projects = "SELECT COUNT(*) FROM personnel where role > 1 and role != 2 LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
    }
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function nombremanager($role){
    include "db.php";
    if ($role == 1)
     {
    $query_projects = "SELECT COUNT(*) FROM personnel where role > 1 and role = 2 LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
    }
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function nombretachecritique($role) {
    include "db.php";
    if ($role == 1)
     {
    $query_projects = "SELECT COUNT(*) FROM tache LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }
}

function showtachespersonnel($id){
    include "db.php";
    $query_projects = "SELECT projects.datedebut as datedebut,projects.datefin as datefin,projects.nom as NOM,projects.description as descrip,tache.priorite as priorite,tache.probabilite as probabilite,tache.description as description FROM tache,projects where tache.idpersonnel = $id and projects.idprojet = tache.idprojet";
    $select_projects = mysqli_query($connection,$query_projects);
    while ($projects = mysqli_fetch_assoc($select_projects)){
        $nom=$projects['NOM'];
        $description=$projects['descrip'];
        $tache=$projects['description'];
        $datedebut=$projects['datedebut'];
        $datefin=$projects['datefin'];
        $priorite=$projects['priorite'];
        $probabilite=$projects['probabilite'];
        echo "<tr>";
        echo "<td>" . $nom . "</td>";
        echo "<td>" . $description . "</td>";
        echo "<td>" . $datedebut . "</td>";
        echo "<td>" . $datefin . "</td>";
        echo "<td>" . $tache . "</td>";
        matricerisque($priorite,$probabilite);
        echo "</tr>";
    }
}

function showtachesperproject($idprojet){
    include "db.php";
    $query_projects = "SELECT projects.nom as NOM,projects.description as descrip,tache.priorite as priorite,tache.probabilite as probabilite,tache.description as description, personnel.nom as nompersonnel,personnel.prenom as prenompersonnel FROM tache,personnel,projects where personnel.idpersonnel = tache.idpersonnel and projects.idprojet = tache.idprojet and tache.idprojet = $idprojet";
    $select_projects = mysqli_query($connection,$query_projects);
    while ($projects = mysqli_fetch_assoc($select_projects)){
        $nom=$projects['NOM'];
        $description=$projects['descrip'];
        $nompersonnel=$projects['nompersonnel'];
        $prenompersonnel=$projects['prenompersonnel'];
        $priorite=$projects['priorite'];
        $probabilite=$projects['probabilite'];
        echo "<tr>";
        echo "<td>" . $nom . "</td>";
        echo "<td>" . $description . "</td>";
        echo "<td>" . $nompersonnel . " "  . $prenompersonnel . "</td>";
        matricerisque($priorite,$probabilite);
        echo "</tr>";
    }
}

function showtachesperprojects($idprojet,$idtyperisque){
    include "db.php";
    $query_projects = "SELECT projects.nom as NOM,projects.description as descrip,tache.priorite as priorite,tache.probabilite as probabilite,tache.description as description, personnel.nom as nompersonnel,personnel.prenom as prenompersonnel FROM tache,personnel,projects where personnel.idpersonnel = tache.idpersonnel and projects.idprojet = tache.idprojet and tache.idprojet = $idprojet and tache.idtyperisque = $idtyperisque";
    $select_projects = mysqli_query($connection,$query_projects);
    while ($projects = mysqli_fetch_assoc($select_projects)){
        $nom=$projects['NOM'];
        $description=$projects['descrip'];
        $nompersonnel=$projects['nompersonnel'];
        $prenompersonnel=$projects['prenompersonnel'];
        $priorite=$projects['priorite'];
        $probabilite=$projects['probabilite'];
        echo "<tr>";
        echo "<td>" . $nom . "</td>";
        echo "<td>" . $description . "</td>";
        echo "<td>" . $nompersonnel . " "  . $prenompersonnel . "</td>";
        matricerisque($priorite,$probabilite);
        echo "</tr>";
    }
}

function matricerisque($priorite,$probabilite){
    if  ($priorite == 1)
    {
      if($probabilite == 1){echo "<td><button type='button' style='color:black;background-color:#F9F865;border-color:white;' class='btn btn-warning'>Impact Mineur et improbable</button></td>";}
    else if ($probabilite == 2){echo "<td><button type='button' style='color:black;background-color:#F9F955;border-color:white;' class='btn btn-warning'>Impact Mineur et peu probable</button></td>";}
    else if ($probabilite == 3){echo "<td><button type='button' style='color:white;background-color:#FFD964;border-color:white;' class='btn btn-warning'>Impact Mineur et probable</button></td>";}
    else if ($probabilite == 4){echo "<td><button type='button' style='color:white;background-color:#FFD75B;border-color:white;' class='btn btn-warning'>Impact Mineur et Très probable</button></td>";}
    }
    else if ($priorite == 2)
    {
      if($probabilite == 1){echo "<td><button type='button' style='color:black;background-color:#F9F865;border-color:white;' class='btn btn-warning'>Impact Majeur et improbable</button></td>";}
    else if ($probabilite == 2){echo "<td><button type='button' style='color:white;background-color:#FFD964;border-color:white;' class='btn btn-warning'>Impact Majeur et peu probable</button></td>";}
    else if ($probabilite == 3){echo "<td><button type='button' style='color:white;background-color:#FFD659;border-color:white;' class='btn btn-warning'>Impact Majeur et probable</button></td>";}
    else if ($probabilite == 4){echo "<td><button type='button' style='color:white;background-color:#F94C4D;border-color:white;' class='btn btn-warning'>Impact Majeur et Très probable</button></td>";}
    }
    else if ($priorite == 3)
    {
      if($probabilite == 1){echo "<td><button type='button' style='color:black;background-color:#FFD964;border-color:white;' class='btn btn-warning'>Impact Grave et improbable</button></td>";}
    else if ($probabilite == 2){echo "<td><button type='button' style='color:white;background-color:#FFD553;border-color:white;' class='btn btn-warning' >Impact Grave et peu probable</button></td>";}
    else if ($probabilite == 3){echo "<td><button type='button' style='color:white;background-color:#F94C4E;border-color:white;' class='btn btn-warning'>Impact Grave et probable</button></td>";}
    else if ($probabilite == 4){echo "<td><button type='button' style='color:white;background-color:#F93939;border-color:white;' class='btn btn-warning'>Impact Grave et Très probable</button></td>";}
    }
    else if ($priorite == 4)
    {
      if($probabilite == 1){echo "<td><button type='button' class='btn btn-warning' style='color:black;background-color:#FFD964;border-color:white;' >Impact Catastrophique et improbable</button></td>";}
    else if ($probabilite == 2){echo "<td><button type='button' class='btn btn-warning' style='color:white;background-color:#F96266;border-color:white;'>Impact Catastrophique et peu probable</button></td>";}
    else if ($probabilite == 3){echo "<td><button type='button' class='btn btn-warning'style='color:white;background-color:#F94C4E;border-color:white;'>Impact Catastrophique et probable</button></td>";}
    else if ($probabilite == 4){echo "<td><button type='button' class='btn btn-warning'style='color:white;background-color:#800000;border-color:white;'>Impact Catastrophique et Très probable</button></td>";}
    }
}


function showtaches($typerisque) {
    include "db.php";
    $query_projects = "SELECT typerisque.nom as type,projects.nom as PR,personnel.nom as NOM,personnel.prenom as PRENOM,tache.description as descrip,tache.priorite as priorite,tache.probabilite as probabilite FROM projects,tache,personnel,typerisque WHERE projects.idprojet = tache.idprojet and personnel.idpersonnel = tache.idpersonnel and tache.idtyperisque = typerisque.idtype and  typerisque.idtype = $typerisque";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $prnom=$projects['PR'];
    $description=$projects['descrip'];
    $nom=$projects['NOM'];
	$prenom=$projects['PRENOM'];
    $typerisque = $projects['type'];
    $priorite=$projects['priorite'];
    $probabilite=$projects['probabilite'];
    echo "<tr>";
    echo "<td>" . $prnom . "</td>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $nom . " "  . $prenom . "</td>";
    echo "<td>". $typerisque ."</td>";
    matricerisque($priorite,$probabilite);
    echo "</tr>";
  }
}


function countprojects($role) {
    include "db.php";
    if ($role == 1)
     {
    $query_projects = "SELECT COUNT(*) FROM projects LIMIT 1";
    $select_projects = mysqli_query($connection,$query_projects);
}
    while ($row = mysqli_fetch_assoc($select_projects)){
    echo "<td>". $row['COUNT(*)'] . "</td>";
    }

}


function showmanagers() {
    include "db.php";
    $query_projects = "SELECT managers.idpersonnel as id,personnel.nom as NOM,personnel.prenom as PRENOM,typerisque.nom as RISQUE FROM managers,personnel,typerisque WHERE managers.idpersonnel = personnel.idpersonnel and managers.idtyperisque = typerisque.idtype";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['id'];
    $nom=$projects['NOM'];
    $prenom=$projects['PRENOM'];
    $risque=$projects['RISQUE'];
    echo "<tr>";
    echo "<td>" . $nom . "</td>";
    echo "<td>" . $prenom . "</td>";
    echo "<td>" . $risque . "</td>";
    if($_SESSION['ROLE'] == 1){
    echo "<td><a style='color:white;' href='./config/actions.php?deletemanager=". $id ."'<button type=\"button\" class=\"btn btn-danger\">Supprimer</button></td>";
    }
    echo "</tr>";
  }
}

function showpersonnels($role) {
    include "db.php";
    $query_projects = "SELECT personnel.idpersonnel as id,personnel.nom as NOM,personnel.prenom as PRENOM FROM personnel where role = 3";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['id'];
    $nom=$projects['NOM'];
    $prenom=$projects['PRENOM'];
    echo "<tr>";
    echo "<td>" . $nom . "</td>";
    echo "<td>" . $prenom . "</td>";
    if($role == 1)
    {
    echo "<td><a style='color:white;' href='./config/actions.php?deletepersonnel=". $id ."'<button type=\"button\" class=\"btn btn-danger\">Supprimer</button></a>
    </td>";
    }
  }
}

function checkprojects($id){
    include "db.php";
    $query_projects = "SELECT * FROM projects where idprojet = $id";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $nom=$projects['nom'];
    echo "<label for='projetid'>".$nom."</label>";
    }
}

function showpersonnetoselect() {
    include "db.php";
    $query_projects = "SELECT * from personnel WHERE role = 3";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['idpersonnel'];
    $nom=$projects['nom'];
    $prenom=$projects['prenom'];
    echo "<option value='".$id."'>".$nom . " " . $prenom ."</option> ";
  }
}

function showpersonneltoselect() {
    include "db.php";
    $query_projects = "SELECT * from personnel WHERE role = 3";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['idpersonnel'];
    $nom=$projects['nom'];
    $prenom=$projects['prenom'];
    echo "<option value='".$id."'>".$nom . " " . $prenom ."</option> ";
  }
}

function showprojectsparrisque($risque) {
    include "db.php";
    $query_projects = "SELECT DISTINCT(tache.idprojet) as idprojet,projects.nom as NOM,projects.description as projdesc,projects.datedebut as datedebut,projects.datefin as datefin from tache,projects where tache.idprojet = projects.idprojet and idtyperisque = $risque";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['idprojet'];
    $nom=$projects['NOM'];
    $description=$projects['projdesc'];
    $datedebut=$projects['datedebut'];
	$datefin=$projects['datefin'];
    echo "<tr>";
    echo "<td>" . $nom . "</td>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $datedebut . "</td>";
    echo "<td>" . $datefin . "</td>";
    echo "<td><a style='color:white;' href='./checkproject.php?checkproject=". $id ."'<button type=\"button\" class=\"btn btn-info\">Consulter</button></td>";
    echo "</tr>";
  }
}

function showprojects() {
    include "db.php";
    $query_projects = "SELECT * FROM projects";
    $select_projects = mysqli_query($connection,$query_projects);
    while($projects = mysqli_fetch_assoc($select_projects))
    {
    $id = $projects['idprojet'];
    $nom=$projects['nom'];
    $description=$projects['description'];
    $datedebut=$projects['datedebut'];
	$datefin=$projects['datefin'];
    echo "<tr>";
    echo "<td>" . $nom . "</td>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $datedebut . "</td>";
    echo "<td>" . $datefin . "</td>";
    echo "<td><a style='color:white;' href='./checkproject.php?checkproject=". $id ."'<button type=\"button\" class=\"btn btn-info\">Consulter</button></td>";
    echo "</tr>";
  }
}

if(isset($_SESSION['ROLE'])){
    if(isset($_GET["id_thematique"]))
    {
        $id = $_GET["id_thematique"];
      //  $query_delete_article = "DELETE FROM indicateurs WHERE id_thematique = $id ;";
      //  $delete_article = mysqli_query($connection,$query_delete_article);
        $query_delete_article = "DELETE FROM thematiques WHERE id_thematique = $id ;";
        $delete_article = mysqli_query($connection,$query_delete_article);
        $location="../thematiques.php";
    
        if(!$delete_article)
        {
            echo (mysqli_error($connection));
            
        }
       header('Location:'.$location);
       
    }

    if(isset($_POST["updatethematique"]))
    {
        $nom = $_POST["nom"];
        $id_category = $_POST["idcategory"];
        $id = $_POST["id"];
        $query_update_article = "UPDATE thematiques SET titre  = '$nom' ,  id_categories  = $id_category WHERE  id_thematique = $id ;";
        $insert_new_article = mysqli_query($connection,$query_update_article);
        $location="../thematiques.php";
    
        if(!$insert_new_article)
        {
            echo (mysqli_error($connection));
            
        }
       header('Location:'.$location);
       
    }

    if(isset($_POST["addthematique"]))
{
    $nom = $_POST["nom"];
    $id_category = $_POST["idcategory"];
    $query_add_article = "INSERT INTO thematiques(id_categories,titre)
    VALUES ('$id_category','$nom');";
    $insert_new_article = mysqli_query($connection,$query_add_article);
    $location="../thematiques.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
   header('Location:'.$location);
   
}
    if(isset($_GET["id_category"]))
    {
        $id = $_GET["id_category"];
    //    $query_delete_article = "DELETE FROM indicateurs WHERE id_categories = $id ;";
     //   $delete_article = mysqli_query($connection,$query_delete_article);
        $query_delete_article = "DELETE FROM thematiques WHERE id_categories = $id ;";
        $delete_article = mysqli_query($connection,$query_delete_article);
        $query_delete_article = "DELETE FROM categories WHERE  id = $id ;";
        $delete_article = mysqli_query($connection,$query_delete_article);
        $location="../categories.php";
    
        if(!$delete_article)
        {
            echo (mysqli_error($connection));
            
        }
       header('Location:'.$location);
       
    }

    if(isset($_POST["updatecategorie"]))
    {
        $nom = $_POST["nom"];
        $id = $_POST["id"];
        $query_update_article = "UPDATE categories SET category_name  = '$nom' WHERE  id = $id ;";
        $insert_new_article = mysqli_query($connection,$query_update_article);
        $location="../categories.php";
    
        if(!$insert_new_article)
        {
            echo (mysqli_error($connection));
            
        }
       header('Location:'.$location);
       
    }

    if(isset($_POST["addcategorie"]))
{
    $nom = $_POST["nom"];

    $query_add_article = "INSERT INTO categories(category_name)
    VALUES ('$nom');";
    $insert_new_article = mysqli_query($connection,$query_add_article);
    $location="../categories.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
   header('Location:'.$location);
   
}

    if(isset($_GET['id_existindicateur']))
{
    $id_newindicateur=$_GET["id_existindicateur"];
    $query_delete_article = "DELETE FROM indicateurs WHERE id_indicateur = $id_newindicateur ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $query_delete_article = "DELETE FROM data WHERE id_indicateur = $id_newindicateur ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $location="../indicateurs.php";

    if(!$delete_article)
    {
        echo (mysqli_error($connection));
    }
   header('Location:'.$location);
}


if(isset($_GET['id_newindicateur']))
{
    $id_newindicateur=$_GET["id_newindicateur"];
    $query_delete_article = "DELETE FROM indicateurs WHERE id_indicateur = $id_newindicateur ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $location="../newindicateurs.php";

    if(!$delete_article)
    {
        echo (mysqli_error($connection));
    }
   header('Location:'.$location);
}

if(isset($_GET['id_newindicateur']))
{
    $id_newindicateur=$_GET["id_newindicateur"];
    $query_delete_article = "DELETE FROM indicateurs WHERE id_indicateur = $id_newindicateur ;";
    $delete_article = mysqli_query($connection,$query_delete_article);
    $location="../newindicateurs.php";

    if(!$delete_article)
    {
        echo (mysqli_error($connection));
    }
   header('Location:'.$location);
}

if(isset($_POST["addindicateur"]))
{
    $definition = $_POST["definition"];
    $unite = $_POST["unite"];
    $indication = $_POST["indication"];
    $source = $_POST["source"];
    $periodicite = $_POST["periodicite"];
    $couverture = $_POST["couverture"];
    $categorie = $_POST["categorie"];

    $query_add_article = "INSERT INTO indicateurs(definition, unite, indication,source,periodicite,couverture,id_categories)
    VALUES ('$definition', '$unite', '$indication', '$source', '$periodicite', '$couverture', '$categorie');";
    $insert_new_article = mysqli_query($connection,$query_add_article);
    $location="../newindicateurs.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
        
    }
   header('Location:'.$location);
   
}

if(isset($_POST["updateindicateur"]))
{
    $annee = 22;
    $id_indicateur  = $_POST['indicateur'];
    $id_thematique = $_POST['thematique'];
    for ($i = 1; $i <= $annee; $i++)
     {
        if(!(empty($_POST["$i"]))){
            $j = $_POST["$i"];
            $query_count = "SELECT * FROM data where id_indicateur = $id_indicateur and id_annee = $i ";
            $count = mysqli_query($connection,$query_count);
            $rows = mysqli_num_rows($count);
            if($rows > 0)
            {
    $query_add_article = "UPDATE data SET valeur = $j WHERE id_indicateur = '$id_indicateur' and id_annee = $i ";
      $insert_new_article = mysqli_query($connection,$query_add_article); 
            }
            else{
            $query_add_article = "INSERT INTO data (id_annee , id_indicateur, valeur) VALUES('$i' , '$id_indicateur', '$j')";
            $insert_new_article = mysqli_query($connection,$query_add_article);
            }
      }
      }
    
      $query_add_article = "UPDATE indicateurs SET id_thematique = '$id_thematique' WHERE id_indicateur = '$id_indicateur' ";
      $insert_new_article = mysqli_query($connection,$query_add_article); 
    $location="../indicateurs.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
       
    }
 header('Location:'.$location);
}

//presidents forms for backend 
if(isset($_POST["updateindicateurnew"]))
{
    $annee = 22;
    $id_indicateur  = $_POST['indicateur'];
    $id_thematique = $_POST['thematique'];
    for ($i = 1; $i <= $annee; $i++)
     {
        if(!(empty($_POST["$i"]))){
            $j = $_POST["$i"];
            $query_add_article = "INSERT INTO data (id_annee , id_indicateur, valeur) VALUES('$i' , '$id_indicateur', '$j')";
            $insert_new_article = mysqli_query($connection,$query_add_article);
      }
      }
    
      $query_add_article = "UPDATE indicateurs SET id_thematique = '$id_thematique' WHERE id_indicateur = '$id_indicateur' ";
      $insert_new_article = mysqli_query($connection,$query_add_article); 
   $location="../newindicateurs.php";

    if(!$insert_new_article)
    {
        echo (mysqli_error($connection));
       
    }
    header('Location:'.$location);
}

}

?>