-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 29, 2023 at 08:55 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddToCart` (IN `p_memberID` INT, IN `p_productID` INT, IN `p_quantity` INT)   BEGIN
    DECLARE v_orderID INT;
    SELECT orderID INTO v_orderID FROM orders WHERE memberID = p_memberID AND status = 'cart';
    IF v_orderID IS NULL THEN
        INSERT INTO orders(memberID, orderDate, status) VALUES (p_memberID, NOW(), 'cart');
        SET v_orderID = LAST_INSERT_ID();
    END IF;
    INSERT INTO orderdetail(orderID, productID, quantity) VALUES (v_orderID, p_productID, p_quantity);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `authenticate_user` (IN `p_emailOrUsername` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    -- Declare variables for user details
    DECLARE user_id INT;
    DECLARE p_email VARCHAR(255);
    DECLARE role VARCHAR(255);
    DECLARE first_name VARCHAR(255);
    DECLARE last_name VARCHAR(255);

    -- Find user in the admin table
    SELECT adminID, email, 'admin', firstName, lastName INTO user_id, p_email, role, first_name, last_name
    FROM administrator
    WHERE (email = p_emailOrUsername OR username = p_emailOrUsername) AND passwordHash = SHA2(CONCAT(p_password, salt), 256);

    -- If user not found in admin table, check member table
    IF user_id IS NULL THEN
        SELECT memberID, email, 'member', firstName, lastName INTO user_id, p_email, role, first_name, last_name
        FROM member
        WHERE (email = p_emailOrUsername OR username = p_emailOrUsername) AND passwordHash = SHA2(CONCAT(p_password, salt), 256);
    END IF;

    -- If user not found in member table, check staff table
    IF user_id IS NULL THEN
        SELECT staffID, email, 'staff', firstName, lastName INTO user_id, p_email, role, first_name, last_name
        FROM staff
        WHERE email = p_emailOrUsername AND passwordHash = SHA2(CONCAT(p_password, salt), 256);
    END IF;

    -- Return user details
    SELECT user_id AS id, p_email, role, first_name, last_name;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFromCart` (IN `p_memberID` INT, IN `p_productID` INT)   BEGIN
    DECLARE v_orderID INT;
    SELECT orderID INTO v_orderID FROM orders WHERE memberID = p_memberID AND status = 'cart';
    DELETE FROM orderdetail WHERE orderID = v_orderID AND productID = p_productID;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllCategories` ()   BEGIN
  SELECT * FROM category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` ()   BEGIN
    SELECT * FROM product;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCart` (IN `p_memberID` INT)   BEGIN
    SELECT o.orderID, od.productID, p.productName, p.description, p.price, p.imagePath, od.quantity
    FROM orders o
    JOIN orderdetail od ON o.orderID = od.orderID
    JOIN product p ON od.productID = p.productID
    WHERE o.memberID = p_memberID AND o.status = 'cart';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductByID` (IN `p_productID` INT)   BEGIN
    SELECT * FROM product WHERE productID = p_productID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductsByCategory` (IN `p_category_id` INT)   BEGIN
  SELECT * FROM product WHERE categoryID = p_category_id;
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

    -- Return the last inserted ID, first name and last name
    SELECT LAST_INSERT_ID() AS memberID, p_firstName AS firstName, p_lastName AS lastName;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertStaff` (IN `p_firstname` VARCHAR(255), IN `p_lastname` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_phone` VARCHAR(255), IN `p_address1` VARCHAR(255), IN `p_address2` VARCHAR(255), IN `p_address3` VARCHAR(255), IN `p_city` VARCHAR(255), IN `p_country` VARCHAR(255), IN `p_eircode` VARCHAR(255), IN `p_hireDate` DATE, IN `p_gender` ENUM('Male','Female','Other'), IN `p_title` VARCHAR(255), IN `p_jobTitle` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    DECLARE p_salt VARCHAR(255);
    DECLARE p_passwordHash VARCHAR(255);

    -- Generate a random salt
    SET p_salt = SHA2(UUID(), 256);

    -- Combine password with salt and hash
    SET p_passwordHash = SHA2(CONCAT(p_password, p_salt), 256);

    -- Insert data into the staff table
    INSERT INTO staff (firstname, lastname, email, phone, address1, address2, address3, city, country, eircode, hireDate, gender, title, jobTitle, passwordHash, salt)
    VALUES (p_firstname, p_lastname, p_email, p_phone, p_address1, p_address2, p_address3, p_city, p_country, p_eircode, p_hireDate, p_gender, p_title, p_jobTitle, p_passwordHash, p_salt);

    -- Return the last inserted ID
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateQuantityInCart` (IN `p_memberID` INT, IN `p_productID` INT, IN `p_quantity` INT)   BEGIN
    DECLARE v_orderID INT;
    SELECT orderID INTO v_orderID FROM orders WHERE memberID = p_memberID AND status = 'cart';
    IF v_orderID IS NOT NULL THEN
        UPDATE orderdetail SET quantity = quantity + p_quantity WHERE orderID = v_orderID AND productID = p_productID;
    END IF;
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
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminID`, `firstName`, `lastName`, `email`, `username`, `passwordHash`, `salt`, `role`) VALUES
(1, 'Michael', 'Alfred', 'fred@mcfaddan.com', 'superadmin', '651051cacd4a29ef240ce4809a5b23d86c16798fcd9c7513da47717c34cfdd38', 'f96ed13c4d31913b21aa4552a9680b444792453c67382c421ff86f12a7bdc742', 'admin');

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
(22, 'DJ', 'accessories.png'),
(23, 'Amps', 'amps.png'),
(24, 'Drums', 'drums.png'),
(25, 'Electrics', 'electrics.png'),
(26, 'Guitars', 'guitar.png'),
(27, 'Keys & Synth', 'keyboards.png');

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
(31, 'Michael', 'Alfred', 'nigFred', 'succcess_fred@yahoo.com', '39f87817256d7127fe21678a15ca5fd91bb7fc58e57d96fd79ea3229a1681a12', 'bab3dd4aa69f362273bd4f8132f331fecf0a8a8a070157bda3ca60016f0364e5', 'member');

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
(4, 31, '2023-11-28 22:37:26', NULL, 'cart');

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
(27, 'Test Product', 'ddboauubdoubaoubdubobd', '12.99', 'reg2.png', 3, 'orange', 22),
(28, 'New Bread', 'dibobuaouadudb', '13.89', 'reg3.png', 2, 'neon', 22);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
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

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `firstName`, `lastName`, `email`, `phone`, `address1`, `address2`, `address3`, `city`, `country`, `eircode`, `hireDate`, `gender`, `title`, `jobTitle`, `role`, `passwordHash`, `salt`) VALUES
(8, 'Michael', 'Alfred', 'success_fred@yahoo.com', '+353874864779', '12A Thomond Village, Old Cratloe Road', 'Old Cratloe', 'Cratloe', 'Limerick', 'Ireland', 'V94 A0T0', '2023-11-08', 'Male', 'Mr', 'Student', 'staff', '004bb0d0a8bc5d61f5ed325a873c354dbae757bdb83be9a305f5194907228228', 'a930b1c78ae701170db731c013450c8baec34077eb34220e3b99834e48f3efa5'),
(9, 'Adam', 'MKay', 'mkayAdam@gmail.com', '+35387486779', '12B Thomond Village, Old Cratloe Road', '', '', 'Limerick', 'Ireland', 'V94 B065', '2023-06-13', 'Male', 'Mr', 'Assistant', 'staff', 'ff17f761dbb82e0cc26c1646a59cc4ab04baf7cc01e6d524fcb8f9a5feab3332', 'c350ea3e641946699a3c6e400d56b31c0d5aff0ed1e87a2b1e05a0e05081298d'),
(10, 'Samuel', 'Alfred', 'samuel@gmail.com', '+353874864779', 'Thomond Village, Old Cratloe Road', '', '', 'Limerick', 'Ireland', 'V94 A0T0', '2024-02-14', 'Male', 'Mr.', 'Manager', 'staff', '1273d25d846d284abcdce64d6afee8db640d733f3aff39ff86e083ab145dff5b', 'f49936fab8200fd5c4970398abdd39f933e55a0a6b528ce343a148b405ec688d');

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
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `memberaddress`
--
ALTER TABLE `memberaddress`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
