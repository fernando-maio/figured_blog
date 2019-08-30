Blog Application Steps:

- Run composer;
- Give permissions in storage and bootstrap/cache;
- Run migrations;
- Run DB Seeds;

User Default: maio.fernando@gmail.com
Password: figured


Observations:

- In this project, I used: 
    PHP 7.2, 
    MySQL(2 instances), 
    Laravel 5.6, 
    Blake with Bootstrap 4 for layout,
    Laravel Validations

- The user created by the seeder is the only one with admin privileges, to create and manage users and categories.

- When a post is accessed, the count view is incremented.

- Besides the auth middleware, I had created 2 more middlewares, one to check if the current user has access to create others users or categories, and the other one is to block users without master permission update others users.


*IMPORTANT*
I had some problems to use the MongoDB lib to Laravel (jenssegers/mongodb). I tried a lot different things to fix that, but to not lose more time, I had to use 2 different instances of MySql.
If I had more time, I could try to fix this, to change migrations structure, to be accepted by mongo and the libraries on the models that using the instance for posts and categories.