<?php
/** project_delete.php - DELETE one child record (the parent client stays). */
session_start();
require_once 'config/dbconfig.php';
require_once 'includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php');

$clientId = (int) ($_POST['client_id'] ?? 0);
$stmt = $pdo->prepare("DELETE FROM projects WHERE project_id = :id");
$stmt->execute([':id' => (int) ($_POST['project_id'] ?? 0)]);
$stmt->rowCount() > 0 ? redirect("projects.php?client_id=$clientId", 'success', 'Project deleted.')
                      : redirect("projects.php?client_id=$clientId", 'error', 'Project not found.');
