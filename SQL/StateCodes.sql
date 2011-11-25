use BFARMAN;
create table StateCodes(Code char(2) not null primary key, Name text, CountryCode char(2), foreign key(CountryCode) references CountryCodes(Code);