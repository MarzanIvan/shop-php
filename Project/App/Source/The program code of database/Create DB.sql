
Create database Internet_Shop;

CREATE TABLE Products( 
    id int not null primary key auto_increment,
    name text,
    description text
); 

CREATE TABLE Categories( 
    id int not null primary key auto_increment, 
    name varchar(100)
);

CREATE TABLE ProductsCategories( 
    id int not null primary key auto_increment, 
    idProduct int not null, 
    idCategories int not null,
    FOREIGN KEY (idProduct)    REFERENCES Products(id),
    FOREIGN KEY (idCategories) REFERENCES Categories(id) 
);

CREATE TABLE Providers(
    id int not null primary key auto_increment,
    name varchar(255),
    address varchar(255),
    numbertelephone varchar(20),
    email varchar(30)
);

CREATE TABLE ProductsProviders(
    id int not null primary key auto_increment,
    idProduct int not null,
    idProvider int not null,
    FOREIGN KEY (idProduct)  REFERENCES Products(id),
    FOREIGN KEY (idProvider) REFERENCES Providers(id)
);

CREATE TABLE DeliveryMethod (
    id int not null primary key auto_increment,
    name varchar(255),
    price float,
    SpeedDeliveryInDays int not null
);

CREATE TABLE MethodDeliveryProvider(
    id int not null primary key auto_increment,
    idProvider int not null,
    IdDeliveryMethod int not null,
    FOREIGN KEY (idProvider)       REFERENCES Providers(id),
    FOREIGN KEY (IdDeliveryMethod) REFERENCES DeliveryMethod(id)
);


CREATE TABLE ItemProducts(
    id int not null primary key auto_increment,
    price float not null,
    pathimage text not null,
    amount int not null,
    Specifications text,
    idProduct int not null,
    IdDeliveryMethod int not null,
    FOREIGN KEY (IdDeliveryMethod)  REFERENCES DeliveryMethod(id),
    FOREIGN KEY (idProduct)         REFERENCES Products(id) 
);

CREATE TABLE Users( 
    id int not null primary key auto_increment, 
    name varchar(15), 
    surname varchar(15),
    numbertelephone varchar(15), 
    email varchar(25), 
    InformationMySelf text, 
    country varchar(20), 
    town varchar(20), 
    street varchar(20), 
    numberhome varchar(20), 
    gender varchar(10), 
    password varchar(32)
);

CREATE TABLE BasketOrders(
    id int not null primary key auto_increment,
    price float,
    dateorder date,
    idUser int not null,
    idItemProduct int not null,
    FOREIGN KEY (idUser)        REFERENCES Users(id),
    FOREIGN KEY (idItemProduct) REFERENCES ItemProducts(id)
);

CREATE TABLE CommentsProducts(
    id int not null primary key auto_increment,
    idUser int not null,
    idProduct int not null,
    content text,
    FOREIGN KEY (idUser)    REFERENCES Users(id),
    FOREIGN KEY (idProduct) REFERENCES Products(id)
);