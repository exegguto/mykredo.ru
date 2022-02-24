<?php
/*
Plugin Name: opCity
Plugin URI: 
Description: exercise book add 
Armstrong: My Plugin.
Author: Oparin
Version: 1.0
Author URI:
*/
function opCity_admin_pages()
{
    add_options_page('Города', 'База городов', 10, 'opCity', 'opCity_options_page');//10 уровень админа
}
function opCity_options_page() 
{
	echo "<h2>Управление базой городов</h2>";
	echo "</br><h3>Вставить список городов shortcode: [opcity_list]</h3>";
	echo "<h3>Добавить город</h3>";
	opCity_add_city();
	
	echo "<h3>Список городов</h3>";
	opCity_change_city();
}

//Изменение информации о товаре
function opCity_change_city()
{
	global $wpdb;							
	$table_opCity = $wpdb->prefix.opCity_city;	//обращение к таблице плагина
	$opCity_id = $_POST['opCity_id'];
    $opCity_name = $_POST['opCity_name'];
	$opCity_phone1 = $_POST['opCity_phone1']; //телефон 1
	$opCity_phone2 = $_POST['opCity_phone2']; //телефон 2
	$opCity_adress = $_POST['opCity_adress']; //адрес
	$opCity_sender = $_POST['opCity_sender']; //Почта куда отправлять заявки
	$opCity_flamp = $_POST['opCity_flamp']; //Код для flamp
	$opCity_gis = $_POST['opCity_gis']; //Код 2гис

	//Сохранение изменения товара
	if ( isset($_POST['opCity_setup_btn']) ){ 		//Параметр передается из формы изменения
		if (function_exists('current_user_can') && !current_user_can('manage_options') )//у пользователя есть права изменять настройки
			die ( 'Не достаточно пользовательских прав!' );
		if (function_exists ('check_admin_referer') ){//проверка со страницы админки был запрос или нет 
			check_admin_referer('opCity_setup_form');//параметр переданный из формы
        }
		// Принимаем данные
		
		//Обновляем данные в таблице
		$wpdb->update(
						$table_opCity,  
						array( 'name' => $opCity_name, 'phone1' => $opCity_phone1, 'phone2' => $opCity_phone2, 'adress' =>$opCity_adress, 'sender' =>  $opCity_sender, 'flamp' => $opCity_flamp, 'gis' => $opCity_gis),
						array( 'id' => $opCity_id ),
                        array( '%s','%s','%s','%s','%s','%s','%s'),
						array( '%d' )
					);
	}
	
	//Удаление товара
	if ( isset($_POST['opCity_delete_btn']) ){ 	//значение кнопки удаления
		if (function_exists('current_user_can') && !current_user_can('manage_options') ) die ( 'Не достаточно пользовательских прав!' );
		if (function_exists ('check_admin_referer') ){check_admin_referer('opCity_setup_form');}
		$wpdb->query("DELETE FROM ".$table_opCity." WHERE id = ".$opCity_id);//Удаляем строку из таблицы с id товара
    }
	
	//Вывод формы изменения товара
	$citylist = $wpdb->get_results("SELECT * FROM $table_opCity");
	foreach ($citylist as $item){ 			//Выбираем в цикле все записи из таблицы
		echo			//выводим добавленный товар на экран в админке
		"
			<form name='opCity_setup' method='post' action='".$_SERVER['PHP_SELF']."?page=opCity&amp;updated=true'>
		";
		if (function_exists ('wp_nonce_field') ){	//Проверочное поле для формы
			wp_nonce_field('opCity_setup_form'); 
		}
		echo
		"
				<input type='hidden' name='opCity_id' value='".$item->id."'>
				<table>
				<tr>
					<td style='text-align:right;'>Город:</td>
					<td><input type='text' name='opCity_name' value='".$item->name."'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Телефон:</td>
					<td><input type='text' name='opCity_phone1' value='".$item->phone1."'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Телефон №2:</td>
					<td><input type='text' name='opCity_phone2' value='".$item->phone2."'></td>
					<td style='text-align:left;'> Выглядеть должно так: +7 (383) 000-00-00</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Адрес:</td>
					<td><input type='text' name='opCity_adress' value='".$item->adress."'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Почта менеджера:</td>
					<td><input type='text' name='opCity_sender' value='".$item->sender."'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Код с flamp.ru:</td>
					<td><input type='text' name='opCity_flamp' value='".$item->flamp."'></td>
					<td style='text-align:left;'> Вставлять целиком</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Код с 2ГИС:</td>
					<td><input type='text' name='opCity_gis' value='".$item->gis."'></td>
					<td style='text-align:left;'> Вставлять целиком</td>
				</tr>
				<tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type='submit' name='opCity_setup_btn' value='Сохранить' style='width:140px; height:25px'>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type='submit' name='opCity_delete_btn' value='Удалить' style='width:140px; height:25px'>
                    </td>
                </tr>
			</table>
			</form>
		";
	}
}

