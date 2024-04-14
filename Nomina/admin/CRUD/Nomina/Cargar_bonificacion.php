<?php
session_start();
require '../../../config/database.php';


if($_GET['idbonificacion']==1)

{

    $sql="SELECT * FROM bonificaciones where  IDBonificacion = 1";
                           $result = mysqli_query($link, $sql);
                           while ($row9 = mysqli_fetch_array($result)) {
                            $valorauxilio=$row9['MontoBonificacion'];
                        }


}
else
$valorauxilio=0;

$salario=$_GET['salario'];
$parafiscales=$_GET['parafiscales'];
$valorcuotas=$_GET['valorcuotas'];
$idusuario=$_GET['idusuario'];
$idbonificacion=$_GET['idbonificacion'];



                           echo "<script>location.href='create-nom.php?idbonificacion=".$idbonificacion."&&idusuario=".$idusuario."&&salario=".$salario."&&valorcuotas=".$valorcuotas."&&parafiscales=".$parafiscales."&&valorauxilio=".$valorauxilio."'</script>";

?>