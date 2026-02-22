
--
-- Table structure for table `users`
--

CREATE TABLE users (
  `UserNo` int(11) NOT NULL,
  `UserId` varchar(15) NOT NULL,
  `LName` varchar(25) NOT NULL,
  `FName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=geostd8 COLLATE=geostd8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO users (UserNo, UserId, LName, FName) VALUES
(0, 'CLG', 'Germany', 'Cora'),
(2, 'UB', 'Braun', 'Un'),
(4, 'BW', 'Wojok', 'Bob'),
(5, 'CC', 'Conway', 'Cara');


