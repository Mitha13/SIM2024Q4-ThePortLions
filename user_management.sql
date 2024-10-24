Create database user_management;
USE user_management;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_type INT,
    profile_id INT,
    username VARCHAR(50) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('active', 'suspended') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    dob DATE
);

-- Create the user_profiles table
CREATE TABLE UserProfile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    UserRole VARCHAR(50) NOT NULL,
    Description TEXT NOT NULL
);

-- Insert initial user profiles
INSERT INTO UserProfile (UserRole, Description)
VALUES 
    ('User Admin', 'Manages user accounts and system settings'),
    ('Buyer', 'Can browse, search, and purchase cars'),
    ('Seller', 'Can list and manage car sales'),
    ('Used Car Agent', 'Manages car listings and interacts with Buyers or Sellers');

-- Create the sessions table (if needed for session management)
CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
