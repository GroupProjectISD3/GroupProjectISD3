--I Added more stored procedure,
-- i didn't keep track of what i added
-- and removed so just delete what you have and
-- use this as the stored procedure

--Also if you're have issues with your database
--Send me a message on the group, i noticed we didnt have 
--auto increments for some of the tables so i have corrected that now

--Alfred Michael [11/17/2023]
--Gabriela Pansini [11/17/2023]
--Adam [11/17/2023]


--Database: mcfaddan


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculateTotalSuccessfulPayments`()
BEGIN
    DECLARE totalAmountSum DECIMAL(10, 2);

    SELECT SUM(totalAmount) INTO totalAmountSum
    FROM mcfaddan.payment
    WHERE status = 'successful';

    SELECT totalAmountSum AS 'TotalSuccessfulPayments';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CountMembers`()
BEGIN
    DECLARE memberCount INT;

    SELECT COUNT(*) INTO memberCount FROM mcfaddan.member;

    SELECT memberCount AS 'TotalMembers';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CountStaffs`()
BEGIN
    DECLARE staffCount INT;

    SELECT COUNT(*) INTO staffCount FROM mcfaddan.staff;

    SELECT staffCount AS 'TotalStaffs';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrder`(IN orderID INT, OUT deletedOrderID INT)
BEGIN
    DELETE FROM `mcfaddan`.`orders` WHERE orderID = orderID;
    SET deletedOrderID = orderID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrderDetail`(IN inputOrderDetailID INT, OUT deletedOrderDetailID INT)
BEGIN
    DELETE FROM `mcfaddan`.`orderdetail` WHERE orderDetailID = inputOrderDetailID;
    SET deletedOrderDetailID = inputOrderDetailID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProduct`(IN inputProductID INT, OUT deletedProductID INT)
BEGIN
    DELETE FROM `mcfaddan`.`product` WHERE productID = inputProductID;
    SET deletedProductID = inputProductID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProductPerCategory`(IN inputProductID INT, OUT deletedProductID INT)
BEGIN
    DELETE FROM `mcfaddan`.`product` WHERE productID = inputProductID;
    SET deletedProductID = inputProductID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts`()
BEGIN
    SELECT * FROM product;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategoryWithMostPayments`()
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMemberAddresses`(IN p_member_id INT)
BEGIN
SELECT memberID,address1,address2,address3,city,county,eircode
FROM memberaddress
WHERE memberID= p_member_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategory`(
    IN categoryNameParam VARCHAR(255),
    IN imageCatParam VARCHAR(255)
)
BEGIN
    INSERT INTO category (categoryName, imageCat)
    VALUES (categoryNameParam, imageCatParam);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrder`(
    IN memberID INT,
    IN orderDate DATETIME,
    IN shippingCost DECIMAL(10,2),
    IN status VARCHAR(255),
    OUT newOrderID INT
)
BEGIN
    INSERT INTO `mcfaddan`.`orders` (memberID, orderDate, shippingCost, status)
    VALUES (memberID, orderDate, shippingCost, status);
    
    SET newOrderID = LAST_INSERT_ID();
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct`(
    IN p_productName VARCHAR(255),
    IN p_description VARCHAR(255),
    IN p_price DECIMAL(10, 2),
    IN p_imagePath VARCHAR(255),
    IN p_stockQuantity INT,
    IN p_color VARCHAR(255),
    IN p_categoryID INT
)
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategory`(
    IN p_categoryID INT,
    IN p_categoryName VARCHAR(255),
    IN p_imageCat VARCHAR(255)
)
BEGIN
    UPDATE category
    SET
        categoryName = p_categoryName,
        imageCat = p_imageCat
    WHERE
        categoryID = p_categoryID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateOrderStatus`(IN inputOrderID INT, IN newStatus VARCHAR(255))
BEGIN
    UPDATE `mcfaddan`.`orders`
    SET status = newStatus
    WHERE orderID = inputOrderID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct`(
    IN p_productID INT,
    IN p_productName VARCHAR(255),
    IN p_description VARCHAR(255),
    IN p_price DECIMAL(10, 2),
    IN p_imagePath VARCHAR(255),
    IN p_stockQuantity INT,
    IN p_color VARCHAR(255),
    IN p_categoryID INT
)
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProductPerCategory`(
    IN inputProductID INT,
    IN inputProductName VARCHAR(255),
    IN inputDescription TEXT,
    IN inputPrice DECIMAL(10,2),
    IN inputImagePath VARCHAR(255),
    IN inputStockQuantity INT,
    IN inputColor VARCHAR(255),
    IN inputCategoryName VARCHAR(255)
)
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `authenticate_user`(IN `p_emailOrUsername` VARCHAR(255), IN `p_password` VARCHAR(255))
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteItemsFromWishlist`(IN inputWishlistID INT, OUT deletedWishlistID INT)
BEGIN
    DELETE FROM `mcfaddan`.`wishlist` WHERE wishlistID = inputWishlistID;
    SET deletedWishlistID = inputWishlistID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteMember`(
    IN p_memberID INT
)
BEGIN
    DELETE FROM member
    WHERE memberID = p_memberID;

    SELECT p_memberID AS deletedMemberID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteStaff`(
    IN p_staffID INT
)
BEGIN
    DELETE FROM staff
    WHERE staffID = p_staffID;
    
    SELECT p_staffID AS deletedStaffID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletememberAddress`(
    IN p_addressID INT
)
BEGIN
    DELETE FROM memberaddress
    WHERE addressID = p_addressID;

    SELECT p_addressID AS deletedAddressID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDetails`(IN inputMemberID INT)
