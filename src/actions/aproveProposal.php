<?php
require_once '../../app/assets/header.php';

if (!isset($_GET['id']) || !isset($_GET['diasEmAnalise']))
{
    $_SESSION['notification'] = 'Erro ao aceitar proposta: Faltando id ou dias em analise.';
    header('Location: ../../app/comercial');
    exit();
}

require_once '../../src/DatabaseConnection.php';
require_once '../../src/DataRepository.php';

$conn = new DatabaseConnection();
$data = new DataRepositoy($conn->start());
$affectedRows = $data->update('propostas', ['statusProposta' => 'Aceita', 'diasEmAnalise' => $_GET['diasEmAnalise']], ['id' => $_GET['id']]);

if ($affectedRows > 0)
{
    $_SESSION['notification'] = 'Proposta aceita com sucesso. Movida para "Financeiro".';
    header('Location: ../../app/comercial');
    exit();
}

$_SESSION['notification'] = 'Erro ao aceitar proposta. Nenhuma modificada.';
header('Location: ../../app/comercial');