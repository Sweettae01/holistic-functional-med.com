CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  phone VARCHAR(40),
  role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(40),
  service_interest VARCHAR(120),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course_progress (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  course_id VARCHAR(80) NOT NULL,
  module_id VARCHAR(80) NOT NULL,
  lesson_id VARCHAR(80) NOT NULL,
  last_position VARCHAR(80) NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE site_traffic (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page_visited VARCHAR(255),
  visited_at VARCHAR(60),
  referral_source VARCHAR(255),
  device_type VARCHAR(40),
  browser TEXT
);

CREATE TABLE ebook_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  provider VARCHAR(50),
  provider_order_id VARCHAR(120),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  provider VARCHAR(50),
  provider_order_id VARCHAR(120),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
