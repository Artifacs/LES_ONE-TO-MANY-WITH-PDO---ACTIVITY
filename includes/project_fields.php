<?php /** Shared PROJECT (child) input fields. Expects $v = current values. */ ?>
<div class="grid">
    <label>Project name <input type="text" name="project_name" maxlength="120" required value="<?= e($v['project_name'] ?? '') ?>"></label>
    <label>Service type <input type="text" name="service_type" maxlength="60" placeholder="e.g. ETL Pipeline, Data Warehouse" required value="<?= e($v['service_type'] ?? '') ?>"></label>
    <label>Status
        <select name="status">
            <?php foreach (STATUSES as $s): ?><option <?= ($v['status'] ?? 'Planned') === $s ? 'selected' : '' ?>><?= e($s) ?></option><?php endforeach; ?>
        </select></label>
    <label>Budget (PHP) <input type="number" name="budget" min="0" step="0.01" required value="<?= e($v['budget'] ?? '') ?>"></label>
    <label>Start date <input type="date" name="start_date" required value="<?= e($v['start_date'] ?? '') ?>"></label>
    <label>Deadline <input type="date" name="deadline" required value="<?= e($v['deadline'] ?? '') ?>"></label>
</div>
