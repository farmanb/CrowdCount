use BFARMAN;

create table CrowdCount(ID int not null primary key auto_increment,
LocationID int,
Date date not null,
Time time not null,
foreign key(LocationID) referencs Locations(ID));