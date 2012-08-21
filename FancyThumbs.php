<?php

/* !
 * FancyThumbs MediaWiki extension
 * version: 1.1 (Tue, 21 Aug 2012)
 * Author: weiss, http://ndmitry.ru/
 * E-mail: dima.nikitenko@gmail.com
 * Tested only on MediaWiki 1.19.1
 */

/* !
 * fancyBox - jQuery Plugin
 * version: 2.1.0 (Mon, 20 Aug 2012)
 * @requires jQuery v1.6 or later
 *
 * Examples at http://fancyapps.com/fancybox/
 * License: www.fancyapps.com/fancybox/#license
 *
 * Copyright 2012 Janis Skarnelis - janis@fancyapps.com
 *
 */

$wgExtensionCredits['other'][] = array(
    'path' => __FILE__,
    'name' => 'FancyThumbs',
    'url' => 'https://github.com/nDmitry/FancyThumbs',
    'author' => '[http://ndmitry.ru weiss]',
    'description' => 'Displaying thumbs and their descriptions using jQuery-plugin fancyBox',
    'version' => '1.1'
);

$wgResourceModules['ext.FancyThumbs'] = array(
    'scripts' => array('fancybox/jquery.fancybox.pack.js', 'js/ext.FancyThumbs.init.js'),
    'styles' => 'fancybox/jquery.fancybox.css',
    'localBasePath' => dirname(__FILE__),
    'remoteExtPath' => 'FancyThumbs'
);

$wgHooks['BeforePageDisplay'][] = 'FancyThumbs::beforePageDisplay';

class FancyThumbs {

    public static function beforePageDisplay($out) {
        $out->addModules('ext.FancyThumbs');
        return true;
    }

}