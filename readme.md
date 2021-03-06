# Project 4
+ By: Mbinintsoa Ramarolahy
+ Production URL: <http://p4.ramarolahy.me>

## Outside resources
+ W3SCHOOLS: https://www.w3schools.com/php7/default.asp : For php references
+ Bootstrap: https://getbootstrap.com/ :For grid layout and components.
+ Material Design Lite: https://getmdl.io/ : For components.
+ html2canvas: https://html2canvas.hertzen.com/ : To change div into a canvas.
+ pexels: https://www.pexels.com/ : This is where I got the background images
+ https://stackoverflow.com/questions/11511511/how-to-save-a-png-image-server-side-from-a-base64-data-string
+ https://www.iconfinder.com/search/?q=plus&price=free
+ https://laracasts.com/discuss/channels/general-discussion/facebook-share?page=0
+ https://stackoverflow.com/ : Many random tips
+ https://stackoverflow.com/questions/14829040/facebook-sharer-popup-window : Facebook popup
+ https://stackoverflow.com/questions/2644299/jquery-removeclass-wildcard

## Packages
+ barryvdh/laravel-debugbar
+ intervention/image
+ laravelcollective/html
+ league/flysystem-aws-s3-v3

## Feature summary
+ Visitors can register for an account and log in to use the service.
+ Visitors can view  a list of quote posters they created, and others created.
+ Visitors can Create, List, Update, and Delete their own posters
+ Visitors can search for posters by author or by keyword.
+ Visitors can share posters to their facebook account.
  
## Database summary
+ My application has 3 tables in total (`backgrounds`, `posters`, `users`)
+ There's a one-to-many relationship between `backgrounds` and `posters`
+ There's a one-to-many relationship between `users` and `posters`

## Code style divergences
+ My opening brackets are located at the end of function declarations.

## Notes for instructor
+ The interface is optimized for a 15" or above.
+ I am using JS for some client side functionality: background carousel selection, toggling through poster components and design.
+ All form validation are done server side / with html5 form validation.
