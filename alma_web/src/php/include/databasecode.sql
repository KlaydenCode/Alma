CREATE TABLE products_infos(
  id INT AUTO_INCREMENT PRIMARY KEY not null,
  name VARCHAR(20),
  price INT,
  quantity INT,
)

CREATE TABLE cart(
  id INT AUTO_INCREMENT PRIMARY KEY not null,
  name VARCHAR(20),
  price INT,
  quantity_available INT,
  quantity INT,
)

CREATE TABLE img(
  image_id INT(10) AUTO_INCREMENT NOT NULL,
  image BLOB,
  PRIMARY KEY ('image_id')
);

INSERT INTO products_infos(name, price, quantity) VALUES ('Apple keyboard', 99, 10);

INSERT INTO products_infos(name, price, quantity_available, quantity)
  VALUES ('EarPods', 29, 21);