BEGIN
    SELECT od.orderDetailID, od.productID, od.quantity
    FROM `mcfaddan`.`orderdetail` od
    JOIN `mcfaddan`.`orders` o ON od.orderID = o.orderID
    WHERE o.memberID = inputMemberID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrderDetailsAdmin`(IN searchOrderID INT, IN searchProductID INT, IN searchQuantity INT)
BEGIN
    SELECT od.orderDetailID, od.orderID, od.productID, od.quantity
    FROM `mcfaddan`.`orderdetail` od
    WHERE (od.orderID LIKE CONCAT('%', searchOrderID, '%') OR searchOrderID IS NULL)
    AND (od.productID LIKE CONCAT('%', searchProductID, '%') OR searchProductID IS NULL)
    AND (od.quantity LIKE CONCAT('%', searchQuantity, '%') OR searchQuantity IS NULL);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersAdmin`(IN searchMemberID INT, IN searchOrderDate DATETIME)
BEGIN
    SELECT * FROM `mcfaddan`.`orders`
    WHERE (memberID LIKE CONCAT('%', searchMemberID, '%') OR searchMemberID IS NULL)
    AND (orderDate LIKE CONCAT('%', searchOrderDate, '%') OR searchOrderDate IS NULL);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersCustomer`(IN inputMemberID INT)
BEGIN
    SELECT orderDate, shippingCost, status
    FROM `mcfaddan`.`orders`
    WHERE memberID = inputMemberID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getPaymentAdmin`(IN searchOrderID INT, IN searchPaymentDate DATETIME, IN searchTotalAmount DECIMAL(10,2), IN searchStatus VARCHAR(255))
BEGIN
    SELECT p.paymentID, p.orderID, p.paymentDate, p.totalAmount, p.status
    FROM `mcfaddan`.`payment` p
    WHERE (p.orderID LIKE CONCAT('%', searchOrderID, '%') OR searchOrderID IS NULL)
    AND (p.paymentDate LIKE CONCAT('%', searchPaymentDate, '%') OR searchPaymentDate IS NULL)
    AND (p.totalAmount LIKE CONCAT('%', searchTotalAmount, '%') OR searchTotalAmount IS NULL)
    AND (p.status LIKE CONCAT('%', searchStatus, '%') OR searchStatus IS NULL);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getWishlistAdmin`(IN searchMemberID INT, IN searchProductID INT, IN searchDateAdded DATETIME)
BEGIN
    SELECT w.wishlistID, w.memberID, w.productID, w.dateAdded
    FROM `mcfaddan`.`wishlist` w
    WHERE (w.memberID LIKE CONCAT('%', searchMemberID, '%') OR searchMemberID IS NULL)
    AND (w.productID LIKE CONCAT('%', searchProductID, '%') OR searchProductID IS NULL)
    AND (w.dateAdded LIKE CONCAT('%', searchDateAdded, '%') OR searchDateAdded IS NULL);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getWishlistItems`(IN inputMemberID INT)
