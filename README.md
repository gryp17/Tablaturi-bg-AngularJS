# Tablaturi-bg-AngularJS
AngularJS application for [Tablaturi-BG](http://tablaturi-bg.com) - the biggest website for guitar tabs in Bulgaria.
The application uses custom MVC PHP backend with MySQL database and AngularJS v1.5 as front end. The dependencies are managed using [bower](https://bower.io) and the build process is done with [gulp](http://gulpjs.com/).

## Installation

1. Install all bower dependencies:

  ```
  bower install
  ```

2. Build the javascript and css files:

  ```
  gulp build-dev
  ```

## Configuration

1. Backend

  The backend configuration file is located in

    ```
    /backend/config/Config.php
    ```
  It contains the default database credentials , backing tracks authentication and the default directories paths.

2. .htaccess

  Change the RewriteBase rule based on your domain path.
  
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
    
  ```
  /app/views/layout.php
  ```
    
  Examples:
  
  ```html
  <!-- http://tablaturi-bg.com -->
  <base href="/" />
  ```
  
  ```html
  <!-- localhost/Tablaturi-bg-angular -->
  <base href="/Tablaturi-bg-angular/" />
  ```