//Добавление товара
function opCity_add_city(){
	global $wpdb;
	$table_opCity = $wpdb->prefix.opCity_city;

	//Сохранение добавленного товара в базу
	if ( isset($_POST['opCity_add_btn']) ) {
		if (function_exists('current_user_can') && !current_user_can('manage_options') ) die ('Не достаточно пользовательских прав!');
        if (function_exists ('check_admin_referer') ){check_admin_referer('opCity_add_city_form');}

		$opCity_id = $_POST['opCity_id']; //порядковый номер
        $opCity_name = $_POST['opCity_name']; //название города
		$opCity_phone1 = $_POST['opCity_phone1']; //телефон 1
		$opCity_phone2 = $_POST['opCity_phone2']; //телефон 2
		$opCity_adress = $_POST['opCity_adress']; //адрес
		$opCity_sender = $_POST['opCity_sender']; //Почта куда отправлять заявки
		$opCity_flamp = $_POST['opCity_flamp']; //Код для flamp
		$opCity_gis = $_POST['opCity_gis']; //Код 2гис
		//Добавляем товар в таблицу
		$wpdb->insert(
						$table_opCity,  
						array( 'name' => $opCity_name, 'phone1' => $opCity_phone1, 'phone2' => $opCity_phone2, 'adress' =>$opCity_adress, 'sender' =>  $opCity_sender, 'flamp' => $opCity_flamp, 'gis' => $opCity_gis),
						array( '%s','%s','%s','%s','%s','%s','%s')
					);
    }
	
	//Форма добавления товара
	echo "
			<form name='opCity_add_city' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."?page=opCity&amp;updated=true'>
		";
		if (function_exists ('wp_nonce_field') ){wp_nonce_field('opCity_add_city_form'); }
	echo"
			<table>
				<tr>
					<td style='text-align:right;'>Наименование:</td>
					<td><input type='text' name='opCity_name'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Телефон №1:</td>
					<td><input type='text' name='opCity_phone1'></td>
					<td style='text-align:left;'> Выглядеть должно так: +7 (383) 000-00-00</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Телефон №2:</td>
					<td><input type='text' name='opCity_phone2'></td>
					<td style='text-align:left;'> Выглядеть должно так: +7 (383) 000-00-00</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Адрес:</td>
					<td><input type='text' name='opCity_adress'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Почта менеджера:</td>
					<td><input type='text' name='opCity_sender'></td>
				</tr>
				<tr>
					<td style='text-align:right;'>Код с flamp.ru:</td>
					<td><input type='text' name='opCity_flamp'></td>
					<td style='text-align:left;'> Вставлять целиком</td>
				</tr>
				<tr>
					<td style='text-align:right;'>Код с 2ГИС:</td>
					<td><input type='text' name='opCity_gis'></td>
					<td style='text-align:left;'> Вставлять целиком</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type='submit' name='opCity_add_btn' value='Добавить' style='width:140px; height:25px'>
					</td>
				</tr>
			</table>
		</form>
	";
}

