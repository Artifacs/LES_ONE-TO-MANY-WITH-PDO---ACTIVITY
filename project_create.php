<?php
/** project_create.php - INSERT a child record; client_id is the foreign key to the parent. */
session_start();
require_once 'config/dbconfig.php';
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php');

$clientId = (int) ($_POST['client_id'] ?? 0);
[$d, $err] = validateProject($_POST);
if ($err) { $_SESSION['errors'] = $err; $_SESSION['old'] = $d; redirect("projects.php?client_id=$clientId"); }

try {
    $stmt = $pdo->prepare("INSERT INTO projects (client_id, project_name, service_type, status, budget, start_date, deadline)
                           VALUES (:client_id, :project_name, :service_type, :status, :budget, :start_date, :deadline)");
    $d['client_id'] = $clientId;
    $stmt->execute($d);
    redirect("projects.php?client_id=$clientId", 'success', 'Project added.');
} catch (PDOException $ex) {
    // 1452 = the parent client does not exist (foreign key fails)
    $_SESSION['errors'] = [$ex->errorInfo[1] === 1452 ? 'That client does not exist.' : 'Database error: ' . $ex->getMessage()];
    redirect('index.php');
}
