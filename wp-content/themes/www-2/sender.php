<? 
// ----------------------------конфигурация-------------------------- //  
$date=date("d.m.y"); // число.месяц.год  
$time=date("H:i"); // часы:минуты:секунды 

$from_email = "callme@mykredo.ru"; //From:
$subject = "Новая заявка от ". $_POST['name'];
$subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
$from_name = "MyKredo.ru"; //From:
$from_name = "=?UTF-8?B?" . base64_encode($from_name) . "?=";
$headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
$headers .= "From: " . $from_name ." <".$from_email.">\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n"; 
//---------------------------------------------------------------------- //  

$first_name=$_POST['first_name'];

if ($first_name==null){
	// Принимаем данные с формы  
	$name = $_POST['name']; //From:
	$phone=$_POST['phone'];
	$city = $_POST['city'];
	$msg = "<div><table style='background:rgb(239,239,239);' align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td><table style='background:rgb(255,255,255);border:1px solid rgb(221,221,221);border-image:none;' align='center' border='0' cellpadding='0' cellspacing='0' width='700'><tbody><tr><td><table align='center' border='0' cellpadding='0' cellspacing='0' width='620'><tbody><tr><td style='line-height:18px;'><span style='font-family:Arial;color:#666666;font-size:13px;line-height:16.8px;'>Клиентом была оставлена заявка на сайте MyKredo.ru</br><p>Имя: $name</p></br><p>Телефон: $phone</p>";

	$adminemail=$_POST['mail'];

	switch ($_POST['form_name']){
		case "norm": $form_name = "Желание клиента не конкретезировано."; break;
		case "calc": $form_name = "Клиент оставил заявку в форме калькулятора."; break;
		case "akcya": $form_name = "Клиент по акции."; break;
		case "but_avto": $form_name = "Заявка на автокредит."; break;
		case "but_dolg": $form_name = "Заявка на рефинансирование."; break;
		case "but_zvonok": $form_name = "Желание клиента не конкретезировано."; break;
		case "but_potreb": $form_name = "Заявка на потребительский кредит."; break;
		case "but_biznes": $form_name = "Кредит на бизнес."; break;
		case "but_ipoteca": $form_name = "Заявка на ипотеку."; break;
		case "but_history": $form_name = "Заявка на кредитную историю."; break;
		case "but_zalogpts": $form_name = "Заявка на займ под залог автомобиля."; break;
		case "but_zalognedv": $form_name = "Заявка на займ под залог недвижимости."; break;
		case "but_mikrozaim": $form_name = "Заявка на микрозайм."; 
			$range=$_POST['range'];
			$passport_1=$_POST['passport_1'];
			$passport_2=$_POST['passport_2'];
			$passport_3=$_POST['passport_3'];
			$msg .= "</br><p>Сумма: $range</p></br><p>Серия/номер паспорта: $passport_1</p></br><p>Кем выдан: $passport_2</p></br><p>Дата выдачи: $passport_3</p>";
		break;
	}

	$msg .= "</br><p>$form_name</p></span></td></tr></tbody></table><table align='center' border='0' cellpadding='0' cellspacing='0' height='100' width='620'><tbody><tr><td style='line-height:18px;font-size:12px;' width='450'><span style='font-family:Arial;color:rgb(102,102,102);'><br>С наилучшими пожеланиями,<br> MyKredo.ru <br>$date $time (MSK)<br>Это сообщение отправлено системой автоматически, пожалуйста, не отвечайте на него. <br></span></td></tr></tbody></table></td></tr><tr><td height='20'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table><table style='BACKGROUND:#efefef;' cellspacing='0' align='center' border='0' cellpadding='0' height='auto' width='100%'><tbody><tr><td><table style='BACKGROUND:#efefef;' cellspacing='0' align='center' border='0' cellpadding='0' height='auto' width='100%'><tbody><tr><td><table align='center' bgcolor='#efefef' border='0' cellpadding='0' cellspacing='0' height='100' width='700'><tbody><tr><td style='LINE-HEIGHT:18px;FONT-FAMILY:arial;COLOR:#999;FONT-SIZE:11px;'><p>Это письмо было отправлено на адрес <a href='mailto:$adminemail'>$adminemail</a> <br>Вы получили его так как являетесь сотрудником компании ООО Центр помощи заемщикам</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>";
	$msg .= $utm;

	// Отправляем письмо админу 
	mail($adminemail, $subject, $msg, $headers);
}
ELSE {$first_name="Bot ";}

// Сохраняем в базу данных  
$f = fopen("message.txt", "a+");
fwrite($f,"$first_name$city $date $time $phone $name $form_name\r\n");
fclose($f);

exit; 
?>