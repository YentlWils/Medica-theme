<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 17/07/2017
 * Time: 17:40
 */

class Alternative_Page_Walker extends Walker
{
    public function walk( $elements, $max_depth )
    {
        $list = array ();

        foreach ( $elements as $item )
        {
            $list[] = "<li><a class='navbar-link' href='$item->url'><span>$item->title</span></a></li>";
        }

        return join( "\n", $list );
    }
}