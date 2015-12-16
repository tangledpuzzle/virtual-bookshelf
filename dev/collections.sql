INSERT INTO collections (CollectionID, CollectionName) VALUES (1, "Test Collection");
INSERT INTO collections (CollectionID, CollectionName) VALUES (2, "Empty Collection");
INSERT INTO collections (CollectionID, CollectionName) VALUES (3, "My Stuff");
INSERT INTO collections (CollectionID, CollectionName) VALUES (4, "fav books");

INSERT INTO userCollections (`user_id`, CollectionID) VALUES (1, 1);
INSERT INTO userCollections (`user_id`, CollectionID) VALUES (1, 2);
INSERT INTO userCollections (`user_id`, CollectionID) VALUES (2, 3);
INSERT INTO userCollections (`user_id`, CollectionID) VALUES (3, 4);

INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (1, 1);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (1, 3);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (1, 2);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (1, 10);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (1, 5);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (3, 1);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (3, 4);
INSERT INTO collectionProducts (CollectionID, ProductID) VALUES (4, 9);