Task List 

1. CREATE Model - Done
    a. user
    b. addresse
    c. categorie
    d. product
    e. cart
    f. order
    g. order_item

2. CRETE Migration - Done
    a. users
    b. addresses
    c. categories
    d. products
    e. carts 
    f. orders
    g. order_items 

3. CREATE Controller (Resource) - Done
    a. AuthController
    b. AddressController
    c. CategoryController
    d. ProductController
    e. CartController
    f. OrderController 
    g. OrderItemController 

4. Route Making


All PHP Laravel Commands 
1. php artisan serve
2. php artisan make:model User
3. php artisan make:controller AuthController
4. php artisan refresh

Add some documentation withe relationship between the tables
Give the details models and its relation



Model and their data and relationship
    a. user
            id
            name
            email
            phone
            profilePic
            password
            confirm_password
    b. addresse
            id
            name
            user_id
            phone
            locality
            city
            state
            country
            pincode
    c. categorie
            id
            name
            categoryImg
            descrption
    d. product
            id
            name
            descrption
            price
            profilePic
            detail_description
            category_id
    e. cart
            id
            prodouct_id
            quantity
            user_id
    f. order
            id
            user_id
            address_id
            total_amount
            payment_mode
            order_status
            payment_status
            
    g. order_item
            id
            order_id
            prodouct_id
            quantity
            price