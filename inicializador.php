<?php

$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;


$collection = $db->createCollection("usuarios");
$collection2 = $db->createCollection("foto_perfil");
$collection3 = $db->createCollection("pacientes");
$collection4 = $db->createCollection("peticionAlta");
$collection5 = $db->createCollection("plantilla_paciente");
$collection6 = $db->createCollection("plantilla_test");
$collection7 = $db->createCollection("tags");
$collection8 = $db->createCollection("test");



$document = array( 'DNI' => '1234', 'Número_de_colegiado' => '45', 'Apellido_1' => 'Administrador', 'Apellido_2' => 'Administrador', 'Nombre' => 'Administrador', 'Teléfono' => '678543219', 'Dirección' => 'Mi casa', 'Especialidad_Médica' => 'Neurologia', 'Hospital' => 'La princesa', 'Tipo' => '0', 'Contraseña' => "Admin");
$collection->insert($document);
//$collection8->remove(array('DNI'=>"1234"));



//$username = "testUser";
  //$password = "testPassword";

  // insert the user - note that the password gets hashed as 'username:mongo:password'
  // set readOnly to true if user should not have insert/delete privs
  //$collection = $db->selectCollection("system.users");
  //$collection->insert(array('user' => $username, 'pwd' => md5($username . ":mongo:" . $password), 'readOnly' => false));
echo "Inicializado";
?>