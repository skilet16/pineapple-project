# Pineapple project

This project was made for web development test.

## Technologies

The project uses following technologies: HTML, CSS, JavaScript (Vue.JS), PHP, MySQL

## Installation
There are installation steps:
1. Prepare local server for the project. 
- If you don't have local server, i suggest you to install Laragon from [HERE](https://laragon.org/) . To figure out how to install it, please [Watch this video](https://www.youtube.com/watch?v=WMoiQO5SYKc).
2. Download the project files from this repository.
3. Move the downloaded files to the local server directory.
- If you have Laragon, you should move the files to C:/laragon/www (this is default directory for the local server in Laragon)
4. Go to phpmyadmin or any tool to import a database. 
5. Create a database and import **pineapple.sql** from [database](https://github.com/skilet16/pineapple-project/tree/main/database) directory.
6. In [app/config/db_config.php](https://github.com/skilet16/pineapple-project/blob/main/app/config/db_config.php), change the database settings.
- For Laragon, the default user is **root** and it has no password set.
7. Go to your local server (Usually it is localhost or 127.0.0.1).
8. Everything is ready to test!

## Pages
In this project, there are several pages which are **Home** and **Admin**.
1. **Home** page will appear as a default page - http://127.0.0.1
2. **Success** page will appear in - http://127.0.0.1/success
2. You can access **Admin** page like this, just add **/admin** to the url - http://127.0.0.1/admin 

## Credits
- Creator of this project: Eriks Masinkis
- Email: pilokmr@gmail.com
