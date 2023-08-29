<?php
$nombre = $_POST['nombre' ];
$apellido = $_POST['apellido' ];
$password = $_POST ['password' ];
$edad = $_POST ['edad' ];
$email = $_POST ['email' ];
$materia = $_POST ['materia' ];
$celular  = $_POST ['celular' ];

if (!empty($nombre)|| !empty($apellido)||!empty($password) ||
!empty($edad) || !empty($email)|| !empty($materia)|| !empty($celular)){
    $host ="localhost" ;
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "proyecto";
    $conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);
    if (mysqli_connect_errno()){
        die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $SELECT = "SELECT celular from usuario where celular = ? limit 1";
        $INSERT = "INSERT INTO usuario (nombre, apellido,passwork,edad,email,materia,celular) value (?,?,?,?,?,?,?)";
        $stmt = $conn -> prepare($SELECT);
        $stmt->bind_param("i",$celular);
        $stmt -> execute();
        $stmt ->bind_result($celular);
        $stmt ->store_result();
        $rnum =$stmt ->num_rows;
        if($rnum== 0){
            $stmt ->close();
            $stmt = $conn -> prepare($INSERT);
            $stmt->bind_param("ssssssi",$nombre,$apellido,$password,$edad,$email,$materia,$celular);
            $stmt -> execute();

            echo "Registro completado. ";

        }
        else{
            echo " numero ya registrado. ";
        }
        $stmt -> close();
        $conn -> close();
    }

}
else {
    echo "todos los datos son obligatorios";
    die();
}




?>