# PHP-REST-API
Simple PHP CRUD API - Blog Post.
This app uses AMPPS - a WAMP/MAMP Stack. 
It includes Apache, PHP, PERL, Python(mod_wsgi), MySQL, MongoDB, phpMyAdmin, RockMongo, FTP Server - FileZilla Server(Windows) and Pure-FTPd(Mac).

##Task Description:
In this exercise I was required to create a PHP REST API application. Specification for the API is shown below.

| Endpoint                 				               		   | Functionality 						 |    
| -------------------------------------------------------------|:-----------------------------------:|
| `POST localhost/php-rest-api/api/login.php`         		   |  Logs a user in                     |
| `POST localhost/php-rest-api/api/register.php`      		   |  Register a user                    |
| `POST localhost/php-rest-api/api/create.php`       		   |  Create a new record    	         |
| `GET  localhost/php-rest-api/api/read.php`				   |  List all records               	 | 
| `GET  localhost/php-rest-api/api/read_single.php?id=3`	   |  Get single record                  |                     
| `PUT  localhost/php-rest-api/api/update.php`                 |  Update a record                    |                       
| `DELETE localhost/php-rest-api/api/delete.php`			   |  Delete a record                    | 


| Method                 				               		   | Description 						 	  |    
| -------------------------------------------------------------|:----------------------------------------:|
| GET         				           						   | Retrieves a resource(s)                 |
| POST      				                                   | Creates a new resource                  |
| PUT         				                                   | Updates an existing resource            |
| DELETE      				                                   | Deletes an existing resource            |


## Project Set up
Clone the repository

Download and install AMPPS application and Postman application

## Testing API
Use the endpoints above to test the functionality of the app via Postman.
