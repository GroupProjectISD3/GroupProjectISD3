-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 21, 2023 at 10:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcfaddan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `authenticate_user` (IN `p_emailOrUsername` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    -- Declare variables for user details
    DECLARE user_id INT;
    DECLARE p_email VARCHAR(255);
    DECLARE role VARCHAR(255);

    -- Find user in the admin table
    SELECT adminID, email, 'admin' INTO user_id, p_email, role
    FROM administrator
    WHERE (email = p_emailOrUsername OR username = p_emailOrUsername) AND passwordHash = SHA2(CONCAT(p_password, salt), 256);

    -- If user not found in admin table, check member table
    IF user_id IS NULL THEN
        SELECT memberID, email, 'member' INTO user_id, p_email, role
        FROM member
        WHERE (email = p_emailOrUsername OR username = p_emailOrUsername) AND passwordHash = SHA2(CONCAT(p_password, salt), 256);
    END IF;

    -- If user not found in member table, check staff table
    IF user_id IS NULL THEN
        SELECT staffID, email, 'staff' INTO user_id, p_email, role
        FROM staff
        WHERE email = p_emailOrUsername AND passwordHash = SHA2(CONCAT(p_password, salt), 256);
    END IF;

    -- Return user details
    SELECT user_id AS id, p_email, role;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculateTotalSuccessfulPayments` ()   BEGIN
    DECLARE totalAmountSum DECIMAL(10, 2);

    SELECT SUM(totalAmount) INTO totalAmountSum
    FROM mcfaddan.payment
    WHERE status = 'successful';

    SELECT totalAmountSum AS 'TotalSuccessfulPayments';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CountMembers` ()   BEGIN
    DECLARE memberCount INT;

    SELECT COUNT(*) INTO memberCount FROM mcfaddan.member;

    SELECT memberCount AS 'TotalMembers';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CountStaffs` ()   BEGIN
    DECLARE staffCount INT;

    SELECT COUNT(*) INTO staffCount FROM mcfaddan.staff;

    SELECT staffCount AS 'TotalStaffs';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteItemsFromWishlist` (IN `inputWishlistID` INT, OUT `deletedWishlistID` INT)   BEGIN
    DELETE FROM `mcfaddan`.`wishlist` WHERE wishlistID = inputWishlistID;
    SET deletedWishlistID = inputWishlistID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteMember` (IN `p_memberID` INT)   BEGIN
    DELETE FROM member
    WHERE memberID = p_memberID;

    SELECT p_memberID AS deletedMemberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletememberAddress` (IN `p_addressID` INT)   BEGIN
    DELETE FROM memberaddress
    WHERE addressID = p_addressID;

    SELECT p_addressID AS deletedAddressID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrder` (IN `orderID` INT, OUT `deletedOrderID` INT)   BEGIN
    DELETE FROM `mcfaddan`.`orders` WHERE orderID = orderID;
    SET deletedOrderID = orderID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrderDetail` (IN `inputOrderDetailID` INT, OUT `deletedOrderDetailID` INT)   BEGIN
    DELETE FROM `mcfaddan`.`orderdetail` WHERE orderDetailID = inputOrderDetailID;
    SET deletedOrderDetailID = inputOrderDetailID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProduct` (IN `inputProductID` INT, OUT `deletedProductID` INT)   BEGIN
    DELETE FROM `mcfaddan`.`product` WHERE productID = inputProductID;
    SET deletedProductID = inputProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProductPerCategory` (IN `inputProductID` INT, OUT `deletedProductID` INT)   BEGIN
    DELETE FROM `mcfaddan`.`product` WHERE productID = inputProductID;
    SET deletedProductID = inputProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteStaff` (IN `p_staffID` INT)   BEGIN
    DELETE FROM staff
    WHERE staffID = p_staffID;
    
    SELECT p_staffID AS deletedStaffID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` ()   BEGIN
    SELECT * FROM product;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategoryWithMostPayments` ()   BEGIN
    SELECT 
        category.categoryName, 
        COUNT(DISTINCT payment.paymentID) AS paymentCount
    FROM 
        category
    LEFT JOIN 
        product ON category.categoryID = product.categoryID
    LEFT JOIN 
        orderdetail ON product.productID = orderdetail.productID
    LEFT JOIN 
        orders ON orderdetail.orderID = orders.orderID
    LEFT JOIN 
        payment ON orders.orderID = payment.orderID
    GROUP BY 
        category.categoryID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMemberAddresses` (IN `p_member_id` INT)   BEGIN
SELECT memberID,address1,address2,address3,city,county,eircode
FROM memberaddress
WHERE memberID= p_member_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDetails` (IN `inputMemberID` INT)   BEGIN
    SELECT od.orderDetailID, od.productID, od.quantity
    FROM `mcfaddan`.`orderdetail` od
    JOIN `mcfaddan`.`orders` o ON od.orderID = o.orderID
    WHERE o.memberID = inputMemberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDetailsAdmin` (IN `searchOrderID` INT, IN `searchProductID` INT, IN `searchQuantity` INT)   BEGIN
    SELECT od.orderDetailID, od.orderID, od.productID, od.quantity
    FROM `mcfaddan`.`orderdetail` od
    WHERE (od.orderID LIKE CONCAT('%', searchOrderID, '%') OR searchOrderID IS NULL)
    AND (od.productID LIKE CONCAT('%', searchProductID, '%') OR searchProductID IS NULL)
    AND (od.quantity LIKE CONCAT('%', searchQuantity, '%') OR searchQuantity IS NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersAdmin` (IN `searchMemberID` INT, IN `searchOrderDate` DATETIME)   BEGIN
    SELECT * FROM `mcfaddan`.`orders`
    WHERE (memberID LIKE CONCAT('%', searchMemberID, '%') OR searchMemberID IS NULL)
    AND (orderDate LIKE CONCAT('%', searchOrderDate, '%') OR searchOrderDate IS NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersCustomer` (IN `inputMemberID` INT)   BEGIN
    SELECT orderDate, shippingCost, status
    FROM `mcfaddan`.`orders`
    WHERE memberID = inputMemberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPaymentAdmin` (IN `searchOrderID` INT, IN `searchPaymentDate` DATETIME, IN `searchTotalAmount` DECIMAL(10,2), IN `searchStatus` VARCHAR(255))   BEGIN
    SELECT p.paymentID, p.orderID, p.paymentDate, p.totalAmount, p.status
    FROM `mcfaddan`.`payment` p
    WHERE (p.orderID LIKE CONCAT('%', searchOrderID, '%') OR searchOrderID IS NULL)
    AND (p.paymentDate LIKE CONCAT('%', searchPaymentDate, '%') OR searchPaymentDate IS NULL)
    AND (p.totalAmount LIKE CONCAT('%', searchTotalAmount, '%') OR searchTotalAmount IS NULL)
    AND (p.status LIKE CONCAT('%', searchStatus, '%') OR searchStatus IS NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWishlistAdmin` (IN `searchMemberID` INT, IN `searchProductID` INT, IN `searchDateAdded` DATETIME)   BEGIN
    SELECT w.wishlistID, w.memberID, w.productID, w.dateAdded
    FROM `mcfaddan`.`wishlist` w
    WHERE (w.memberID LIKE CONCAT('%', searchMemberID, '%') OR searchMemberID IS NULL)
    AND (w.productID LIKE CONCAT('%', searchProductID, '%') OR searchProductID IS NULL)
    AND (w.dateAdded LIKE CONCAT('%', searchDateAdded, '%') OR searchDateAdded IS NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWishlistItems` (IN `inputMemberID` INT)   BEGIN
    SELECT w.wishlistID, w.productID, w.dateAdded
    FROM `mcfaddan`.`wishlist` w
    WHERE w.memberID = inputMemberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategory` (IN `categoryNameParam` VARCHAR(255), IN `imageCatParam` VARCHAR(255))   BEGIN
    INSERT INTO category (categoryName, imageCat)
    VALUES (categoryNameParam, imageCatParam);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertItemIntoWishlist` (IN `inputMemberID` INT, IN `inputProductID` INT)   BEGIN
    INSERT INTO `mcfaddan`.`wishlist` (memberID, productID, dateAdded)
    VALUES (inputMemberID, inputProductID, NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertmember` (IN `p_firstName` VARCHAR(255), IN `p_lastName` VARCHAR(255), IN `p_userName` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    DECLARE p_salt VARCHAR(255);
    DECLARE p_passwordHash VARCHAR(255);

    -- Generate a random salt
    SET p_salt = SHA2(UUID(), 256);

    -- Combine password with salt and hash
    SET p_passwordHash = SHA2(CONCAT(p_password, p_salt), 256);

    -- Insert data into the member table
    INSERT INTO member (firstName, lastName, userName, email, passwordHash, salt)
    VALUES (p_firstName, p_lastName, p_userName, p_email, p_passwordHash, p_salt);

    -- Return the last inserted ID
    SELECT LAST_INSERT_ID() AS memberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertmemberAddress` (IN `p_memberID` INT, IN `p_address1` VARCHAR(255), IN `p_address2` VARCHAR(255), IN `p_address3` VARCHAR(255), IN `p_city` VARCHAR(255), IN `p_county` VARCHAR(255), IN `p_eircode` VARCHAR(255))   BEGIN
    INSERT INTO memberaddress (memberID, address1, address2, address3, city, county, eircode)
    VALUES (p_memberID, p_address1, p_address2, p_address3, p_city, p_county, p_eircode);

    SELECT LAST_INSERT_ID() AS addressID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrder` (IN `memberID` INT, IN `orderDate` DATETIME, IN `shippingCost` DECIMAL(10,2), IN `status` VARCHAR(255), OUT `newOrderID` INT)   BEGIN
    INSERT INTO `mcfaddan`.`orders` (memberID, orderDate, shippingCost, status)
    VALUES (memberID, orderDate, shippingCost, status);
    
    SET newOrderID = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOrderDetail` (IN `inputOrderID` INT, IN `inputProductID` INT, IN `inputQuantity` INT)   BEGIN
    INSERT INTO `mcfaddan`.`orderdetail` (orderID, productID, quantity)
    VALUES (inputOrderID, inputProductID, inputQuantity);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPayment` (IN `inputOrderID` INT, IN `inputPaymentDate` DATETIME, IN `inputTotalAmount` DECIMAL(10,2), IN `inputStatus` VARCHAR(255))   BEGIN
    INSERT INTO `mcfaddan`.`payment` (orderID, paymentDate, totalAmount, status)
    VALUES (inputOrderID, inputPaymentDate, inputTotalAmount, inputStatus);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `p_productName` VARCHAR(255), IN `p_description` VARCHAR(255), IN `p_price` DECIMAL(10,2), IN `p_imagePath` VARCHAR(255), IN `p_stockQuantity` INT, IN `p_color` VARCHAR(255), IN `p_categoryID` INT)   BEGIN
    INSERT INTO product (
        productName,
        description,
        price,
        imagePath,
        stockQuantity,
        color,
        categoryID
    ) VALUES (
        p_productName,
        p_description,
        p_price,
        p_imagePath,
        p_stockQuantity,
        p_color,
        p_categoryID
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertStaff` (IN `p_firstname` VARCHAR(255), IN `p_lastname` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_phone` VARCHAR(255), IN `p_address1` VARCHAR(255), IN `p_address2` VARCHAR(255), IN `p_address3` VARCHAR(255), IN `p_city` VARCHAR(255), IN `p_country` VARCHAR(255), IN `p_eircode` VARCHAR(255), IN `p_hireDate` DATE, IN `p_gender` VARCHAR(255), IN `p_title` VARCHAR(255), IN `p_jobTitle` VARCHAR(255))   BEGIN
    INSERT INTO staff (firstname, lastname, email, phone, address1, address2, address3, city, country, eircode, hireDate, gender, title, jobTitle)
    VALUES (p_firstname, p_lastname, p_email, p_phone, p_address1, p_address2, p_address3, p_city, p_country, p_eircode, p_hireDate, p_gender, p_title, p_jobTitle);

    SELECT LAST_INSERT_ID() AS staffID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAdmin` (IN `p_adminID` INT, IN `p_username` VARCHAR(255), IN `p_passwordHash` VARCHAR(255), IN `p_salt` VARCHAR(255))   BEGIN
    UPDATE administrator
    SET
        username = p_username,
        passwordHash = p_passwordHash,
        salt = p_salt
    WHERE adminID = p_adminID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategory` (IN `p_categoryID` INT, IN `p_categoryName` VARCHAR(255), IN `p_imageCat` VARCHAR(255))   BEGIN
    UPDATE category
    SET
        categoryName = p_categoryName,
        imageCat = p_imageCat
    WHERE
        categoryID = p_categoryID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMember` (IN `p_memberID` INT, IN `p_firstName` VARCHAR(255), IN `p_lastName` VARCHAR(255), IN `p_userName` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_passwordHash` VARCHAR(255), IN `p_salt` VARCHAR(255))   BEGIN
    UPDATE member
    SET
        firstName = p_firstName,
        lastName = p_lastName,
        userName = p_userName,
        email = p_email,
        passwordHash = p_passwordHash,
        salt = p_salt
    WHERE memberID = p_memberID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateOrderStatus` (IN `inputOrderID` INT, IN `newStatus` VARCHAR(255))   BEGIN
    UPDATE `mcfaddan`.`orders`
    SET status = newStatus
    WHERE orderID = inputOrderID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct` (IN `p_productID` INT, IN `p_productName` VARCHAR(255), IN `p_description` VARCHAR(255), IN `p_price` DECIMAL(10,2), IN `p_imagePath` VARCHAR(255), IN `p_stockQuantity` INT, IN `p_color` VARCHAR(255), IN `p_categoryID` INT)   BEGIN
    UPDATE product
    SET
        productName = p_productName,
        description = p_description,
        price = p_price,
        imagePath = p_imagePath,
        stockQuantity = p_stockQuantity,
        color = p_color,
        categoryID = p_categoryID
    WHERE
        productID = p_productID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProductPerCategory` (IN `inputProductID` INT, IN `inputProductName` VARCHAR(255), IN `inputDescription` TEXT, IN `inputPrice` DECIMAL(10,2), IN `inputImagePath` VARCHAR(255), IN `inputStockQuantity` INT, IN `inputColor` VARCHAR(255), IN `inputCategoryName` VARCHAR(255))   BEGIN
    DECLARE categoryId INT;
    
    -- Get category ID based on category name
    SELECT categoryID INTO categoryId FROM `mcfaddan`.`category` WHERE categoryName = inputCategoryName LIMIT 1;
    
    -- If category doesn't exist, create it
    IF categoryId IS NULL THEN
        INSERT INTO `mcfaddan`.`category` (categoryName) VALUES (inputCategoryName);
        SET categoryId = LAST_INSERT_ID();
    END IF;
    
    -- Update product in the specified category
    UPDATE `mcfaddan`.`product`
    SET productName = inputProductName,
        description = inputDescription,
        price = inputPrice,
        imagePath = inputImagePath,
        stockQuantity = inputStockQuantity,
        color = inputColor,
        categoryID = categoryId
    WHERE productID = inputProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStaff` (IN `p_staffID` INT, IN `p_firstname` VARCHAR(255), IN `p_lastname` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_phone` VARCHAR(255), IN `p_address1` VARCHAR(255), IN `p_address2` VARCHAR(255), IN `p_address3` VARCHAR(255), IN `p_city` VARCHAR(255), IN `p_country` VARCHAR(255), IN `p_eircode` VARCHAR(255), IN `p_hireDate` DATE, IN `p_gender` VARCHAR(255), IN `p_title` VARCHAR(255), IN `p_jobTitle` VARCHAR(255))   BEGIN
    UPDATE staff
    SET
        firstname = p_firstname,
        lastname = p_lastname,
        email = p_email,
        phone = p_phone,
        address1 = p_address1,
        address2 = p_address2,
        address3 = p_address3,
        city = p_city,
        country = p_country,
        eircode = p_eircode,
        hireDate = p_hireDate,
        gender = p_gender,
        title = p_title,
        jobTitle = p_jobTitle
    WHERE staffID = p_staffID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminID`, `email`, `username`, `passwordHash`, `salt`, `role`) VALUES
(1, 'fred@mcfaddan.com', 'superadmin', '651051cacd4a29ef240ce4809a5b23d86c16798fcd9c7513da47717c34cfdd38', 'f96ed13c4d31913b21aa4552a9680b444792453c67382c421ff86f12a7bdc742', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `imageCat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `imageCat`) VALUES
(1, 'NewNewFinal', 'hamburger2.jpg'),
(2, 'Profile', 'profiledash.jpg'),
(3, 'arms', 'LIFTBOARD Logo - Black with White Background - 5000x5000.png'),
(4, 'NewBread', 'front.PNG'),
(14, 'NewGamemerr', 'black.PNG'),
(15, 'NewGamemerr', 'smallblack.PNG'),
(17, 'NewTestFinalCategory', 'hamburger1.jpg'),
(18, 'FinalFinalB', 'meat.jpg'),
(20, 'Geeeee', 'meat_skewer.jpg'),
(21, 'Ciarian', 'fig.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `firstName`, `lastName`, `userName`, `email`, `passwordHash`, `salt`, `role`) VALUES
(1, 'Michael', 'Alfred', 'fredthedev', 'success_fred@yahoo.com', 'advduvdu1', 'soaebeib6', 'member'),
(2, 'Main', 'Main', 'Main', 'main@yahoo.com', 'dddddd', 'dddddd', 'member'),
(3, 'Michael', 'Alfred', 'Fredthedevel', 'success_fred@yahoo.comm', 'd09d5d0808d9103a8e1ed428eb58237df29a2e4e25344537fea9030a4df89960', '3be035f66cc2d0129695bff2f08ee319f8edc2ed3e3a85510bfb3a07874cbd0f', 'member'),
(4, 'Michael', 'Alfred', 'Fredthedevel', 'K00290602@student.tus.ie', '7ec664eb4f65f20324b4d3de8a0bdf62003b75bf53f1df05386ade99bcdb43bd', '37714a1efa8cdc4c744575084c23816903b580063dffd1711d475f40a1e26341', 'member'),
(5, 'Michael', 'Alfred', 'Fredthedevel', 'K00290602@studennt.tus.ie', '5ec5bcbb42700be7bee41856ea2de059392b21b04e2c42cd6412cadb4cbc933d', '81841cd1c2bc4cfd3e692296e31dc9997cca78a1c99f75d88489a5bfe3a311b5', 'member'),
(6, 'Michael', 'Alfred', 'Fredthedevel', 'K00290602@sstudennt.tus.ie', '9143d0795ea11e2418b0a1db2382fd4561471acbffcfd54fa595d622ba0d5053', '05765b5871a15c15b8aa301f2c0ee58d41e78f5dfc07cc940b1d86fb9aee981b', 'member'),
(7, 'Michael', 'Alfred', 'miko', 'fred@yahoo.com', '254ef43eea67ef4557f3e311a33b55fd5ac4f26e138bbe5e330cca8a273dccea', '093cb4df53fd36f4ff64ffa2c5a1807a2367ed80b08f4dc5aef3b1cda7e330f9', 'member'),
(8, 'Michael', 'Alfred', 'miko', 'frred@yahoo.com', '36a920383519f4407fcff3e3748ad07682ff2e79c42e2dc124f8b5d62085b513', 'bc5924ee5adefb583e74bf65cfb17b571a6c0af4482945a7526328567f877c45', 'member'),
(9, 'Michael', 'Alfred', 'miko', 'ssuccess_fred@yahoo.com', 'd536e4a0e309112dc89e5a4c990a835b40b20087bc6d81610664d97eaded4adf', 'e7a627efa81109bea1a48930d4d58e07c9f3644d6f3a719b117167cc81cb55ae', 'member'),
(10, 'Michael', 'Alfred', 'Fredthedevel', 'success_fred@yahoo.commm', 'a06875ad265ad740f0eb85d8cb8cbb5a4c3d1bdb3189a642927ba79436bc8f95', 'da77b4b37bb035520974707789ca9374181e4031c3dfadf09308b5e99b44221b', 'member'),
(11, 'Alfred', 'Michael', 'miko', 'fredidom023@gmail.com', 'fc8c2b11118251486be6a4b37c0ea3c0a77ad9af657f5ead580adfa41081d679', '588d4b90b6315caf4ac186137cb2e6b53319e872cc7aea04daa5e1c962e20c11', 'member'),
(12, 'Michael', 'Alfred', 'success_fred@yahoo.commmmmm', 'success_fred@yahoo.commmmmm', '97422f3b0b7b2c4f5f8bcb6e5dc4004b1cb4cba6a085a42c28d14a5de8adc232', 'a923fa891e9e3028ec1e4815e7de42b1958fefc71cad437f4d7beafd005540ba', 'member'),
(13, 'Test 1', 'Test12', 'tester', 'test@yahoo.com', '9d48cb0d74fc2b9d1826e43c72ddbdf323fd66373c20114fa3fa61c57b6e8172', 'cba3e9b2a43438eb784d502c3cdf37c8f3e6affe032782940055a8d88686dd08', 'member'),
(14, 'Michael', 'Alfred', 'michael', 'mccess_fred@yahoo.com', '9da1afdaeed2c36dbbb6960695cced63385a84c046987cd064ab59a2a29efcee', '3f47dcaa52cee9252a6cd642dd9f7a504505134cb51735ec1398ecde17e16ac9', 'member'),
(15, 'Michael', 'Alfred', 'ganifani', 'gani@yahoo.com', '651051cacd4a29ef240ce4809a5b23d86c16798fcd9c7513da47717c34cfdd38', 'f96ed13c4d31913b21aa4552a9680b444792453c67382c421ff86f12a7bdc742', 'member'),
(16, 'Michael', 'Alfred', 'mmmmmm', 'mmmmmm_fred@yahoo.com', '4f48f4e36a49b4c65c82713371c80c3902d50be994c68a297d2f9f6390fef1b6', '17f1ad98a7979f32023d521f19a88ae005b405ace0948f9ad0d3e0c34175079c', 'member'),
(17, 'Gabriela ', 'Pansini', 'Pansini', 'Pansini@yahoo.com', 'd41c8093f73bd8355505af9736337ea60400df3e65b770b418d456906893c18f', '95ca6b606ec633712b3501e4af8429cde7b1188f64b75843ca007fb6938990c5', 'member'),
(18, 'Michaell', 'Allfred', 'fredthdeve', 'fredidom0023@gmail.com', '757c6434a1754286f10c19c8ebfae538b865eb5fca67590b69ca5d19c818fc2d', '481ebd523318f60723d60f3a2373ff1368e075d64417a9a8d66d0e9f452e3832', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `memberaddress`
--

CREATE TABLE `memberaddress` (
  `addressID` int(11) NOT NULL,
  `memberID` int(11) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `eircode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderDetailID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderDetailID`, `orderID`, `productID`, `quantity`) VALUES
(1, 2, 7, 2),
(2, 2, 6, 2),
(3, 2, 7, 2),
(4, 3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `memberID` int(11) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `shippingCost` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `memberID`, `orderDate`, `shippingCost`, `status`) VALUES
(2, 1, '2023-11-07 21:36:43', '20.99', 'pending'),
(3, 2, '2023-11-13 21:38:16', '20.99', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `paymentDate` datetime DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `orderID`, `paymentDate`, `totalAmount`, `status`) VALUES
(1, 2, '2023-11-14 21:41:12', '30.99', 'successful'),
(2, 3, '2023-11-14 21:41:12', '30.99', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `stockQuantity` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `description`, `price`, `imagePath`, `stockQuantity`, `color`, `categoryID`) VALUES
(4, 'Tread', 'treattettteehghh', '12.99', 'food.jpg', 12, 'blue', 1),
(5, 'kkkk', 'ssiisbibsi', '12.00', 'food.jpg', 24, 'blue', 1),
(6, 'kkkk', 'ssiisbibsi', '12.00', 'food.jpg', 24, 'blue', 4),
(7, 'kkkk', 'ssiisbibsi', '12.00', 'food.jpg', 24, 'blue', 3),
(13, 'New New Fix Issue', 'New New Fix Issue', '12.99', 'food.jpg', 11, 'blue', 15),
(14, 'JusOne', 'JusOne', '100.56', 'hot_chocolate.jpg', 1, 'orange', 17);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `eircode` varchar(255) DEFAULT NULL,
  `hireDate` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'staff',
  `passwordHash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `memberID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `dateAdded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `memberaddress`
--
ALTER TABLE `memberaddress`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `memberID` (`memberID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD KEY `memberID` (`memberID`),
  ADD KEY `productID` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `memberaddress`
--
ALTER TABLE `memberaddress`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memberaddress`
--
ALTER TABLE `memberaddress`
  ADD CONSTRAINT `memberaddress_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
