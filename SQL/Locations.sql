use BFARMAN;
create table Locations(ID int not null primary key auto_increment,
City text not null,
State char(2),
Country text not null,
foreign key(State) references StateCodes(Code));