## Larasocial

Larasocial is a simple but rich web application build on top of the Laravel framework. Inside you will find features such as friend requesting, chat between users, private messaging and more.

### Download instructions:

1. Clone the project.

```
git clone https://github.com/msalom28/Larasocial.git projectname
```

2. Install dependencies via composer.

```
composer install 
```

Note: You might get an error with the elephant.io package, The package folder might appear empty after download, just close your text editor and open the project again, and the files will be there. I really don't know why that is happening.

2. Install javascript modules via npm 

```
npm install
```

4. Migrate and seed the Database.

```
php artisan migrate --seed
```

5. Run nodejs.

```
node server.js
```

Note: leave terminal open with the command running.

6. Run php server.

```
php artisan serve
```

Enjoy!


### License

The Larasocial App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
