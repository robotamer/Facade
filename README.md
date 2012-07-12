RoboTamer Facade
================

RoboTamer Facade is a component dependency substitution system to achieve component independentcy via the facade programming pattern.


RoboTamer Master Singleton Class
--------------------------------

#### Usage


**Via the factory**  
```php
    $l = Singleton::factory('Translate');

**Directs call**  
```php
    $view = Singleton::Template();
```

**Class Alias**  
```php
    Singleton::alias('Template', 'V');
```

**Aliased call** _Singleton has an S alias by default_  
```php
    $view = S::V();
```

**No need for global variables**  
```php
    S::V()->var = 'Master Singleton Class';
```

**Use original class or alias or switch back and forth**  
```php
    echo Singleton::Template()->fetch(__dir__ .'/gui/layout.php');
```

**or as alias**    
```php
    echo S::V()->fetch(__dir__ .'/gui/layout.php');
```

** See all the registered classes   
```php
    print_r(S::getClasses(), true);
```

Copyright
#########

The MIT License (MIT)
---------------------

**Copyright © 2012 RoboTamer**  

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:  

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
