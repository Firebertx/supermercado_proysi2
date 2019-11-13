<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 15/09/2019
 * Time: 2:32
 */
function setActiveRoute($name){
    return request()->routeIs($name)? 'active' : '';
}