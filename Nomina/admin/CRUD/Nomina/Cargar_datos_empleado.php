<?php
session_start();
require '../../../config/database.php';


$sql="SELECT n.* FROM cargo n,usuario u where n.IDcargo = u.IDcargo and u.IDusuario=".$_GET['idusuario'];
                           $result = mysqli_query($link, $sql);
                           while ($row9 = mysqli_fetch_array($result)) {
                            $salario=$row9['SalarioCargo'];
                        }


                        $sql="SELECT n.* FROM prestamos n,usuario u where n.IDusuario = u.IDusuario and u.IDusuario=".$_GET['idusuario'];
                           $result = mysqli_query($link, $sql);
                           while ($row9 = mysqli_fetch_array($result)) {
                            $valorcuotas=$row9['ValorCuotas'];
                        }

                        $sql="SELECT * FROM parafiscales";
                           $result = mysqli_query($link, $sql);
                           while ($row9 = mysqli_fetch_array($result)) {
                               if($row9['TipoParafiscal']  =="Pension")  
                                    $pension=$row9['TasaParafiscal'];
                                if($row9['TipoParafiscal']  =="Salud")  
                                    $salud=$row9['TasaParafiscal'];
                                if($row9['TipoParafiscal']  =="Arl")  
                                    $arl=$row9['TasaParafiscal'];

                       
                        }

                      $parafiscales=($salario*$salud)+($salario*$pension)+($salario*$arl);

                  //    $sql="select u.*,b.MontoBonificacion from usuario u,bonificaciones b where u.";

if($valorcuotas=="")
   $valorcuotas=0;
                           echo "<script>location.href='create-nom.php?idusuario=".$_GET['idusuario']."&&salario=".$salario."&&valorcuotas=".$valorcuotas."&&parafiscales=".$parafiscales."'</script>";

?>