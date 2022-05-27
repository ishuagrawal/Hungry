# Hungry!
**Hungry!** is a recipe web-app, where users can search for recipes and save them to a watchlist.  
**Link:** https://ishuagra-hungry.herokuapp.com/

<hr />

## Site Overview:
Users must first create (or log into) an account before being able to search for recipes using the Edamam API. At most, 12 recipes will be displayed. Each recipe includes information such as the recipe name, calories, a list of the necessaryingredients, and the recipe link. If the user finds aparticular dish that is interesting to him/her, he/shecan add it to their watchlist for future reference. The watchlist page will list all of the recipes that the user placed on their watchlist. The watchlist will be unique for each user. The user can also choose to delete a recipe from their watchlist.

## Technologies:
- HTML/CSS
- Bootstrap 5.0
- Javascript
- jQuery 3.6
- PHP
- MySQL
- Edamam Recipe Search API

## Deployment:
The webapp was deployed using Heroku with the ClearDB MySQL Add-On to connect the database from MySQL Workbench. The database was forward engineered from `hungry.sql`, and `config/config.php` stores the database credentials.