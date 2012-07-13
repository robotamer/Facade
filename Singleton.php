<?php
/**
 * The RoboTamer Master Singleton PHP Class
 * 
 * 
 * The MIT License (MIT)
 * 
 * Copyright © 2012 RoboTamer http://robotamer.github.com
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy 
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights 
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
 * copies of the Software, and to permit persons to whom the Software is 
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in 
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN 
 * THE SOFTWARE. 
 */
//namespace RoboTamer\Facade\Singleton;
/**
 * The RoboTamer Master Singleton PHP Class
 *
 * One singleton to call and store any class as singleton
 *
 * @category   Facade
 * @package    RoboTaMeR
 * @author     Dennis T Kaplan
 * @copyright  Copyright (c) 2008 - 2010, Dennis T Kaplan
 * @license    http://robotamer.github.com
 * @link       http://robotamer.github.com
 */
class_alias ('Singleton', 'S');
class Singleton {

    protected static $instances = array ();

    protected function __construct () {
	
    }

    protected static function init () {

	if (!array_key_exists ('Singleton', self::$instances)) {
	    
	    self::$instances['Singleton'] = new Singleton();
	}
    }

    public static function factory ($class = NULL, $arguments = array ()) {

	self::init ();

	if (!array_key_exists ($class, self::$instances) && $class !== NULL) {
	    self::$instances[$class] = new $class (implode (', ', $arguments));
	}

	return self::$instances[$class];
    }

    public static function alias($class,$alias) {
	
	if ( ! array_key_exists ($class, self::$instances)){
	    self::init ();
	    self::factory ($class);
	}
	
	if ( ! array_key_exists ($alias, self::$instances)) {
	    self::$instances[$alias] = &self::$instances[$class];
	}
    }


    /**
     * Use like this:	$tmpl = S::Template();
     *
     * @param	string $className
     * @param	mixed $arguments Class __construct arguments
     * @return	object
     * */
    public static function __callStatic ($className, $arguments= array ()) {
	
	return self::factory ($className, $arguments);
    }

    public static function set ($object) {

	if( ! is_object ($object)){
	    return FALSE;
	}
	
	$className = get_class($object);
	
	if ( ! array_key_exists ($className, self::$instances)) {
	    self::init ();
	    self::$instances[$className] = $object;
	    return self::$instances[$className];
	}

	return FALSE;
    }

    public static function has ($name) {

	if (array_key_exists ($name, self::$instances)) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }

    public static function del ($class) {

	unset (self::$instances[$class]);
    }

    public function getClasses () {
	
	$array = array ();
	
	foreach (array_keys (self::$instances, TRUE) as $class){
	    $array[] = $class;
	}
	
	return $array;
    }

    protected function __clone () {
	// Not cloning
    }

    public function __destruct () {
	
	foreach (array_keys (array_reverse (self::$instances, TRUE)) as $class) {
	    unset (self::$instances[$class]);
	}
    }
}

?>