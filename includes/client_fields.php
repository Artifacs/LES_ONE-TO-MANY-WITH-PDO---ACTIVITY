<?php /** Shared CLIENT (parent) input fields. Expects $v = current values. */ ?>
<div class="grid">
    <label>Company name <input type="text" name="company_name" maxlength="100" required value="<?= e($v['company_name'] ?? '') ?>"></label>
    <label>Contact person <input type="text" name="contact_person" maxlength="80" required value="<?= e($v['contact_person'] ?? '') ?>"></label>
    <label>Email <input type="email" name="email" maxlength="100" required value="<?= e($v['email'] ?? '') ?>"></label>
    <label>Phone number <input type="text" name="phone_number" maxlength="20" required value="<?= e($v['phone_number'] ?? '') ?>"></label>
    <label>Industry <input type="text" name="industry" maxlength="60" placeholder="e.g. Retail, Finance" required value="<?= e($v['industry'] ?? '') ?>"></label>
</div>
