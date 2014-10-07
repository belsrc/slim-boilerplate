# Simple Slim Application Boilerplate
I was using Slim a lot at work so I decided to make a little boilerplate app to speed up the process.


## Install
To install simply clone the repository ```git clone https://github.com/belsrc/slim-boilerplate.git```

And then run ```composer install``` and ```npm install``` to install dependencies.


## Configuration
All the config files are located in the app > config folder and broken up into their respective roles.

 * __app__ - Contains various application config rules. Allows setting the timezone, sections to be authenticated,
 auth redirect url and production error string.
 * __database__ - This config allows you to define a production and a development connection.
 * __environment__ - Allows you to set the host name of the production server and development server. Aids in environment detection in the start file.
 Albeit, currently, the development field doesn't really do anything. Its there for future use.
 * __log__ - Allows you to set some configurations associated with Slim's DateTimeFileWriter.
 * __view__ - Allows you to set some configurations associated with Slim's View.


## Routing
Comes with a conditional route loader middleware. To take advantage of the conditional route loader your routes should be broken up into modules.

foo.php
```PHP
<?php

$app->group('/foo', function() use($app) {
    $app->get('/', function() use($app) {
        // Do something
    })->name('foo-home');
});
```

bar.php
```PHP
<?php

$app->group('/bar', function() use($app) {
    $app->get('/', function() use($app) {
        // Do something
    })->name('bar-home');
});
```

The loader works by getting the URL path after the host and looking for a file in the 'route' folder
that matches and loading that set of routes. ```www.foo.com/bar/1233``` looks for a file called ```bar.php``` in the
route folder. If the path after the host is empty (```/```)it looks for a route named ```base.php```. If the loader can
not find any file that matches, then all the route files are loaded.


## Views
Depends on Twig. Documentation can be found [here](http://twig.sensiolabs.org/documentation).

Contains _very_ bare bones ```base.html``` and ```home.html``` views.


## ORM
Depends on Laravel/Illuminate/Database. Documentation can be found [here](http://laravel.com/docs/4.1/queries) and [here](http://laravel.com/docs/4.1/eloquent).


## Migrations
Depends on Phinx. Thorough documentation can be found [here](http://docs.phinx.org/en/latest).

#### To Create A Migration

__Windows__
```PowerShell
cd vendor/bin
```
```PowerShell
phinx.bat create -c ../../phinx.yml [MigrationName]
```

__Linux__
```Shell
cd vendor/bin
```
```Shell
php phinx create -c ../../phinx.yml [MigrationName]
```

#### To Run the Migrations

__Windows__
```PowerShell
cd vendor/bin
```
```PowerShell
phinx.bat migrate -e [development|production] -c ../../phinx.yml
```

__Linux__
```Shell
cd vendor/bin
```
```Shell
php phinx migrate -e [development|production] -c ../../phinx.yml
```


## Misc.
Comes with a Helper class simply containing ```contains(string $base, string|array $value)``` and ```prettyPrint(mixed $data)```.

Comes with a ```BaseModel``` class that extends Eloquent\Model and simply exposes the ```$table``` property.

Comes with a ```BaseRepository``` class that is old and should probably be rewritten but was thrown in.

Contains gulp build files with contain...

* ```gulp```
* ```gulp build```
* ```gulp scripts.dev```
* ```gulp scripts.build```
* ```gulp styles.dev```
* ```gulp styles.build```
* ```gulp images```
* ```gulp svg```


## License
slim-boilerplate is released under a BSD 3-Clause License

Copyright &copy; 2014, Bryan Kizer
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

* Redistributions of source code must retain the above copyright notice,
  this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.
* Neither the name of the Organization nor the names of its contributors
  may be used to endorse or promote products derived from this software
  without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED
TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A
PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
