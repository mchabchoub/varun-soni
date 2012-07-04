/* FitVids 1.0 - Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com */

jQuery(document).ready(function($) {
(function(a){a.fn.fitVids=function(b){var c={customSelector:null};var e=document.createElement("div"),d=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];e.className="fit-vids-style";e.innerHTML="&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed{position:absolute;top:0;left:0;width:100%;height:100%}</style>";d.parentNode.insertBefore(e,d);if(b){a.extend(c,b)}return this.each(function(){var f=["iframe[src^='http://player.vimeo.com']","iframe[src^='http://www.youtube.com']","iframe[src^='https://www.youtube.com']","iframe[src^='http://www.kickstarter.com']","object","embed"];if(c.customSelector){f.push(c.customSelector)}var g=a(this).find(f.join(","));g.each(function(){var k=a(this);if(this.tagName.toLowerCase()=="embed"&&k.parent("object").length||k.parent(".fluid-width-video-wrapper").length){return}var h=this.tagName.toLowerCase()=="object"?k.attr("height"):k.height(),i=h/k.width();if(!k.attr("id")){var j="fitvid"+Math.floor(Math.random()*999999);k.attr("id",j)}k.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",(i*100)+"%");k.removeAttr("height").removeAttr("width")})})}})(jQuery);
});

jQuery(document).ready(function($) {
	$(".post-header-video").fitVids();
});