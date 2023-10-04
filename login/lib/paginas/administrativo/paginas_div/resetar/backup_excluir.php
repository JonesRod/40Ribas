<?php
include('conexao.php');

// Nome do arquivo de backup
$backupFile = 'backup_' . date('Y-m-d') . '.sql';

// Comando para realizar o backup
$commandBackup = "mysqldump --user={$usuario} --password={$senha} --host={$host} {$banco} > {$backupFile}";

// Executa o comando de backup
system($commandBackup);

// Verifica se a conexão foi estabelecida
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Obtém a lista de tabelas no banco de dados
$result = $mysqli->query("SHOW TABLES");
$tables = [];

while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Exclui todos os dados das tabelas
foreach ($tables as $table) {
    $mysqli->query("DELETE FROM $table");
}

// Fecha a conexão
$mysqli->close();

echo "Backup realizado e dados excluídos com sucesso.";
?>
