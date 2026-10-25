# One-to-Many with PDO - Data Engineering Consulting (Online & Digital Business)

**Relationship:** ONE client has MANY projects.
**Parent entity:** `clients` | **Children entity:** `projects` (`projects.client_id` -> `clients.client_id`, ON DELETE CASCADE)

## Run on XAMPP
1. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy this folder to `C:\xampp\htdocs\one_to_many_pdo`.
3. http://localhost/phpmyadmin -> **Import** -> `database/schema.sql` -> Go.
4. Open http://localhost/one_to_many_pdo/

## Pages
- Parent: `index.php` (list + add), `client_create.php`, `client_edit.php`, `client_update.php`, `client_delete.php`
- Children: `projects.php?client_id=N` (list + add), `project_create.php`, `project_edit.php`, `project_update.php`, `project_delete.php`
