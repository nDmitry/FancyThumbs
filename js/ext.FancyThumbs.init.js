// Rewrite the hrefs, add 'rel' and 'title' attrs to links, fancyBox init.

jQuery(document).ready(function ($) {
    $('a.image').each(function() {
        var img_split1 = $(this).children().first().attr('src').split('/thumb');
        // if this a full image
        if(img_split1[1] == null) {
            img_split1[1] = img_split1[0];
            img_split1[0] = '';
        }
        var img_type = img_split1[1].substr(img_split1[1].length -4);
        var img_split2 = img_split1[1].split(img_type);
        var img_src = img_split1[0]+img_split2[0]+'.'+img_type;
        var img_src = img_src.replace('..', '.');
        var descr = $(this).next('div.thumbcaption').text();
        $(this).attr('href', img_src);
        $(this).attr('rel', 'group');
        if(descr) {
            $(this).attr('title', descr);
        } else {
            var descr = $(this).parent().parent().next('div.gallerytext').text();
            if(descr) {
                $(this).attr('title', descr.replace(/\r\n|\r|\n|\t/g,''));
            }
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