## Larasocial

Larasocial is a simple but rich web application build on top of the Laravel framework. Inside you will find features such as friend requesting, chat between users, private messaging and more.

### Download instructions:

1. git clone https://github.com/dxdo/Larasocial.git projectname
2. composer install (You might get an error with the elephant.io package, The package folder might appear empty after download, just close your text editor and open the project again, and the files will be there. I really don't know why that is happening.)
3. install [Node.js](https://nodejs.org/en/download/package-manager/)
4. npm install
5. php artisan migrate --seed
6. type "node server.js" in your terminal (leave terminal open with the command running)
7. php artisan key:generate
8. php artisan serve

Enjoy!


### License

The Larasocial App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
