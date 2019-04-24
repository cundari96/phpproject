<?php
$nome = $_GET['nome1'];
$idade = $_GET['idade1'];
$dsn = 'pgsql:dbname=aulaphp;host=127.0.0.1';
$user = 'postgres'; //root
$password = 'admlinux';//senha no mysql = vazio
try {
$dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
$count = $dbh->exec("insert into exemplo1(nome, idade) 
                values('$nome', '$idade') ");
echo "<p>$count registro foi incluído</p>";
echo "<br><br><a href=index.php>Voltar</a>  ";
?>

© 2019 GitHub, Inc.