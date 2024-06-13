<?php  require_once('Funcion.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/Trabajo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .parallax {
          background-image: url(imagenes/opg.2.jpg);
    
          min-height: 1000px;
    
          background-attachment: fixed;
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
      </style>
</head>
<body>
    <div class="parallax">
    <h1>Has tu pedido</h1>

     <?php 
  $username_con="root";
  $password_con ="";
  $hostname_con="p:localhost";
  $database_con="cafeteria";
  $con=mysqli_connect($hostname_con, $username_con, $password_con, $database_con);
  mysqli_set_charset($con, 'utf8');
  
  $query_DatosConsulta = sprintf("SELECT * FROM bocadillos");
  $DatosConsulta = mysqli_query($con, $query_DatosConsulta) or die(mysqli_error($con));
  $row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
  $totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
  
   $query_DatosConsultaU = sprintf("SELECT * FROM bocadillos WHERE Np= 8");
   $DatosConsultaU = mysqli_query($con, $query_DatosConsultaU) or die(mysqli_error($con));
   $row_DatosConsultaU = mysqli_fetch_assoc($DatosConsultaU);
   $totalRows_DatosConsultaU = mysqli_num_rows($DatosConsultaU);
  
    if($totalRows_DatosConsulta > 0){
      do { 
       echo $row_DatosConsulta["Np"];
       echo " ";
       echo $row_DatosConsulta["Nombre"];
       echo " ";
       echo $row_DatosConsulta["Sabor"];
       echo " ";
       echo $row_DatosConsulta["Tamaño"];
       echo"<br>";
      } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta));
    }   
  
    if((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formInsertar"))  {
      $insertSQL = sprintf("INSERT INTO bocadillos (Nombre, Sabor, Tamaño) VALUES (%s, %s, %s)",
        GetSQLValueString($_POST["strNombre"], "text"),
        GetSQLValueString($_POST["strSabor"], "text"),
        GetSQLValueString($_POST["strTamaño"], "text"));
      $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
      $insertGoTo = "Pedidos.php";
      header(sprintf("Location: %s", $insertGoTo));
     }
  
    if((isset($_POST["mm_eliminar"])) && ($_POST["mm_eliminar"] == "formDel"))  {
       $query_Delete = sprintf("DELETE FROM bocadillos WHERE Np = %s",
       GetSQLValueString($_POST["strBorrar"], "text"));
       $result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
       $insertarGoTo = "Pedidos.php";
       header(sprintf("Location: %s", $insertarGoTo));
    }
  
    if((isset($_POST["MM_Update"])) && ($_POST["MM_Update"] == "formActualizar")) {
      $UpdateSQL = sprintf("UPDATE bocadillos SET Nombre=%s, Sabor=%s, Tamaño=%s WHERE Np=8",
      GetSQLValueString($_POST["strNombre"], "text"),
      GetSQLValueString($_POST["strSabor"], "text"),
      GetSQLValueString($_POST["strTamaño"], "text"),
      GetSQLValueString(8, "text"));
      $result1 = mysqli_query($con, $UpdateSQL) or die(mysqli_error($con));
      $insertGoTo = "Pedidos.php";
      //echo "ACTUALIZAR REGISTROS"
      header(sprintf("Location: %s", $insertGoTo));
     }
  
  ?>
  
       <form action="Pedidos.php" method="Post" id="formInsertar" role="form" name="formInsertar">
          <div class="form-group">
            <label>Nombre:</label>
            <input name="strNombre" class="form-Control" id="strNombre" type="text" placeholder="Escribir Nombre">
          </div>
          <br>
          <div class="form-group">
            <label>Sabor:</label>
            <input name="strSabor" class="form-Control" id="strSabor" type="text" placeholder="Escribir el sabor">
          </div>
          <br>
          <div class="form-group">
            <label>Tamaño:</label>
            <input name="strTamaño" class="form-Control" id="strTamaño" type="text" placeholder="Escribir el Tamaño">
          </div>
          <br>
          <input name="MM_insert" type="hidden" id="MM_insert" value="formInsertar">
          <button type="submit" class="btn btn-success">Añadir</button>  
        </form>
  
       
        <form action="Pedidos.php" method="Post" id="formDel" role="form" name="formDel">
          <div class="form-group">
            <label>Borrar:</label>
            <input name="strBorrar" class="form-Control" id="strBorrar" type="text" placeholder="Registro para eliminar">
            <input name="mm_eliminar" type="hidden" id="mm_eliminar" value="formDel">
            <button type="submit" class="btn btn-warning">Borrar</button>
          </div>
        </form>
  
       <form action="Pedidos.php" method="Post" id="formActualizar" role="form" name="formActualizar">
       <div class="form-group">
          <label>Nombre:</label>
          <input name="strNombre" class="form-Control" id="strNombre" type="text" placeholder="Escribir Nombre" value="<?php echo $row_DatosConsultaU["Nombre"];?>">
          </div>
          <br>
        <div class="form-group">
          <label>Sabor:</label>
          <input name="strSabor" class="form-Control" id="strSabor" type="text" placeholder="Escribir el sabor" value= "<?php echo $row_DatosConsultaU["Sabor"]; ?>">
        </div>
        <br>
        <div class="form-group">
          <label>Tamaño:</label>
          <input name="strTamaño" class="form-Control" id="strTamaño" type="text" placeholder="Escribir el Tamaño" value= "<?php echo $row_DatosConsultaU["Tamaño"]; ?>">
        </div>
        <br>
       <input name="MM_Update" type="hidden" id="MM_Update" value="formActualizar">
       <button type="submit" class="btn btn-primary">Actualizar</button> 
      </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>