function opCity_install(){		//Функция активации плагина
    global $wpdb;
	
	$table_opCity = $wpdb->prefix.opCity_city;
	
	$sql1 =		//формируем запрос к базе данных
	"
		CREATE TABLE IF NOT EXISTS `".$table_opCity."` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `name` varchar(250) NOT NULL,
		  `phone1` varchar(250) NOT NULL,
		  `phone2` varchar(250) NOT NULL,
		  `adress` varchar(250) NOT NULL,
		  `sender` varchar(250) NOT NULL,
		  `flamp` text(1024) NOT NULL,
		  `gis` text(1024) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";

    $wpdb->query($sql1);		//Добавляем таблицу
}

function opCity_uninstall(){	//Функция деактивации плагина
    global $wpdb;
	$table_opCity = $wpdb->prefix.opCity_city;
    $sql1 = "DROP TABLE `".$table_opCity."`;";		//удаляем таблицу
    $wpdb->query($sql1);
}

function get_city_list(){//shortcode вывод городов
	global $wpdb;
	$table_opCity = $wpdb->prefix.opCity_city;
	$citylist = $wpdb->get_results("SELECT * FROM $table_opCity order by name");
	$opstr = "Выберите город:</br>";
	foreach ($citylist as $item){ 			//Выбираем в цикле все записи из таблицы
		$opstr .= "<a href='#close' onclick='myfunction(".$item->id."); return true;' class='mycity city_ close".$item->id."'>".$item->name."</a></br>";
	}

return $opstr;
}

function true_related_posts_after_content( $content ) {
	$related_posts = ''; // предположим, что это какой-то код, например код для вывода похожих записей
	return $content . $related_posts; // добавляем сразу после содержимого поста
}
 
add_filter( 'the_content', 'true_related_posts_after_content', 10, 1 );

register_activation_hook( __FILE__, 'opCity_install');		//установка плагина
register_deactivation_hook( __FILE__, 'opCity_uninstall');		//Удаление плагина
add_action('admin_menu', 'opCity_admin_pages');		//Создаем страницу в админке
add_shortcode( 'opcity_list', 'get_city_list',1 );
add_action('wp_enqueue_scripts', 'my_enqueue',1);
function my_enqueue()
{
wp_enqueue_script('myenqueue', plugins_url('/js/my_query.js',__FILE__), array('jquery'));
wp_enqueue_script('jqballoon', plugins_url('/js/jquery.balloon.js',__FILE__), array('jquery'));
wp_localize_script( 'myenqueue', 'ajaxmy_enqueuejax', array( 'ajaxurl' => admin_url('admin-ajax.php',__FILE__) ) );
wp_deregister_script( 'yandexmaps' );
wp_register_script( 'yandexmaps', 'https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU');
wp_enqueue_script( 'yandexmaps' );
}

add_action('wp_ajax_nopriv_my_action', 'my_action_callback',1);
add_action('wp_ajax_my_action', 'my_action_callback',1);
function my_action_callback() {
	global $wpdb;
	$table_opCity = $wpdb->prefix.opCity_city;
	if (isset($_POST['val'])) {
		$mylink = $wpdb->get_row("SELECT * FROM $table_opCity where id = {$_POST['val']}");
	}
	else {
		$mylink = $wpdb->get_row("SELECT * FROM $table_opCity where name = '{$_POST['name']}' union SELECT * FROM $table_opCity where name = 'Новосибирск'");
	}
	$post = get_page_by_title($mylink->gis, OBJECT, 'post');
	$pp = is_null($post) ? 'Запись не найдена!' : $post->post_content;
	$postf = get_page_by_title($mylink->flamp, OBJECT, 'post');
	$pflamp = is_null($postf) ? 'Запись не найдена!' : $postf->post_content;
	$options=array(
		"gis"=> $pp,
		"flamp"=>$pflamp,
		"sender"=>$mylink->sender,
		"adress"=>$mylink->adress,
		"phone2"=>$mylink->phone2,
		"phone1"=>$mylink->phone1,
		"name"=>$mylink->name,
		"id"=>$mylink->id
	 );

	echo json_encode($options);
	die();
}

?>