<?php
/** project_edit.php - form pre-filled with one project; submits to project_update.php. */
session_start();
require_once 'config/dbconfig.php';
require_once 'includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
// JOIN so we can show which client (parent) the project belongs to
$stmt = $pdo->prepare("SELECT p.*, c.company_name FROM projects p
                       INNER JOIN clients c ON c.client_id = p.client_id WHERE p.project_id = :id");
$stmt->execute([':id' => $id]);
$project = $stmt->fetch();
if (!$project) redirect('index.php', 'error', 'Project not found.');

$v = $_SESSION['old'] ?? $project; unset($_SESSION['old']);
$title = 'Edit Project';
include 'includes/header.php';
?>
<h1>Edit Project #<?= (int) $project['project_id'] ?></h1>
<p class="muted">Client: <?= e($project['company_name']) ?></p>
<section class="card">
    <form action="project_update.php" method="post">
        <input type="hidden" name="project_id" value="<?= (int) $project['project_id'] ?>">
        <input type="hidden" name="client_id" value="<?= (int) $project['client_id'] ?>">
        <?php include 'includes/project_fields.php'; ?>
        <button class="btn primary" type="submit">Save Changes</button>
        <a class="btn" href="projects.php?client_id=<?= (int) $project['client_id'] ?>">Cancel</a>
    </form>
</section>
</main></body></html>
