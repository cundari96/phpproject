<?php
$dsn = 'pgsql:dbname=trabalho tec pra internet 2;host=127.0.0.1';
$user = 'root'; 
$password = '';

$conn = mysqli_connect ($servername,$username,$password,$dbname);

$requestData = $_REQUEST;

$columns = array(
    array( '0' => 'nome' ),
    array( '1' => 'salario' ),
    array( '2' => 'idade' ),
     
);
//resultado apresentado sem qualquer pesquisa
$result_user = "SELECT nome, salario, idade, FROM usuarios";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//dados a serem apresentados
$result_usuarios = "SELECT nome, salario, idade FROM usuarios WHERE 1=1";
if( !empty($requestData['search']['value']){
	$result_usuarios.="AND (nome LIKE '".$requestData['search']['value']."%'   ";
	$result_usuarios.="OR (salario LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.="OR (idade LIKE '".$requestData['search']['value']."%' )";
	
	
$resultado_usuarios=mysqli_query($conn,$result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//ordernar o resultado
$result_usuarios.= " ORDER BY ". $colums [$requestData['order'] [0] ['column']]."    ".$requestData['order'][0]['dir']."   LIMIT " . $requestData['start']."  ,".$requestData['length']."    ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

//ler e criar array de dados
$dados = array();
while ( $row_usuarios=msqli_fetch_array ($resultado_usuarios)) {
	$dado = array();
	$dado[] = $row_usuarios["nome"];
	$dado[] = $row_usuarios["salario"];
	$dado[] = $row_usuarios["idade"];
	
	$dados[] = $dado;
}


//excluir dados do usuario
$name=$_GET['nome'];

try {
$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
$count = $dbh->exec("delete from  exemplo1 
                   where name=$nome ");

echo "<p>$count registro foi excluído</p>";

echo "<br><br>
<a href=index.php>Voltar</a> ";

//incluir dados
try {
$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
$count = $dbh->exec("insert into exemplo1(nome, idade, salario) 
                values('$nome', '$idade', '$salario') ");
echo "<p>$count registro foi incluído</p>";
echo "<br><br><a href=index.php>Voltar</a>  ";


//informações a serem retornadas para o jv.
$json_data = array(
	"draw": intval ($requestData['draw'] ), //para cada requisição é enviado um numero como parametro
	"recordsTotal": intval($qnt_linhas),//quantidade de registros que há no banco de dados.
	"recordsFiltered": intval ($totalFiltered),//total de registros qnd houver pesquisa
	"data" => $dados //array de dados completo dos dados a serem retornados da tabela
);

echo json_enconde($json_data);


