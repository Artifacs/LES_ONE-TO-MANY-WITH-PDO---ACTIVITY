<?php
/** includes/functions.php - helpers shared by the parent (clients) and child (projects) pages. */

const STATUSES = ['Planned', 'In Progress', 'Completed'];

function e($v): string { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }

function redirect(string $url, string $type = '', string $msg = ''): never {
    if ($msg !== '') { if (session_status() === PHP_SESSION_NONE) session_start(); $_SESSION['flash'] = ['type' => $type, 'message' => $msg]; }
    header("Location: $url"); exit;
}

/** Reads + validates the CLIENT (parent) form. Returns [data, errors]. */
function validateClient(array $p): array {
    $d = [];
    foreach (['company_name','contact_person','email','phone_number','industry'] as $f) $d[$f] = trim($p[$f] ?? '');
    $err = [];
    foreach ($d as $f => $v) if ($v === '') $err[] = ucwords(str_replace('_', ' ', $f)) . ' is required.';
    if ($d['email'] !== '' && !filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $err[] = 'Email is not valid.';
    return [$d, $err];
}

/** Reads + validates the PROJECT (child) form. Returns [data, errors]. */
function validateProject(array $p): array {
    $d = [];
    foreach (['project_name','service_type','status','budget','start_date','deadline'] as $f) $d[$f] = trim($p[$f] ?? '');
    $err = [];
    if ($d['project_name'] === '') $err[] = 'Project name is required.';
    if ($d['service_type'] === '') $err[] = 'Service type is required.';
    if (!in_array($d['status'], STATUSES, true)) $err[] = 'Choose a valid status.';
    if (!is_numeric($d['budget']) || (float) $d['budget'] < 0) $err[] = 'Budget must be a positive number.';
    foreach (['start_date', 'deadline'] as $f) {
        $dt = DateTime::createFromFormat('Y-m-d', $d[$f]);
        if (!$dt || $dt->format('Y-m-d') !== $d[$f]) $err[] = ucwords(str_replace('_', ' ', $f)) . ' must be a valid date.';
    }
    if (!$err && $d['deadline'] < $d['start_date']) $err[] = 'Deadline cannot be before the start date.';
    return [$d, $err];
}
