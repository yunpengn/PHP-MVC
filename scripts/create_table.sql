CREATE TABLE users (
  email varchar(255) PRIMARY KEY,
  password varchar(255) NOT NULL,
  created_at timestamp DEFAULT current_timestamp
);
