<?php
/** client_edit.php - form pre-filled with one client; submits to client_update.php. */
session_start();
require_once 'config/dbconfig.php';
require_once 'includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM clients WHERE client_id = :id");
$stmt->execute([':id' => $id]);
$client = $stmt->fetch();
if (!$client) redirect('index.php', 'error', 'Client not found.');

$v = $_SESSION['old'] ?? $client; unset($_SESSION['old']);
$title = 'Edit Client';
include 'includes/header.php';
?>
<h1>Edit Client #<?= (int) $client['client_id'] ?></h1>
<section class="card">
    <form action="client_update.php" method="post">
        <input type="hidden" name="client_id" value="<?= (int) $client['client_id'] ?>">
        <?php include 'includes/client_fields.php'; ?>
        <button class="btn primary" type="submit">Save Changes</button>
        <a class="btn" href="index.php">Cancel</a>
    </form>
</section>
</main></body></html>
