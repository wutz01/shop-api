# SHOP API

## ACCOUNT TYPES:
- ADMIN
- CLIENT
- SALES_AGENT

# APIs

* login - `api/user/login` (POST)
* register - `api/user/register` (POST)
  - accepts (required):
    - firstname
    - middlename (optional)
    - lastname
    - email
    - password
    - confirm_password
    - address
    - city
    - zipCode
    - mobileNo
    - phoneNo
    - country
    - companyName (Required if CLIENT)
    - companyEmail (Required if CLIENT)
    - lineBusiness (Required if CLIENT)
    - companyAddress (Required if CLIENT)
    - companyCity (Required if CLIENT)
    - companyZipCode (Required if CLIENT)
    - companyLandLine (Required if CLIENT)
    - companyCountry (Required if CLIENT)
    - designation (Required if CLIENT)
    - userType
* all products - `api/product/all` (GET)
* view product - `api/product/{id}` (GET)
* generate Guest ID - `api/generate/guestID` (GET)
* add to cart Guest - `api/cart/add` (POST)
  - accepts
    - guestId
    - userId (if exist update cart of guest to user)
    - cartId (if exist update cart)
    - items (array)
      - productId
      - quantity
* get cart by guestId - `api/guest/{guestId}/cart` (GET)
#### Authenticated user can access...

* logout - `api/user/logout` (POST)
* me - `api/getUserLogin` (GET)
* all users - `api/user/all` (GET)
* view user - `api/user/{id}` (GET)
* update user - `api/user/update` (POST)
  - accepts (required):
    - firstname
    - middlename (optional)
    - lastname
    - email
    - oldPassword (CHECK | OPTIONAL)
    - newPassword (OPTIONAL)
    - confirm_password (confirms new password)
    - address
    - city
    - zipCode
    - mobileNo
    - phoneNo
    - country
    - companyName (Required if CLIENT)
    - companyEmail (Required if CLIENT)
    - lineBusiness (Required if CLIENT)
    - companyAddress (Required if CLIENT)
    - companyCity (Required if CLIENT)
    - companyZipCode (Required if CLIENT)
    - companyLandLine (Required if CLIENT)
    - companyCountry (Required if CLIENT)
    - designation (Required if CLIENT)
    - userType

##### product categories
* all categories - `api/category/all` (GET)
* view category - `api/category/{id}` (GET)
* create category - `api/category/create` (POST)
  - accepts:
    - name (string)
    - description (text)
* update category - `api/category/update` (POST)
  - accepts:
    - catId (integer)
    - name (string)
    - description (text)

##### product supplier
* all suppliers - `api/supplier/all` (GET)
* view supplier - `api/supplier/{id}` (GET)
* create supplier - `api/supplier/create` (POST)
  - accepts:
    - name (string)
    - address (text)
    - currency (string)

* update supplier - `api/supplier/update` (POST)
  - accepts:
    - supplierId (integer)
    - name (string)
    - address (text)
    - currency (string)

##### products
* create product - `api/product/create` (POST)
  - accepts:
    - name (string)
    - description (text)
    - price (float)
    - categories (array)
    - supplierId (integer)
* update product - `api/product/update` (POST)
  - accepts:
    - prodId (integer)
    - name (string)
    - description (text)
    - price (float)
    - categories (array)
    - supplierId (integer)

##### products
* add to cart user - `api/cart/add` (POST)
  - accepts
    - guestId (if exist update cart of guest to user)
    - userId
    - cartId (if exist update cart)
    - items (array)
      - productId
      - quantity
* get cart by userId - `api/user/my-cart` (GET)