BEGIN
    SELECT w.wishlistID, w.productID, w.dateAdded
    FROM `mcfaddan`.`wishlist` w
    WHERE w.memberID = inputMemberID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertItemIntoWishlist`(IN inputMemberID INT, IN inputProductID INT)
BEGIN
    INSERT INTO `mcfaddan`.`wishlist` (memberID, productID, dateAdded)
    VALUES (inputMemberID, inputProductID, NOW());
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOrderDetail`(
    IN inputOrderID INT,
    IN inputProductID INT,
    IN inputQuantity INT
)
BEGIN
    INSERT INTO `mcfaddan`.`orderdetail` (orderID, productID, quantity)
    VALUES (inputOrderID, inputProductID, inputQuantity);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPayment`(IN inputOrderID INT, IN inputPaymentDate DATETIME, IN inputTotalAmount DECIMAL(10,2), IN inputStatus VARCHAR(255))
BEGIN
    INSERT INTO `mcfaddan`.`payment` (orderID, paymentDate, totalAmount, status)
    VALUES (inputOrderID, inputPaymentDate, inputTotalAmount, inputStatus);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertStaff`(
    IN p_firstname VARCHAR(255),
    IN p_lastname VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_phone VARCHAR(255),
    IN p_address1 VARCHAR(255),
    IN p_address2 VARCHAR(255),
    IN p_address3 VARCHAR(255),
    IN p_city VARCHAR(255),
    IN p_country VARCHAR(255),
    IN p_eircode VARCHAR(255),
    IN p_hireDate DATE,
    IN p_gender VARCHAR(255),
    IN p_title VARCHAR(255),
    IN p_jobTitle VARCHAR(255)
)
BEGIN
    INSERT INTO staff (firstname, lastname, email, phone, address1, address2, address3, city, country, eircode, hireDate, gender, title, jobTitle)
    VALUES (p_firstname, p_lastname, p_email, p_phone, p_address1, p_address2, p_address3, p_city, p_country, p_eircode, p_hireDate, p_gender, p_title, p_jobTitle);

    SELECT LAST_INSERT_ID() AS staffID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertmember`(
    IN p_firstName VARCHAR(255),
    IN p_lastName VARCHAR(255),
    IN p_userName VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertmemberAddress`(
    IN p_memberID INT,
    IN p_address1 VARCHAR(255),
    IN p_address2 VARCHAR(255),
    IN p_address3 VARCHAR(255),
    IN p_city VARCHAR(255),
    IN p_county VARCHAR(255),
    IN p_eircode VARCHAR(255)
)
BEGIN
    INSERT INTO memberaddress (memberID, address1, address2, address3, city, county, eircode)
    VALUES (p_memberID, p_address1, p_address2, p_address3, p_city, p_county, p_eircode);

    SELECT LAST_INSERT_ID() AS addressID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAdmin`(
    IN p_adminID INT,
    IN p_username VARCHAR(255),
    IN p_passwordHash VARCHAR(255),
    IN p_salt VARCHAR(255)
)
BEGIN
    UPDATE administrator
    SET
        username = p_username,
        passwordHash = p_passwordHash,
        salt = p_salt
    WHERE adminID = p_adminID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMember`(
    IN p_memberID INT,
    IN p_firstName VARCHAR(255),
    IN p_lastName VARCHAR(255),
    IN p_userName VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_passwordHash VARCHAR(255),
    IN p_salt VARCHAR(255)
)
BEGIN
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStaff`(
    IN p_staffID INT,
    IN p_firstname VARCHAR(255),
    IN p_lastname VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_phone VARCHAR(255),
    IN p_address1 VARCHAR(255),
    IN p_address2 VARCHAR(255),
    IN p_address3 VARCHAR(255),
    IN p_city VARCHAR(255),
    IN p_country VARCHAR(255),
    IN p_eircode VARCHAR(255),
    IN p_hireDate DATE,
    IN p_gender VARCHAR(255),
    IN p_title VARCHAR(255),
    IN p_jobTitle VARCHAR(255)
)
BEGIN
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
