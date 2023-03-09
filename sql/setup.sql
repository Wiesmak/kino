CREATE TABLE IF NOT EXISTS halls (
    id int NOT NULL auto_increment,
    `name` varchar(255) NOT NULL,
    `rows` int NOT NULL,
    `columns` int NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS movies (
    id int NOT NULL auto_increment,
    title varchar(255) NOT NULL,
    `description` text NOT NULL,
    `date` datetime NOT NULL,
    hall int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (hall) REFERENCES halls(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS reservations (
    id int NOT NULL auto_increment,
    movie int NOT NULL,
    hall int NOT NULL,
    `row` int NOT NULL,
    `column` int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (movie) REFERENCES movies(id),
    FOREIGN KEY (hall) REFERENCES halls(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=1;