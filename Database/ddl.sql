CREATE DATABASE StudentPickupService;

CREATE TABLE Account(
    AccountID CHAR(8) PRIMARY KEY,
    Name VARCHAR(20),
    Password VARCHAR(255),
    Gender CHAR(10),
    Email VARCHAR(50),
    ContactNo VARCHAR(12),
    Course VARCHAR(100),
    IntakeYear DATE,
    AccStatus VARCHAR(10),
    AccountType VARCHAR(10)
);
CREATE TABLE Menu(
    MenuID CHAR(5) PRIMARY KEY,
    Type CHAR(10),
    FoodName VARCHAR(30),
    ShopName VARCHAR(30),
    Description VARCHAR(100),
    FoodPic LONGBLOB NOT NULL,
    Price DECIMAL(5,2),
    Remark VARCHAR(30)
);

CREATE TABLE FoodOrder(
    OrderID CHAR(14) PRIMARY KEY,
    Date DATETIME,
    CollectionTime TIME,
    CollectionLocation VARCHAR(50),
    Status VARCHAR(10),
    totalPrice DECIMAL(5,2),
    AccountID CHAR(8),
    RecordTime DATETIME,
    FOREIGN KEY(AccountID) REFERENCES Account(AccountID)
);

CREATE TABLE PickupService(
    PickupID CHAR(15) PRIMARY KEY,
    PickupStatus VARCHAR(10),
    DeliveredTime TIME,
    Comment VARCHAR(100),
    AccountID CHAR(8),
    OrderID CHAR(14),
    PickupTime DATETIME,
    FOREIGN KEY(OrderID) REFERENCES FoodOrder(OrderID),
    FOREIGN KEY(AccountID) REFERENCES Account(AccountID)
);

CREATE TABLE OrderRecord(
    RecordID INT AUTO_INCREMENT PRIMARY KEY,
    Quantity INT(10),
    OrderID CHAR(14),
    MenuID CHAR(5),
    FOREIGN KEY(OrderID) REFERENCES FoodOrder(OrderID),
    FOREIGN KEY(MenuID) REFERENCES Menu(MenuID)
);