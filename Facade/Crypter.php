<?php
/**
 * The RoboTamer Crypter PHP Class
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

/**
 * The RoboTamer Crypter PHP Class
 *
 * Cryptert allows for encryption and decryption on the fly using
 * a simple but effective method.
 *
 * Crypter does not require mcrypt, mhash or any other PHP extension, it uses only PHP.
 *
 *
 * @category   Facade
 * @package    Crypter
 * @author     Dennis T Kaplan
 * @copyright  Copyright (c) 2008 - 2012, Dennis T Kaplan
 * @license    http://robotamer.github.com
 * @link       http://robotamer.github.com
 */
class Crypter {

    const characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    private $charArray = NULL;
    private $scramble = NULL;

    public function __construct () {
	$this->setCharArray ();
    }

    public function __destruct () {
	
    }

    public function getCharacters () {
	return self::characters;
    }

    public function getCharArray () {
	return implode ($this->charArray);
    }

    public function getScramble () {
	return implode ($this->scramble);
    }

    /**
     * Set the characters you like to replace
     *
     * @access  private
     * @param   string $str
     */
    private function setCharArray () {
	$this->charArray = str_split (self::characters);
    }

    /**
     * This is your private key.
     * You can generate a random private key based on scramble1 via
     * the randomizeString($scramble1) function.
     *
     * @access  public
     * @param   string $str
     * @return  bool TRUE
     */
    public function setScramble ($str=NULL) {
	if ($str === NULL) {
	    trigger_error ('No key, use genKey($str)', E_USER_ERROR);
	    die;
	}
	$this->scramble = str_split ($str);
	return TRUE;
    }

    /**
     * This will encrypt your data
     *
     * @access  public
     * @param   string $str
     * @return  string encrypt data
     */
    public function en ($str) {
	if ($this->scramble === NULL)
	    $this->setScramble ();
	$str = base64_encode ($str);
	$len = strlen ($str);
	$newstr = '';
	for ($i = 0; $i < $len; $i++) {
	    $r = substr ($str, -1);
	    $str = substr ($str, 0, -1);
	    $an = array_search ($r, $this->charArray);
	    if ($an !== FALSE) {
		$newstr .= $this->scramble[$an];
	    } else {
		$newstr .= $r;
	    }
	}
	return $newstr;
    }

    /**
     * This will decrypt a Crypted string back to the original data
     *
     * @access  public
     * @param   string $str
     * @return  string
     */
    public function de ($str) {
	if ($this->scramble === NULL)
	    $this->setScramble ();
	$len = strlen ($str);
	$newstr = '';
	for ($i = 0; $i < $len; $i++) {
	    $r = substr ($str, -1);
	    $str = substr ($str, 0, -1);
	    $an = array_search ($r, $this->scramble);
	    if ($an !== FALSE) {
		$newstr .= $this->charArray[$an];
	    } else {
		$newstr .= $r;
	    }
	}
	$str = base64_decode ($newstr);
	return $str;
    }

    /**
     * Generates your private key.
     * You would use it to set scramble2
     * Keep it save!
     *
     * @access  public
     * @return  string
     */
    public function genKey () {
	return str_shuffle (self::characters);
    }

}

?>
