<?php
require_once _DIR_ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) {
    header('Location: agendamentos.php'); exit;
}

$id   = (int) ($_POST['id'] ?? 0);
$stmt = $pdo->prepare("UPDATE agendamentos SET status = 'cancelado' WHERE id = :id AND status = 'agendado'");
$stmt->execute([':id' => $id]);
$_SESSION['flash'] = $stmt->rowCount() ? 'Agendamento cancelado.' : 'Agendamento não encontrado ou já processado.';
header('Location: agendamentos.php');
exit;

<?php
require_once _DIR_ . '/conexao.php';
require_once _DIR_ . '/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_SESSION['csrf'] ?? '') === '' || !hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    header('Location: agendamentos.php'); exit;
}

$id   = (int) ($_POST['id'] ?? 0);
$stmt = $pdo->prepare("UPDATE agendamentos SET status = 'cancelado' WHERE id = :id AND status = 'agendado'");
$stmt->execute([':id' => $id]);
$_SESSION['flash'] = $stmt->rowCount() ? 'Agendamento cancelado.' : 'Agendamento não encontrado ou já processado.';
header('Location: agendamentos.php');
exit;