<?php	
	include('cabecalho.php');
	$row=null;
	$result=null;
	if (($_GET["codigo"]!=null)){
		$sql	= "SELECT codigo,nome FROM categoria where (codigo=0".$_GET["codigo"].")";
		$result=mysql_query($sql, $link);
		$row = mysql_fetch_assoc($result);
	}
?>
<form method="post">
		<table border="1">
		<tr>
			<td>codigo:<input type="text" name="codigo" value="<?php if ($result!=null) echo $row["codigo"]?>"></td>
		</tr>
		<tr>
			<td>categoria:<input type="text" name="nome" value="<?php if ($result!=null) echo $row["categoria"]?>"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="acao" value="inserir">
				<input type="submit" name="acao" value="alterar">
				<input type="submit" name="acao" value="excluir">
				<input type="button" value="limpar" onclick="self.location.href='?codigo'">
			</td>
		</tr>
		<?php
			
			if ($_POST['acao']=='excluir'){
				$sql = 'delete FROM categoria where codigo='.$_POST["codigo"];
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if ($_POST ['acao']=='alterar'){
				$sql = "update categoria set nome='".$_POST["nome"]."' where (codigo=".$_POST["codigo"].");";
				//echo $sql;
				mysql_query($sql, $link);
			}
			else if( $_POST['acao']=='inserir'){
				$sql = "insert into categoria (nome) values ('".$_POST["nome"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}
				else if( $_POST['acao']=='inserir'){
				$sql    = "insert into categoria (nome) values ('".$_POST["nome"]."');";
				//echo $sql;
				mysql_query($sql, $link);
			}			
		?>
		<table border="1">
			<tr>
				<td>codigo</td>
				<td>categoria</td>
			</tr>
		<?php
			if ($result!=null){
				mysql_free_result($result);
			}
			$sql    = 'SELECT codigo,categoria FROM categoria order by categoria nome asc;';
			$result = mysql_query($sql, $link);
			if (!$result) {
				echo "Erro do banco de dados, n�o foi possivel consultar o banco de dados\n";
				echo 'Erro MySQL: ' . mysql_error();
				exit;
			}
			while ($row = mysql_fetch_assoc($result)){
		?>
				<tr>
					<td><a href="?codigo=<?php echo $row['codigo'];?>"><?php echo $row['codigo'];?><a/></td>
					<td><?php echo $row['nome'];?>&nbsp </td>       
				</tr>
			<?php
				}
				mysql_free_result($result);
			?>
			</table>
		</table>
</form>
<?php
	include('rodape.php');
?>
