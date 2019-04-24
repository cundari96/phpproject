<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "danyel";

$conn = mysqli_connect($servername, $username, $password, $dbname);


$requestData= $_REQUEST;



$columns = array( 
	0 =>'nome', 
	1 => 'idade',
	2=> 'salario'
);


$result_user = "SELECT nome, salario, idade FROM usuarios";
$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);


$result_usuarios = "SELECT nome,idade,salario FROM usuarios WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   
	$result_usuarios.=" AND ( nome LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR idade LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR salario LIKE '".$requestData['search']['value']."%' )";
}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);


$dados = array();
while( $row_usuarios =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row_usuarios["nome"];
	$dado[] = $row_usuarios["idade"];
	$dado[] = $row_usuarios["salario"];	
	$dados[] = $dado;
}



$json_data = array(
	"draw" => intval( $requestData['draw'] ),
	"recordsTotal" => intval( $qnt_linhas ),  
	"recordsFiltered" => intval( $totalFiltered ), 
	"data" => $dados   
);

echo json_encode($json_data); 
