(function($) {
	$.fn.emoji = function(options) {
		var defaults = {
			content_el: "#content",
			list: [{
				name: "QQ表情",
				code: "qq_",
				path: "../images/face/emoji/",
				maxwidth: "24px",
				suffix: ".gif",
				max_number: 25
			}, {
				name: "emoji表情",
				code: "em_",
				path: "../images/face/emoji2/",
				maxwidth: "24px",
				suffix: ".png",
				max_number: 22
			}]
		};
		var options = $.extend(defaults, options);
		var list = options.list;
		var content_el = options.content_el;
		$(this).click(function(e) {
			if($(".emoji-box").length <= 0) {
				var btnlist = createBtnList(list);
				var emojilist = "";
				for(var i = 0; i < list.length; i++) {
					emojilist = emojilist + createEmojiList(list[i]);
				}
				var total = "<div class='emoji-box'>" + btnlist + emojilist + "<div class=' layui-clear'>&nbsp;</div></div><em class='tip'></em><em class='tip2'></em>";
				$(this).parent().append(total);
				$(this).parent().find(".emoji-btn-box span").click(function() {
					var forid = $(this).attr("for");
					$("ul.emoji-ul").hide();
					$("#" + forid).show();
					$(".emoji-box>.emoji-btn-box>span").css("color", "#ccc");
					$(this).css("color", "#006666");
					return false;
				});
				$(this).parent().find(".emoji-li").click(function() {
					var content = $(this).attr("alt");
					var contentvalue = $(content_el).val();
					$("#content").val(contentvalue + content);
					return false;
				});
				$("ul.emoji-ul").hide();
				$(".emoji-box>.emoji-btn-box>span").first().css("color", "#006666")
				$("#" + list[0].code + "emoji").show();
				var offset = $(this).position();
				//alert(JSON.stringify(offset));		
				$(".emoji-box").css("width",$(window).width() - 20);
				$(".emoji-box").css("bottom", 50 + $(this).height());
				$(".emoji-box").css("left", 0 );
				$(this).parent().find("em.tip").css("bottom", offset.top + $(this).height() + 30)
				$(this).parent().find("em.tip").css("right", 80)
				$(this).parent().find("em.tip2").css("bottom", offset.top + $(this).height() + 31)
				$(this).parent().find("em.tip2").css("right",  80)
			} else {
				$(".emoji-box").hide();
				$("em.tip").hide();
				$("em.tip2").hide();
				$(".emoji-box").remove();
				$("em.tip").remove();
				$("em.tip2").remove();
				return false;
			}
			e.stopPropagation();
		});
		$(document).click(function() {
			$(".emoji-box").hide();
			$("em.tip").hide();
			$("em.tip2").hide();
			$(".emoji-box").remove();
			$("em.tip").remove();
			$("em.tip2").remove();
		});
	}

	function createBtnList(arr) {
		var el = "";
		for(var i = 0; i < arr.length; i++) {
			el = el + "<span for='" + arr[i].code + "emoji' class='emoji-btn'>" + arr[i].name + "</span>";
		}
		return "<div class='emoji-btn-box'>" + el + "</div>";
	}

	function createEmojiList(obj) {
		
		var el = "";
		for(var i = 1; i <= obj.max_number; i++) {
			el = el + "<li class='emoji-li' alt='[" + obj.code + i + "]'><img src='" + obj.path + i + obj.suffix + "' style='width:"+obj.maxwidth+";height:"+obj.maxwidth+";'/></li>";
		}
		return "<ul class='emoji-ul' id='" + obj.code + "emoji'>" + el + "</ul>";
	}
	
	
})(jQuery);