(function(){
	if (typeof(Ads) == 'undefined') Ads = {};

	Ads.Infeed = {
		content : '<div></div>',
		num : 3,
		init: function(content){
			var self = Ads.Infeed;
			self.content = content;
			
	(function(b,d){var a=document.createElement(b);a.async=1;a.src=d;var c=document.getElementsByTagName(b)[0];c.parentNode.insertBefore(a,c)})('script','//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js');
			
		},
		disp: function(){
			var self = Ads.Infeed;
			var _entrySelector ='div.entry-list a';
			
			if(document.querySelectorAll("div#footer-menu a.pcpage").length === 0 ) {
			
				_entrySelector='div.archive-entries section';
			}
			var _entrys = document.querySelectorAll(_entrySelector);
			var _addHTML = document.createElement("div");
			
			_addHTML.setAttribute("class", "list-entry-article");
			i = 0;
			_entrys.forEach(function(index,val){
				if(Math.floor(i)%self.num==0){
					_addHTML.innerHTML = self.content;
					_entrys[i].insertAdjacentHTML('afterend',_addHTML.outerHTML);
					(adsbygoogle = window.adsbygoogle || []).push({});
				}
				i++;
			});
		}
	}

	window.addEventListener("DOMContentLoaded", function(){
		Ads.Infeed.disp();
	}, false);

})();
