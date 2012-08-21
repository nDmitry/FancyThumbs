// Rewrite the hrefs, add 'rel' and 'title' attrs to links, fancyBox init.

jQuery(document).ready(function ($) {
    $('a.image').each(function() {
        var img_split1 = $(this).children().first().attr('src').split('/thumb');
        // Not a thumb but a full image
        if(img_split1[1] == null) {
            img_split1[1] = img_split1[0];
            img_split1[0] = '';
        }
        var img_type = img_split1[1].substr(img_split1[1].length -4); // cut the last 4 (!) characters to fetch .jpg and jpeg
        var img_split2 = img_split1[1].split(img_type);
        var img_src = img_split1[0]+img_split2[0]+'.'+img_type;
        var img_src = img_src.replace('..', '.'); // replace ..jpg to .jpg
        var descr = $(this).next('div.thumbcaption').text(); // description of thumbs
        $(this).attr('href', img_src);
        $(this).attr('rel', 'group');
        if(descr) {
            $(this).attr('title', descr);
        }
    });
    $('a.image').fancybox({
        padding: 0, 
        loop: false, 
        preload: 2, 
        closeEffect: 'elastic', 
        nextEffect: 'fade', 
        prevEffect: 'fade'
    });
});