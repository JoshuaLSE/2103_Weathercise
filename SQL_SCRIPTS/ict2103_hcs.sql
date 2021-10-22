-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: ict2103
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hcs`
--

DROP TABLE IF EXISTS `hcs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hcs` (
  `Food` char(255) NOT NULL,
  `Food_ID` int(11) NOT NULL,
  PRIMARY KEY (`Food`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hcs`
--

LOCK TABLES `hcs` WRITE;
/*!40000 ALTER TABLE `hcs` DISABLE KEYS */;
INSERT INTO `hcs` VALUES ('Alphabet Soup',272),('Ananas',454),('Apple',65),('Applesauce',66),('Artichoke',1),('Arugula',2),('Asian Pear',453),('Asparagus',3),('Aubergine',4),('Avocado',68),('Baby Back Ribs',118),('Bacon and Eggs',119),('Baked Beans',120),('Banana',69),('Bananas',455),('Barley',196),('Barley Groats',197),('BBQ Ribs',121),('Bean Stew',273),('Beef Bouillon',274),('Beef Noodle Soup',275),('Beef Soup',276),('Beef Stew',122),('Beetroot',5),('Bell Pepper',6),('Black Olives',7),('Black Rice',125),('Blackberries',70),('Blood Oranges',71),('Blueberries',72),('Bouillon',277),('Breadfruit',456),('Broccoli',8),('Broccoli Cheese Soup',278),('Broccoli Soup',279),('Brown Rice',127),('Brown Rices',198),('Brussels Sprouts',9),('Buckwheat',199),('Buckwheat Groats',200),('Burger King Original Chicken Sandwich',502),('Burger King Premium Alaskan Fish Sandwich',503),('Burrito',128),('Butter Chicken',129),('Cabbage',10),('Cabbage Soup',280),('California Roll',130),('Cantaloupe',73),('Cantaloupe Melon',457),('Capsicum',11),('Carrot',12),('Carrot Ginger Soup',281),('Carrot Soup',282),('Casaba Melon',458),('Cauliflower',13),('Celery',14),('Cellophane Noodles',372),('Chard',15),('Cheese Tortellini',373),('Cherries',74),('Cherry Tomato',16),('Chicken Bouillon',283),('Chicken Broth',284),('Chicken Caesar Salad',131),('Chicken Gumbo Soup',285),('Chicken Marsala',133),('Chicken Noodle Soup',286),('Chicken Sandwich',514),('Chicken Stock',287),('Chicken Vegetable Soup',288),('Chicken with Rice Soup',289),('Chicory',17),('Chili con Carne',137),('Chimichanga',138),('Chinese Cabbage',18),('Chives',19),('Clementine',75),('Cobb Salad',139),('Collard Greens',20),('Collard Greenss',140),('Corn',21),('Corn Dog',141),('Corned Beef Hash',142),('Cottage Pie',143),('Courgette',22),('Cranberries',76),('Cream of Asparagus Soup',290),('Cream of Broccoli Soup',291),('Cream of Celery Soup',292),('Cream of Chicken Soup',293),('Cream of Mushroom Soup',294),('Cream of Onion Soup',295),('Cream of Potato Soup',296),('Creamed Spinach',23),('Creamy Chicken Noodle Soup',297),('Cucumber',24),('Currants',77),('Custard Apple',78),('Dal',144),('Deviled Eggs',145),('Dosa',147),('Dragon Fruit',460),('Durum Wheat Semolina',376),('Egg Noodles',377),('Eggplant',25),('Endive',26),('Falafel',521),('Farfalle',378),('Fennel',27),('Fish Sandwich',524),('French Onion Soup',298),('Fruit salad',81),('Fusilli',380),('Galia Melon',463),('Garlic',28),('Gherkin',29),('Glass Noodles',381),('Golden Mushroom Soup',299),('Goulash',300),('Gourd',30),('Grapefruit',464),('Grapes',82),('Green Beans',31),('Green Olives',32),('Green Onion',33),('Greengage',83),('Grilled Cheese Sandwich',153),('Grilled Chicken Salad',526),('Guava',84),('Guavas',465),('Ham and Cheese Sandwich',154),('Ham Sandwich',527),('Hamburger',528),('Healthy Choice',341),('Honeydew',466),('Horseradish',34),('Hot Dog',529),('Hummus',155),('Ice Milk',345),('Instant Ramen',301),('Jackfruit',85),('Jackfruits',467),('Jambalaya',156),('Jujube',86),('Kale',35),('Kiwi',87),('Kiwis',468),('Kohlrabi',36),('Kumara',37),('Kumquat',469),('Lasagne',158),('Lasagne Sheets',382),('Leek',38),('Lemon',88),('Lentil Soup',302),('Lettuce',39),('Lime',89),('Lobster Bisque Soup',303),('Low Carb Pasta',384),('Lychee',470),('Lychees',90),('Mac and Cheese',159),('Macaroni',385),('Macaroni and Cheese',160),('Magnolia',346),('Mandarin Oranges',91),('Mandarin Orangess',471),('Mango',92),('Mangoes',472),('Mangosteen',473),('Manicotti',386),('Maraschino Cherries',475),('Mashed Potatoes',161),('Meatball Soup',304),('Minestrone',305),('Minneola',93),('Mostaccioli',387),('Mulberries',94),('Mushroom Soup',306),('Mushrooms',40),('Muskmelon',476),('Mustard Greens',41),('Naan',164),('Noodle Soup',307),('Nori',42),('Oat Bran',215),('Okra',43),('Olives',44),('Olivess',96),('Onion',45),('Onion Soup',308),('Orange',97),('Orange Chicken',165),('Orecchiette',388),('Oxtail Soup',309),('Paella',167),('Papaya',98),('Paratha',168),('Parsnips',46),('Passion Fruit',99),('Passion Fruits',478),('Pea Soup',169),('Pea Soups',310),('Peach',100),('Peanut Butter Sandwich',170),('Pear',101),('Pearl Barley',216),('Peas',47),('Penne',390),('Penne Rigate',391),('Pepper',48),('Pierogi',392),('Pineapple',104),('Pineapples',479),('Pink Grapefruit',480),('Plantains',105),('Plum',106),('Pomegranate',107),('Pomegranates',482),('Pomelo',483),('Potato',49),('Potato Salad',175),('Potato Soup',311),('Prickly Pear',484),('Pulled Pork Sandwich',176),('Pumpkin',50),('Pumpkin Soup',312),('Radishes',51),('Raisins',109),('Rambutan',110),('Rambutans',485),('Ramen',177),('Ramens',313),('Raspberries',111),('Ravioli',393),('Red Cabbage',52),('Reuben Sandwich',179),('Rhubarb',112),('Rigatoni',394),('Roast Beef',180),('Roast Dinner',181),('Rutabaga',53),('Samosa',182),('Sausage Roll',183),('Sausage Rolls',184),('Scotch Broth',314),('Shallots',54),('Shepherds Pie',185),('Shirataki Noodles',397),('Shortbread',225),('Soursop Fruit',487),('Soy Noodles',398),('Spaghetti',400),('Spicy Italian',548),('Spinach',55),('Spinach Tortellini',401),('Spirelli',402),('Squash',56),('Star Fruit',488),('Starfruit',113),('Strawberries',114),('Subway Club Sandwich',549),('Sweet Potato',57),('Tamarind',115),('Tangerine',116),('Thai Soup',316),('Tomato',58),('Tomato Rice Soup',317),('Tomato Soup',318),('Tortellini',404),('Turnip Greens',59),('Vegetable Beef Soup',319),('Vegetable Broth',320),('Vegetable Soup',321),('Vegetable Stock',322),('Veggie Burger',553),('Veggie Delight',554),('Veggie Patty',555),('Vermicelli',405),('Watermelon',117),('Watermelons',490),('Wheat Bran',232),('Wheat Germ',233),('Wheat Gluten',234),('Wheat Semolina',235),('Wheat Starch',236),('Whole Grain Noodles',406),('Whole Grain Spaghetti',407),('Whole Grain Wheat',237),('Wholegrain Oat',238);
/*!40000 ALTER TABLE `hcs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-22 22:04:03
