<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: XomiaK
 * Date: 01.08.2017
 * Time: 10:08
 */

function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}