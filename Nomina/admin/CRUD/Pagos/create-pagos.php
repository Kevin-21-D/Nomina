<?php
// Include config file
require '../../../config/database.php';    
$db = new Database();
$con = $db->conectar();
 
// Define variables and initialize with empty values
$name = "";
$name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["numpagos"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el numero de pagos.";
    } else{
        $name = $input_name;
    }
    

    $input_name1 = trim($_POST["IDusuario"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el numero de pagos.";
    } else{
        $IDusuario = $input_name1;
    }
   
    

    // Check input errors before inserting in database
    if(empty($name_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pagos (numpagos,idcliente) VALUES (?,?) ";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name,$param_idusuario);
            
            // Set parameters
            $param_name = $name;
            $param_idusuario=$IDusuario;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../crud-Ciudad.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Departamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Agregar Pago</h2>
                    </div>
                    <p>Favor diligenciar el siguiente formulario para agregar un nuevo pago.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                    <div class="form-group <?php echo (!empty($IDusuario_err)) ? 'has-error' : ''; ?>">
                            <label>ID del Usuario</label>
                            <select name="IDusuario" class="form-control">
                                <option value="" disabled selected>Seleccionar un Usuario</option>
                                <?php
                                // Query para obtener los usuarios existentes
                                $sql = "SELECT IDusuario, Nombre, Apellido FROM usuario";
                                $result = mysqli_query($link, $sql);

                                // Iterar sobre los resultados y crear opciones para el select
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['IDusuario'] . "'";
                                    if ($IDusuario == $row['IDusuario']) {
                                        echo "selected";
                                    }
                                    echo "<option>" . $row['Nombre'] ." ". $row['Apellido'] . "</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $IDusuario_err; ?></span>
                        </div>
                    
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Numero de Pagos</label>
                            <input type="text" name="numpagos" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Agregar">
                        <a href="../crud-Ciudad.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
