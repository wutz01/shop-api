# SHOP API

## ACCOUNT TYPES:
- ADMIN
- CLIENT
- SALES_AGENT

# APIs

* login - `api/user/login`
* register - `api/user/register`
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

* logout - `api/user/logout`
* me - `api/getUserLogin`
* all users - `api/user/all`
* view user - `api/user/{id}`
* update user - `api/user/update`
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
* all categories - `api/category/all`
* view category - `api/category/{id}`
* create category - `api/category/create`
  - accepts:
    - name (string)
    - description (text)
* update category - `api/category/update`
  - accepts:
    - catId (integer)
    - name (string)
    - description (text)

##### products
* create product - `api/product/create`
  - accepts:
    - name (string)
    - description (text)
    - price (float)
    - categories (array)
* update product - `api/product/update`
  - accepts:
    - prodId (integer)
    - name (string)
    - description (text)
    - price (float)
    - categories (array)
