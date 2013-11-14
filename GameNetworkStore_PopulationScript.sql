INSERT INTO user VALUES(1,'User1','Pass11','user1@gamer.com');
INSERT INTO user VALUES(2,'User2','word22','user2@gamer.com');
INSERT INTO user VALUES(3,'User3','Paswd33','use3@gamer.com');
INSERT INTO user VALUES(4,'User4','sword44','us4@gamer.com');
INSERT INTO user VALUES(5,'User5','ord55','usr5@gamer.com');
INSERT INTO user VALUES(6,'User6','Psw66','ue6@gamer.com');
INSERT INTO user VALUES(7,'User7','Psword77','u7@gamer.com');
INSERT INTO user VALUES(8,'User8','Paswrd88','ser8@gamer.com');
INSERT INTO user VALUES(9,'User9','Pwd99','er9@gamer.com');
INSERT INTO user VALUES(10,'User10','sd1010','ur10@gamer.com');

INSERT INTO game_store VALUES(1001,'Super Mario',5.99);
INSERT INTO game_store VALUES(1002,'Pacman',5.95);
INSERT INTO game_store VALUES(1003,'Tetris',2.99);
INSERT INTO game_store VALUES(1004,'Street Fighter',10.95);

INSERT INTO user_library VALUES(1,1001,'Super Mario');
INSERT INTO user_library VALUES(1,1002,'Pacman');
INSERT INTO user_library VALUES(1,1003,'Tetris');
INSERT INTO user_library VALUES(1,1004,'Street Fighter');
INSERT INTO user_library VALUES(2,1001,'Super Mario');
INSERT INTO user_library VALUES(2,1002,'Pacman');
INSERT INTO user_library VALUES(3,1001,'Super Mario');
INSERT INTO user_library VALUES(3,1002,'Pacman');
INSERT INTO user_library VALUES(3,1003,'Tetris');
INSERT INTO user_library VALUES(4,1002,'Pacman');
INSERT INTO user_library VALUES(4,1003,'Tetris');
INSERT INTO user_library VALUES(4,1004,'Street Fighter');
INSERT INTO user_library VALUES(5,1001,'Super Mario');
INSERT INTO user_library VALUES(5,1002,'Pacman');
INSERT INTO user_library VALUES(5,1003,'Tetris');
INSERT INTO user_library VALUES(5,1004,'Street Fighter');
INSERT INTO user_library VALUES(6,1001,'Super Mario');
INSERT INTO user_library VALUES(6,1002,'Pacman');
INSERT INTO user_library VALUES(7,1001,'Super Mario');
INSERT INTO user_library VALUES(7,1003,'Tetris');
INSERT INTO user_library VALUES(7,1004,'Street Fighter');
INSERT INTO user_library VALUES(8,1001,'Super Mario');
INSERT INTO user_library VALUES(8,1002,'Pacman');
INSERT INTO user_library VALUES(8,1003,'Tetris');
INSERT INTO user_library VALUES(8,1004,'Street Fighter');
INSERT INTO user_library VALUES(9,1002,'Pacman');
INSERT INTO user_library VALUES(9,1003,'Tetris');
INSERT INTO user_library VALUES(9,1004,'Street Fighter');
INSERT INTO user_library VALUES(10,1001,'Super Mario');
INSERT INTO user_library VALUES(10,1004,'Street Fighter');

INSERT INTO game_library VALUES(1001,'Super Mario');
INSERT INTO game_library VALUES(1002,'Pacman');
INSERT INTO game_library VALUES(1003,'Tetris');
INSERT INTO game_library VALUES(1004,'Street Fighter');

INSERT INTO games VALUES('Adventure','Nintendo',1,'Nintendo 64','Super Mario');
INSERT INTO games VALUES('Arcade','Namco',1,'Arcade','Pacman');
INSERT INTO games VALUES('Arcade','Tetris Company',1,'PC','Tetris');
INSERT INTO games VALUES('Fighting','Capcom',2,'Arcade','Street Fighter');

COMMIT;