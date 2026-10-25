<?php
/** client_delete.php - DELETE a parent record. ON DELETE CASCADE also removes its projects. */
session_start();
require_once 'config/dbconfig.php';
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php');

$stmt = $pdo->prepare("DELETE FROM clients WHERE client_id = :id");
$stmt->execute([':id' => (int) ($_POST['client_id'] ?? 0)]);
$stmt->rowCount() > 0 ? redirect('index.php', 'success', 'Client (and its projects) deleted.')
                      : redirect('index.php', 'error', 'Client not found.');
