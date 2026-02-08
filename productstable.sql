CREATE TABLE products (
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(100) NOT NULL,
  product_description TEXT NOT NULL,
  product_cost DECIMAL(8,2) NOT NULL
);
