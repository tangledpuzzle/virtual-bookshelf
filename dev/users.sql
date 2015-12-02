INSERT INTO genders (GenderID,GenderName) VALUES (1,"Male");
INSERT INTO genders (GenderID,GenderName) VALUES (2,"Female");
INSERT INTO genders (GenderID,GenderName) VALUES (3,"Unspecified");

INSERT INTO countries(CountryID,CountrySymbol,CountryName,FlagPath) VALUES (1,"FI","Finland",NULL);
INSERT INTO countries(CountryID,CountrySymbol,CountryName,FlagPath) VALUES (2,"JP","Japan",NULL);
INSERT INTO countries(CountryID,CountrySymbol,CountryName,FlagPath) VALUES (3,"UK","United Kingdom",NULL);
INSERT INTO countries(CountryID,CountrySymbol,CountryName,FlagPath) VALUES (4,"US","USA",NULL);
INSERT INTO countries(CountryID,CountrySymbol,CountryName,FlagPath) VALUES (5,"GER","Germany",NULL);

INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (1,"uzakask","123456","2015-01-01","Bayram","Aslan",30,1,NULL,"uzakask",NULL,"moi");
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (2,"metropolia","123456","2015-02-01","Jose","Uusitalo",21,1,1,"joseu",NULL,"hei");
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (3,"bulevardi","123456","2015-01-03","Ilkka","Varjokannas",29,NULL,1,"ilkkav",NULL,"terve");
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (4,"tietoteknikka","123456","2015-11-01","tieto","tekniikka",30,2,NULL,"tietotekniikka",NULL,NULL);
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (5,"ohjelmisto","123456","2014-01-11","ohjel","misto",30,3,NULL,"uzakohjelmistoask",NULL,NULL);
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (6,"java"," ","2014-01-09",NULL,"va",30,2,4,"java",NULL,NULL);
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (7,"codio","","2015-12-21","co","dio",NULL,2,2,"codio",NULL,NULL);
INSERT INTO users(UserID,LoginName,Password,RegistrationDate,FirstName,LastName,Age,GenderID,CountryID,ScreenName,AvatarPath,Bio ) VALUES (8,"git","123456","2015-10-23",NULL,NULL,NULL,NULL,NULL,"git",NULL,NULL);
