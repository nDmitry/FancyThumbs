<?php

/*!
 * FancyThumbs MediaWiki extension
 * version: 1.0 (Tue, 21 Aug 2012)
 * Author: weiss, http://ndmitry.ru/
 * E-mail: dima.nikitenko@gmail.com
 * Testing only on MediaWiki 1.19.1
 */

/*!
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

if (!defined('MEDIAWIKI'))
    die('Hacking attempt!');

// Credits
$wgExtensionCredits['other'][] = array(
    'name' => 'FancyThumbs',
    'url' => 'https://github.com/nDmitry/FancyThumbs',
    'author' => '[http://ndmitry.ru weiss]',
    'description' => 'Displaying thumbs and their descriptions using jQuery-plugin fancyBox',
    'version' => '1.0'
);

$wgHooks['BeforePageDisplay'][] = 'efBeforePageDisplay';

function efBeforePageDisplay($out) {
    global $wgScriptPath, $wgTitle, $wgRequest;

    // Don't load in the unnecessary areas
    $action = $wgRequest->getVal("action");
    if ($wgTitle->getNsText() != "Special" && $action != "formedit") {
        $FBT_Dir = '/extensions/FancyThumbs/fancybox';
        // Load FancyBox JS/CSS
        $out->addScriptFile($wgScriptPath . $FBT_Dir . '/jquery.fancybox.pack.js');
        $out->addScript('<link rel="stylesheet" href="' . $wgScriptPath . '' . $FBT_Dir . '/jquery.fancybox.css">');

        // Rewrite the hrefs, add 'rel' and 'title' attrs, fancyBox init
        $out->addScript('<script type="text/javascript">'
                . 'jQuery.noConflict();'
                . '(function($) {'
                . '$(function() {'
                . '$("a.image").each(function(){'
                . 'var img_split1 = $(this).children().first().attr("src").split("/thumb");'
                . ' if(img_split1[1] == null) { img_split1[1] = img_split1[0]; img_split1[0] = \'\';};' // Not a thumb but a full image
                . ' var img_type = img_split1[1].substr(img_split1[1].length -4);' // cut the last 4 (!) characters to fetch .jpg and jpeg
                . ' var img_split2 = img_split1[1].split(img_type);'
                . ' var img_src = img_split1[0]+img_split2[0]+"."+img_type;'
                . ' var img_src = img_src.replace("..", ".");' // replace ..jpg to .jpg
                . ' var descr = $(this).next("div.thumbcaption").text();' // description of thumbs
                . ' $(this).attr("href", img_src);'
                . ' $(this).attr("rel", "group");'
                . ' if(descr) { $(this).attr("title", descr); }'
                . '});'
                . '$("a.image").fancybox({padding: 0, loop: false, preload: 2, closeEffect: "elastic", nextEffect: "fade", prevEffect: "fade"});'
                . '});'
                . '})(jQuery)'
                . '</script>');
    }

    return true;
}