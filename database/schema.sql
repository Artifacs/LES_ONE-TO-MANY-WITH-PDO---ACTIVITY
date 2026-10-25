
DROP DATABASE IF EXISTS data_consulting_db;
CREATE DATABASE data_consulting_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE data_consulting_db;

-- PARENT: one row per client company
CREATE TABLE clients (
    client_id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    company_name   VARCHAR(100) NOT NULL,
    contact_person VARCHAR(80)  NOT NULL,
    email          VARCHAR(100) NOT NULL,
    phone_number   VARCHAR(20)  NOT NULL,
    industry       VARCHAR(60)  NOT NULL,
    date_added     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (client_id),
    UNIQUE KEY uq_client_email (email)
) ENGINE=InnoDB;

-- CHILDREN: many projects can belong to one client
CREATE TABLE projects (
    project_id   INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    client_id    INT UNSIGNED  NOT NULL,                    -- foreign key to the parent
    project_name VARCHAR(120)  NOT NULL,
    service_type VARCHAR(60)   NOT NULL,                    -- ETL Pipeline, Data Warehouse
    status       VARCHAR(20)   NOT NULL DEFAULT 'Planned',  -- Planned / In Progress / Completed
    budget       DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    start_date   DATE          NOT NULL,
    deadline     DATE          NOT NULL,
    date_added   DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (project_id),
    CONSTRAINT fk_projects_client FOREIGN KEY (client_id)
        REFERENCES clients (client_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE      -- deleting a client also deletes that client's projects
) ENGINE=InnoDB;

INSERT INTO clients (company_name, contact_person, email, phone_number, industry) VALUES
    ('Kangaroo Retail Co.', 'Olivia Brown',  'olivia@kangarooretail.example', '0412345678', 'Retail'),
    ('Manila Fintech Labs', 'Carlo Mendoza', 'carlo@manilafintech.example',   '09171234567', 'Finance');

INSERT INTO projects (client_id, project_name, service_type, status, budget, start_date, deadline) VALUES
    (1, 'Sales Data Warehouse',   'Data Warehouse', 'In Progress', 250000.00, '2026-09-01', '2026-12-15'),
    (1, 'Inventory ETL Pipeline', 'ETL Pipeline',   'Planned',     120000.00, '2026-11-01', '2027-01-31'),
    (2, 'Transactions Streaming', 'Real-time Streaming', 'Completed', 300000.00, '2026-03-01', '2026-08-30');
