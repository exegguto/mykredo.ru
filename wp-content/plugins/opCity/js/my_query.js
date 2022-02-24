var $jq = jQuery.noConflict();
// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires*1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) { 
  	options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;
	updatedCookie += "; path=/";
  for(var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];    
    if (propValue !== true) { 
      updatedCookie += "=" + propValue;
     }
  }
  document.cookie = updatedCookie;
}

$jq(document).ready(function(){
var $chcity = getCookie('city');
var conmap = $jq('#conmap');
	if (conmap.length > 0) {
		ymaps.ready(init);
		if (($chcity != '') && ($chcity != undefined)){
			myfunction($chcity);
		}
	}
	else if (($chcity != '') && ($chcity != undefined)){
		myfunction($chcity);
	}
	else
	{
		ymaps.ready(init);
	}
});

function init() {
    // Данные о местоположении, определённом по IP
	var conmap = $jq('#conmap');
	if (conmap.length > 0) {
		var myMap = new ymaps.Map("conmap", {
            center: [56.352906, 43.874814],
            zoom: 16
        }),
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [56.352906, 43.874814]
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: 'НижСпецСтрой',
                balloonContent: 'г. Нижний Новгород, ул.Заводской парк, д. 21'
			}
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'twirl#redStretchyIcon',
            // Метку можно перемещать.
            draggable: false
        });
		myMap.controls.add('zoomControl', { left: 5, top: 5 });
		// Добавляем все метки на карту.
		myMap.geoObjects.add(myGeoObject);
		}
	var $chcity = getCookie('city');
	if (($chcity == '') || ($chcity == undefined)){
    var geolocation = ymaps.geolocation;
	$jq.ajax({
    type: 'POST',
    url:  ajaxmy_enqueuejax.ajaxurl,
	dataType: 'json',
    data: {
      'action': 'my_action',
      'name': geolocation.city
      },
    context: document.body,
    success: function(data, textStatus, XMLHttpRequest){
      var data = data; 
		$jq('.cityphone').html('<a href="tel:'+data["phone1"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone1"]+'</a><br><a href="tel:'+data["phone2"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone2"]+'</a>');
		$jq('.cityadress').html('\
			<p class="phone"><a href="tel:'+data["phone1"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone1"]+'</a></p>\
			<p class="phone"><a href="tel:'+data["phone2"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone2"]+'</a></p>\
			<p class="adress"><img src="wp-content/uploads/2016/02/adress.png">'+data["adress"]+'</p>');
		$jq('.flamp').html(data['flamp']);
		$jq('.map').html(data['gis']);
		$jq('.cityname').html(data['name']);
		$jq('.city').html(data['name']);
		$jq('.mailcity').html('<input name="city" type="hidden" value="'+data["name"]+'"/>');
		$jq('.mail').html('<input name="mail" type="hidden" value="'+data["sender"]+'"/>');
		$jq('.flamp').html(data["flamp"]);
		$jq('.cityname').showBalloon({contents: '<div class="vashgorod">Ваш город: '+data['name']+'<br>Угадали?<br><p class="button-wrap">'+
                '<a class="btn y-button" href="#">'+
                    '<span class="b-button__i">Да</span>'+
                '</a>'+
                '<a class="btn n-button" href="#">'+
                    '<span class="b-button__i">Нет</span>'+
                '</a>'+
            '</p></div>',position: "bottom"});
		$jq(".y-button").click(function() {
			var date = new Date( new Date().getTime() + 3600*24*30*1000 );
			setCookie('city',data['id'],{ expires: date.toUTCString() });
			$jq('.cityname').hideBalloon();
		});
		$jq(".n-button").click(function() {
			$jq('.cityname').hideBalloon();
			$jq('.eModal-3').trigger('click');
		});
	},
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    //alert(errorThrown);
    },
    complete: function(XMLHttpRequest, status) {
          }
 });
	
}	
}

function myfunction(id)
{
 var ajaxval = id;
 $jq.ajax({
    type: 'POST',
    url:  ajaxmy_enqueuejax.ajaxurl,
	dataType: 'json',
    data: {
      'action': 'my_action',
      'val': ajaxval
      },
    context: document.body,
    success: function(data, textStatus, XMLHttpRequest){
      var data = data; 
		var n = data['phone1'].indexOf(";");
		if (n>0) {
			var smallphone = data['phone1'].substring(0, n);
		}
		else
		{
			var smallphone = data['phone1'];
		}
		$jq('.cityphone').html('<a href="tel:'+data["phone1"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone1"]+'</a><br><a href="tel:'+data["phone2"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone2"]+'</a>');
		$jq('.cityadress').html('\
			<p class="phone"><a href="tel:'+data["phone1"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone1"]+'</a></p>\
			<p class="phone"><a href="tel:'+data["phone2"]+'" onclick="yaCounter32106753.reachGoal(\'telefon\'); return true;">'+data["phone2"]+'</a></p>\
			<p class="adress"><img src="wp-content/uploads/2016/02/adress.png">'+data["adress"]+'</p>');
		$jq('.flamp').html(data['flamp']);
		$jq('.map').html(data['gis']);
		$jq('.cityname').html(data['name']);
		$jq('.city').html(data['name']);
		$jq('.mailcity').html('<input name="city" type="hidden" value="'+data["name"]+'"/>');
		$jq('.mail').html('<input name="mail" type="hidden" value="'+data["sender"]+'"/>');
		var date = new Date( new Date().getTime() + 3600*24*30*1000 );
		setCookie('city',ajaxval,{ expires: date.toUTCString() });
		},
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    //alert(errorThrown);
    },
    complete: function(XMLHttpRequest, status) {
          }
 });
}
