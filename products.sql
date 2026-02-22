CREATE TABLE `products` (
  `ProductNo` int(11) NOT NULL, PRIMARY, AUT0_INCREMENT,
  `ProductId` varchar(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductDescription` varchar(150) NOT NULL
) 

INSERT INTO products (ProductNo, ProductId, ProductName, ProductDescription) VALUES
(1, 'hcomb', 'Hot Comb', 'hotcomb that straightens hair'),
(2, 'hgrease', 'Hair Grease', 'locks in moisture & creates a protective barrier & adds sheen'), 
(3, 'mspray', 'Moisturizing Spray', 'hair moisturizer in spray bottle'),
(4, 'blkextn', 'Braiding Hair', '14-inch human hair extension in color black'),
(5, 'combbrush', 'Comb & Brush Set', 'hair comb & brush set');

