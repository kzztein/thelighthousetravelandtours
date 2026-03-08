-- =============================================
-- The Lighthouse Travel & Tours — Database Setup
-- Run this in Hostinger hPanel → phpMyAdmin
-- =============================================

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    created_at DATETIME      DEFAULT CURRENT_TIMESTAMP
);

-- Admins table
CREATE TABLE IF NOT EXISTS admins (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    username   VARCHAR(100)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    created_at DATETIME      DEFAULT CURRENT_TIMESTAMP
);

-- Tours table
CREATE TABLE IF NOT EXISTS tours (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(150)   NOT NULL,
    country     VARCHAR(100)   NOT NULL,
    price       DECIMAL(10,2)  NOT NULL,
    description TEXT,
    image_path  VARCHAR(255),
    created_at  DATETIME       DEFAULT CURRENT_TIMESTAMP
);

-- Promos & Events table
CREATE TABLE IF NOT EXISTS promos (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    type        ENUM('promo','event') DEFAULT 'promo',
    title       VARCHAR(150)  NOT NULL,
    description TEXT          NOT NULL,
    badge       VARCHAR(50),
    image_url   VARCHAR(255),
    location    VARCHAR(150),
    event_date  DATE,
    expires_at  DATE,
    created_at  DATETIME      DEFAULT CURRENT_TIMESTAMP
);

-- Bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT           NOT NULL,
    tour_name  VARCHAR(150)  NOT NULL,
    tour_date  DATE          NOT NULL,
    guests     INT           DEFAULT 1,
    status     ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at DATETIME      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Contact messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL,
    message    TEXT          NOT NULL,
    created_at DATETIME      DEFAULT CURRENT_TIMESTAMP
);
