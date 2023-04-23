<?php
include "../config/db.php";
header('Content-Type: application/json; charset=utf-8');
if(isset($_GET['idtype']))
{
    $idtype = $_GET['idtype'];
    $query = "SELECT projects.nom AS NOM,COUNT(*) AS NOMBRE FROM projects,tache where projects.idprojet = tache.idprojet and tache.idtyperisque = $idtype  and tache.priorite = 4 group by tache.idprojet";
    $select_query = mysqli_query($connection,$query);
   $options = array();
    while($data = mysqli_fetch_assoc($select_query)){
        $options[] = $data;
      //  $options ['nombre'] = $data['NOMBRE'];
         }
    echo json_encode($options);
}
else{
    $query = "SELECT projects.nom AS NOM,COUNT(*) AS NOMBRE FROM projects,tache where projects.idprojet = tache.idprojet and tache.priorite = 4 group by tache.idprojet";
    $select_query = mysqli_query($connection,$query);
   $options = array();
    while($data = mysqli_fetch_assoc($select_query)){
        $options[] = $data;
      //  $options ['nombre'] = $data['NOMBRE'];
         }
     echo json_encode($options);
    }
?>