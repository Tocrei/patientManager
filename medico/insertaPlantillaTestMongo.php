<?php
	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$plan = $db->plantilla_test;
$tag = $db->tags;
	


$doc = array();	
$t = 1;
$parse =  str_replace(' ','_',$_POST['Nombre_de_la_plantilla']);
$funciona = array("Campo_1"=>$parse, "Campo_2"=>$_POST['Médico']);
echo $funciona;
$res = $plan->remove($funciona);

foreach($_POST as $nombre_campo => $valor){ 
	$campo = "Campo_" . $t;
	IF(is_null($valor) or $valor == "")
	{
	}
	  else {
	  	$valor = str_replace(' ','_',ucfirst($valor));
	  	$doc[$campo] = $valor;
		if(strcmp($campo, "Campo_3") == 0)
		{	
			$existe = $tag->findOne(array('Etiqueta' => $valor));
			if(is_null($existe)){
				$tags = array("Etiqueta"=>$valor, "Contador"=>1);
				$tag->insert($tags);
			}else{
				$incremento = array('$inc'=>array("Contador"=>1), '$set' =>array("Etiqueta"=>$valor));
				$tag->update(array("Etiqueta"=>$valor), $incremento);
			}
		}
	   	$t++;
		}
}


$plan->insert($doc);

header("Location: indexMedico.php");

	
?>