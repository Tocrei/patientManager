<?php

session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];

if( !isset($_FILES['archivo']) ){
  echo 'Ha habido un error, tienes que elegir un archivo<br/>';
  echo '<a href="index.html">Subir archivo</a>';
}else{

  $nombre = $_FILES['archivo']['name'];
  $nombre_tmp = $_FILES['archivo']['tmp_name'];
  $tipo = $_FILES['archivo']['type'];
  $tamano = $_FILES['archivo']['size'];

  $ext_permitidas = array('jpg','jpeg','gif','png','application/pdf');
  $partes_nombre = explode('.', $nombre);
  $extension = end( $partes_nombre );
  $ext_correcta = in_array($extension, $ext_permitidas);

  $tipo_correcto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipo);

  $limite = 5000000 * 1024;
  echo $tamano;
  echo $nombre;
  echo $tipo;
  echo $limite;

  if( $tamano <= $limite ){
    if( $_FILES['archivo']['error'] > 0 ){
      echo 'Error: ' . $_FILES['archivo']['error'] . '<br/>';
    }else{
      echo 'Nombre: ' . $nombre . '<br/>';
      echo 'Tipo: ' . $tipo . '<br/>';
      echo 'Tamaño: ' . ($tamano / 1024) . ' Kb<br/>';
      echo 'Guardado en: ' . $nombre_tmp;

      if( file_exists( 'subidas/'.$nombre) ){
        echo '<br/>El archivo ya existe: ' . $nombre;
      }else{
        move_uploaded_file($nombre_tmp,
          "..//documentos//" . $dni . "//" . $nombre);

        echo "<br/>Guardado en: " . "..//documentos//" . $dni . "//" . $nombre;
      }
    }
  }else{
    echo 'Archivo inválido';
  }
}
?>