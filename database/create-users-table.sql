CREATE TABLE Users (
    ID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(150) NOT NULL,
    Country VARCHAR(100) NULL,
    City VARCHAR(100) NULL,
    Created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Updated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
);