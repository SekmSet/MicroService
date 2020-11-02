# My micro services

## Tools 

----

APP

----
* Slim 4.5.*
* Eloquent ORM
* JWT

----

API

----

* NodeJS
* MongoDB
* Express

## Folders structure

* Micro service with Slim
* Api 

## Steps of instalations

* Install a slim-skeleton
* Install my ORM : Eloquent
* Configure my DB name
    * [Link](https://alexisallais.fr/creez_une_api_avec_slim_4_et_eloquent/)
* Create my modeles

## Modeles

* User 
    * id
    * last_name
    * first_name
    * username *(unique)*
    * email *(unique)*
    * phone *(unique)*
    * created_at 
    * updated_at
    
* Message
    * id
    * id_userS *(id of user who send the message)*
    * id_userD *(id of user who receive the message)*
    * content
    * created_at 
    * updated_at
    
### Relationship

An user can send *(or receive)* messages to any users
A message can have only one sender but several receivers, but a message can not have several senders

### CRUD

Create routes and CRUD of each modeles

* Create *(post)*
* Read *(get)*
    * One 
    * All 
* Update *(put)*
* Delete *(delete)*