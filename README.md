# ESalesMen
Online E-commerce site for buying and selling products with bidding option.

## Tools Used:
1. LAMP SERVER (Apache + Mysql + Php)
2. CURL ( https://en.wikipedia.org/wiki/CURL )

## Setting Up Environment:
1. Set Up Mod Rewrite for Apache So that all request comes to index.php Using .htaccess ( https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite-for-apache-on-ubuntu-14-04 )
2. Place all the 4 folders(Presentation, Business, Data, Assets) to your localhost folder.
3. Create Database ( http://localhost/data/create_db )
4. Create All common Catagories ( http://localhost/assets/eSalesMen_data.php )
Note: Step 3 & 4 depends on step 1 & 2

##These are Some important Features of our System:

### Main Features:
1. Used Three-tier Architecture.
2. Email Verification for SignUp process
3. Search Suggestion along with searching by speific category (Solved Using Ajax)
4. Catagory Traversal through a dynamic left panel
5. Item listing(product adding) for verified user
6. Buying product by adding it to cart
7. Bidding for a product which is made available for auction by seller
8. Notification for winning a bid

### Main Security:
1. Keeping Only Presentation layer in public network and other 2 layers in private network can give us a better level of security.
2. Only Specific views can be accessed that is registerd others are hidden. For example: one can access signup.php because that is registered as /signup but there is no way to access signupAction.php
3. Sql injection proof

### User Feature:
1. Can add Profile Picture
2. Verified User Can buy products through Cart Checkout or Directly Buy a product
3. Verified User Can Recharge his account with a Recharge key

### User Security: 
1. For signup email is checked if it is already registered or any email can be send.
2. Old password is needed to update User Info or Recharge Account

### Product Feature:
1. For Selling a product Additional Info comes acoording to the Category (Solved Using Ajax)
2. For Selling a product Bidding Info is only asked when the product type is 'auction'
3. Add image of product

### Product Security:
1. Quantity is checked before adding or buying a product even you can't exceed the product quantity limit.

### Cart Feature:
1. If Same Product added to cart Only quantity increases
2. Possible to increase or decrease product quantity from cart. If quantity becomes zero product will be removed from cart.

### Cart Security: 
1. Before Checkout a Cart total cost of cart is compared with credit of a user.
2. Quantity of each product of the cart is checked before checkout and error message shows which product is failed in quantity check.

### Notification Feature:
1. Notification is Generated when a user won a Bid.
2. User can directly the product from notification.

### Notification Security:
1. Cost is checked with User credit.

### *** Bid Procedure: 
Bid process is happend when someone tries to view the product page. That is when someone tries to view the product page of the specific product then bid time is compared with the current time. If it succeed in time check then info is updated and notification is generated. So this event will happen only one time.

## Screen-Shots

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/1.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/2.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/3.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/4.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/5.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/6.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/7.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/8.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/9.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/10.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/11.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/12.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/13.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/14.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/15.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/16.png)

![image](https://raw.githubusercontent.com/JonyCseDu/ESalesMen/master/image/17.png)




