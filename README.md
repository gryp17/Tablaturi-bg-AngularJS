# Tablaturi-bg-AngularJS
AngularJS application for [Tablaturi-BG](http://tablaturi-bg.com) - the biggest website for guitar tabs in Bulgaria.
The application uses custom MVC PHP backend with MySQL database, AngularJS v1.5 as front end and [SASS](http://sass-lang.com) as css preprocessor. The dependencies are managed using [bower](https://bower.io) and the build process is done with [gulp](http://gulpjs.com/).

## Installation

1. Install all bower dependencies:

  ```
  bower install
  ```

2. Build the javascript and css files:

  ```
  gulp build-dev
  ```

3. Import the database schema

  There are two database schemas that you can choose from:

  InnoDB
  
  > [/db/innodb_schema.sql](https://github.com/gryp17/Tablaturi-bg-AngularJS/blob/master/db/innodb_schema.sql)
  
  
  myISAM
  
  > [/db/myISAM_schema.sql](https://github.com/gryp17/Tablaturi-bg-AngularJS/blob/master/db/myISAM_schema.sql)


## Configuration

1. Backend

  The backend configuration file is located in

  > [/backend/config/Config.php](https://github.com/gryp17/Tablaturi-bg-AngularJS/blob/master/backend/config/Config.php)


  It contains the default database credentials , backing tracks authentication and the default directories paths.

2. .htaccess

  Change the RewriteBase rule based on your domain path.
  
  The .htaccess file is located in the root directory of the project
  
  > [/.htaccess](https://github.com/gryp17/Tablaturi-bg-AngularJS/blob/master/.htaccess)
  
  Examples:

  ```apache
  #http://tablaturi-bg.com
  RewriteBase /
  ```
  
  ```apache
  #localhost/Tablaturi-bg-angular
  RewriteBase /Tablaturi-bg-angular
  ```
  
3. AngularJS html5 mode

  Change the ```<base>``` tag content based on your domain path.
  
  The tag is in the ```<head>``` of the main layout file
  
  > [/app/views/layout.php](https://github.com/gryp17/Tablaturi-bg-AngularJS/blob/master/app/views/layout.php)
    
  Examples:
  
  ```html
  <!-- http://tablaturi-bg.com -->
  <base href="/" />
  ```
  
  ```html
  <!-- localhost/Tablaturi-bg-angular -->
  <base href="/Tablaturi-bg-angular/" />
  ```
