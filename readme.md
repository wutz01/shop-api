# SHOP API

## ACCOUNT TYPES:
- ADMIN
- CLIENT
- SALES_AGENT

# APIs

* login - `api/user/login` (POST)
* register - `api/user/register` (POST)
  - accepts (required):
    - name
    - email
    - password
    - confirm_password
    - address
    - contactPerson (Required if CLIENT)
    - contactNumber (Required if CLIENT)
    - designation (Required if CLIENT)
    - userType
* all products - `api/product/all`
* view product - `api/product/{id}`

#### Authenticated user can access...

* logout - `api/user/logout` (POST)
* me - `api/getUserLogin` (GET)
* all users - `api/user/all` (GET)
* view user - `api/user/{id}` (GET)
* update user - `api/user/update` (POST)
  - accepts (required):
    - userId
    - name
    - email
    - address
    - contactPerson (Required if CLIENT)
    - contactNumber (Required if CLIENT)
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
