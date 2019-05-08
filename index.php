<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>TRABALHO</title>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('#listar-usuario').DataTable({			
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "proc_pesq_user.php",
					"type": "POST"
				}
			});
		} );
		</script>
	</head>
	<body>
		<h1>Listar usuários</h1>
		<table id="listar-usuario" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Salario</th>
					<th>Idade</th>
				</tr>

				<form action=salvar.php>
			<p>Nome</p>
			<input type=text name=nome1>
			<p>Idade</p>
			<input type=number name=idade1>
			<br><br>
			<p>salario</p>
			<input type=number name=salario1>
			<br><br>
			<input type=submit value=Salvar>
			</form> 
			<br><br>
			<a href=formulario.php>Voltar</a> 
			</thead>
		</table>		
	</body>
</html>
