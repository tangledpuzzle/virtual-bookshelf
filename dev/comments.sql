INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (1, "2001-01-11", 1, "Test User Comment");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (5, "2001-01-11", 1, "Test Comment");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (6, "2001-01-11", 1, "Tement");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (7, "2001-01-11", 1, "Testment");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (2, "1901-11-11", 2, "Test Product Comment");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (3, "2021-09-19", 3, "Test Product Comment 2");
INSERT INTO comments (CommentID, PostDate, `user_id`, Text) VALUES (4, "2014-10-12", 1, "Test Review Comment");

INSERT INTO userComments (`user_id`, CommentID) VALUES (1, 1);

INSERT INTO productComments (ProductID, CommentID) VALUES (1, 2);
INSERT INTO productComments (ProductID, CommentID) VALUES (1, 3);

INSERT INTO reviewComments (ReviewID, CommentID) VALUES (1, 4);