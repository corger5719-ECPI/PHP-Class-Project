--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductNo` int(11) NOT NULL, Primary, Auto Increment,
  `ProductId` varchar(10) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductDescription` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=geostd8 COLLATE=geostd8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductNo`, `ProductId`, `ProductName`, `ProductDescription`) VALUES
(1, 'hcomb', 'Hot Comb', 'hotcomb that straightens hair'),
(3, 'mspray', 'Moisturizing Spray', 'hair moisturizer in spray bottle'),
(4, 'blkextensi', 'Braiding Hair', '14-inch human hair extension in color black'),
(5, 'combbrush', 'Comb & Brush Set', 'hair comb & brush set');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

