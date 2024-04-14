<?php
// Include config file
require '../../../config/database.php';    
$db = new Database();
$con = $db->conectar();

// Define variables and initialize with empty values
$IDpres = $IDusuario = $Fecha_pres = $Valor_pres = $CantidadCuotas = $ValorCuotas = $EstadoPres = "";
$IDpres_err = $IDusuario_err = $Fecha_pres_err = $Valor_pres_err = $CantidadCuotas_err = $ValorCuotas_err = $EstadoPres_err = "";

// Get the ID from the URL parameter
$IDpres = $_GET['id'] ?? null;

// Get the current row from the database
$sql = "SELECT * FROM pagos WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_IDpres);
    // Set parameters
    $param_IDpres = $IDpres;
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        /* Store result */
        mysqli_stmt_store_result($stmt);
        // Bind result variables
        mysqli_stmt_bind_result($stmt, $IDpres, $IDusuario, $Fecha_pres, $Valor_pres, $CantidadCuotas, $ValorCuotas, $EstadoPres);
        // Fetch the results
        if (mysqli_stmt_fetch($stmt)) {
            // Assign values to variables
        }
    } else {
        echo "Error executing query: " . mysqli_stmt_error($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing query: " . mysqli_error($link);
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

      // Validate Id
     // $IDusuario_err = empty(trim($_POST["id"])) ? "Por favor escoga departamento." : "";
    
      $IDusuario = !empty(trim($_POST["id"])) ? trim($_POST["id"]) : $IDusuario;
  

    // Validate ValorCuotas
    $ValorCuotas_err = empty(trim($_POST["IDdep"])) ? "Por favor escoga departamento." : "";
    
    $IDdep = !empty(trim($_POST["IDdep"])) ? trim($_POST["IDdep"]) : $IDdep;

    // Validate EstadoPres
    $EstadoPres_err = empty(trim($_POST["nombreciudad"])) ? "Por favor ponga el nombre de la ciudad." : "";
    
    $NombreCiudad = !empty(trim($_POST["nombreciudad"])) ? trim($_POST["nombreciudad"]) : $NombreCiudad;



    // Check input errors before updating in database
    if (empty($ValorCuotas_err) && empty($EstadoPres_err) ) {

        // Prepare an update statement
        $sql = "UPDATE pagos SET numpagos=?, idcliente=? WHERE id =?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issdiss", $param_IDciu, $param_NombreCiu, $param_IDdep);

            // Set parameters
            $param_IDciu = $IDusuario;
            $param_NombreCiu = $NombreCiudad;
            $param_IDdep = $IDdep;
        
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to list page
                header("location: ../crud-Ciudad.php");
                exit();
            } else {
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
    <title>Edit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn {
        margin-top: 10px;
        margin-bottom: 10px;
        /* Agrega un margen inferior de 5 píxeles */
    }
    </style>
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Actualizar Pagos</h2>
                    </div>
                    <p>Edita los campos de pagos, si es necesario</p>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        
                    <div class="form-group <?php echo (!empty($IDusuario_err)) ? 'has-error' : ''; ?>">
                            <label>ID del Usuario</label>
                            <select name="IDdep" class="form-control">
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
                 
                    <div class="form-group <?php echo (!empty($EstadoPres_err)) ? 'has-error' : ''; ?>">
                            <label>Numero de Pagos</label>
                            <input type="text" name="nombreciudad" class="form-control"
                                value="<?php echo $EstadoPres; ?>">
                            <span class="help-block"><?php echo $EstadoPres_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $IDpres; ?>" />
                        <input type="submit" class="btn btn-primary" value="Editar">
                        <a href="../crud-Pagos.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>