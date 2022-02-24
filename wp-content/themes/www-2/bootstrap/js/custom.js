var $j = jQuery.noConflict();

$j(function($) { 
	var $document = $(document); 
	var selector = '[data-rangeslider]'; 
	var $inputRange = $(selector);
	function valueOutput(element) { 
	var value = element.value; var output = element.parentNode.getElementsByTagName('output')[0]; output.innerHTML = value; }
	for (var i = $inputRange.length - 1; i >= 0; i--) { valueOutput($inputRange[i]); };
	$document.on('input', selector, function(e) { valueOutput(e.target); }); 
//	$inputRange.rangeslider({ polyfill: false });
});   
   
function akc () {
	$j('.counter').countdown({until: +60,expiryText: '<script>$j("#close-panel").hide();$j("#visible-panel").show();</script>',layout: '<div class="desc"><div class="mask"></div><span class="image">{h10}</span><span class="image">{h1}</span><span class="text">часов</span></div><div class="desc"><div class="mask"></div><span class="image">{m10}</span><span class="image">{m1}</span><span class="text">минут</span></div><div class="desc"><div class="mask"></div><span class="image">{s10}</span><span class="image">{s1}</span><span class="text">секунд</span></div>'});
};

$j(document).ready(function() {
$j("input[name='phone']").inputmask("+9(999)9999999" ,{ clearMaskOnLostFocus: true });

$j("input[name='passport_1']").inputmask("9999/999999" ,{ clearMaskOnLostFocus: true });
$j("input[name='passport_3']").inputmask("99.99.9999" ,{ clearMaskOnLostFocus: true });

$j.formUtils.addValidator({
	name : 'phone',
	validatorFunction : function(tele) {
		var num7 = tele.match(/[\+]7/g);
		var num8 = tele.match(/[\+]8/g);
		if (num7 == null && num8 == null) {return false;}
		tele = tele.replace(/([\+])/g, '');
		tele = tele.replace(/([\(])/g, '');
		tele = tele.replace(/([\)])/g, '');
		return tele.length == 11 && tele.match(/[^0-9]/g) === null;
	},
	errorMessage : '',
	errorMessageKey: 'badEvenNumber'
});

$j.formUtils.addValidator({
	name : 'name',
	validatorFunction : function(tele) {
		var nottxt = tele.match(/[^а-яё\s]+/gi);
		if (nottxt == null && tele.length<40 && tele.length>3){return true;}else{return false;}
	},
	errorMessage : '',
	errorMessageKey: 'badEvenNumber'
});

$j.validate({
  form : '.form',
	onError : function($form) {return false;},
	onSuccess: function($form) {
		$j.ajax({
			url: path_template+"/sender.php", //Адрес подгружаемой страницы
			type: "POST", //Тип запроса
			data: $j(".form").serialize(),
			timeout: 0,
			async: false,
			success: function(data) {
				setTimeout(function(){$j('#modalthx').modal('show')}, 900);
				}
		});return false;
	}
});

});

 $j('.form_').each(function ($j) {
    $j(this).validate({
        rules: {
            name: {required: true},
            phone: {minlenghtphone: true,requiredphone: true},
			passport_1: {required: true},
			passport_2: {required: true},
			passport_3: {required: true}
        },
        showErrors: function(errorMap, errorList) {
			// Clean up any tooltips for valid elements
			$j.each(this.validElements(), function (index, element) {
				var $jelement = $j(element);
				$jelement.data("title", "") // Clear the title - there is no error associated anymore
				.removeClass("error")
				.tooltip("destroy");
			}); 
			// Create new tooltips for invalid elements
			$j.each(errorList, function (index, error) {
				var $jelement = $j(error.element);
				$jelement.tooltip("destroy") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
				.data("title", error.message)
				.addClass("error")
				.tooltip(); // Create a new tooltip based on the error messsage we $jjust set in the title
			});
		},		
		submitHandler: function(form) {
			$j('.modal').modal('hide');        	 
			setTimeout(function(){$j('#modalthx').modal('show')}, 900);			    
			form.submit();
		}
    });
});

function calc() {
	var amount = $j('input[name="range_"]').val();
	var interest_rate = $j('input[name="percent"]').val();
	var months = $j('input[name="date"]').val();
	var interest = (amount * (interest_rate * .01)) / months;
	var payment = ((amount / months) + interest).toFixed();
	payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	$j('.result').html(payment); 
};

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
};

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
	}
    return "";
};

function checkCookie() {
	var user = getCookie("akciy");
	if (user != "") {$j("#visible-panel").show();} else {$j("#close-panel").show();setCookie("akciy", "true", 365);}
};

$j(function(){$j('#but_mikrozaim').on('click', function(e){
	window.location.hash='#win2';
});});
