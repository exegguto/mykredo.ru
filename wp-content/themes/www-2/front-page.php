<?php get_header(); ?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-65296605-2', 'auto');ga('require', 'linkid', 'linkid.js');ga('send', 'pageview');
</script>

<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter32106753 = new Ya.Metrika({ id:32106753, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/32106753" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->

	<?php $post2 = get_post( 59 );
	$text = $post2->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<header>
		<nav class="navbar navbar-default navbar-static-top" data-spy="affix" data-offset-top="720">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<?php $post201 = get_post( 201 );
						$text = $post201->post_content; // контент поста
						echo apply_filters('the_content', $text); // выводим контент ?>
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
						<?php wp_nav_menu('menu=Меню'); ?>
				</div>
				<div  class="calc">
					<img src="<?php get_template_directory(); ?>wp-content/uploads/2016/02/calc.png">
					<a href="#win3" onclick="yaCounter32106753.reachGoal('calc'); return true;">Кредитный калькулятор</a>
				</div>
				<div  class="phoneblock cityphone"></div>
			</div><!-- /.nav-->
		</nav>
	</header>
	<?php
	global $post;
	$tmp_post = $post;
	global $more;
	$tmp_more = $more;
	$tpost=get_posts(array('posts_per_page' => 10, 'orderby' => 'title', 'category_name' => 'Главная'));
	if($tpost):
	$n = 0;
	function seachtags($a, $temp){
		foreach( $temp as $tag ) if($a== $tag->name ){return true;}
		return false;
	}?>
	<?php foreach( $tpost as $post ) : setup_postdata($post); ?>
		<?php
		$n++;
		$posttags = get_the_tags();
		if ($posttags){
			if(seachtags("no_title",$posttags)){
				if(seachtags('map',$posttags)){?>
					<section id="id_<?php echo $n;?>" class="section"><div>
				<?php }else{?>
					<section id="id_<?php echo $n;?>" class="section"><div class="container">
			<?php }}else{
				if (seachtags('title_zel',$posttags)){?>
					<section id="id_<?php echo $n;?>" class="section headsection"><div class="container"><div class="row"><div class="col-md-9 text-center"><h1><?php the_title();?></h1></div></div></div></section><section class="section"><div class="container">
				<?php }else{ ?>
					<section id="id_<?php echo $n;?>" class="section"><div class="container"><div class="row"><div class="col-md-9 text-center"><h1><?php the_title();?></h1></div></div>
				<?php }
			}
		}else{?>
			<section id="id_<?php echo $n;?>" class="section"><div class="container"><div class="row"><div class="col-md-9 text-center"><h1><?php the_title();?></h1></div></div>
		<?php }?>
		<?php the_content('');?>
		</div>
	</section>
	<?php endforeach;?>
	<?php endif; $post=$tmp_post; $more=$tmp_more;?>

<div class="panelthis">
<div class="panel panel-success" data-spy="affix">
	<div class="panel-body text-center">
		<h4 class="text-uppercase m-t-0">ОСТАВИТЬ ЗАЯВКУ</h4>
		<form class="form"  target="_self" action="" method="post" novalidate="novalidate" target="win4">
			<div class="mailcity"></div>
			<div class="mail"></div>
			<input name="form_name" type="hidden" value="norm" />
			<div class="form-group"><input class="form-control" name="name" data-validation="name" type="name" placeholder="Имя" /></div>
			<div class="form-group"><input class="form-control" name="phone" type="phone" data-validation="phone" placeholder="Телефон" /></div>
			<div style="display: none;"><input name="first_name" type="first_name" placeholder="Фамилия" /></div>
			<div class="form-group-0"><button id="submitbutton" class="btn btn-block btn-danger" type="submit">Оставить заявку</button></div>
		</form></div></div></div>

<?php get_footer(); ?>

<a href="#x" class="overlay" id="win1"></a>
<div class="popup text-center">
	<?php $post121 = get_post( 121 );
	$text = $post121->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<a class="close" title="Закрыть" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win2"></a>
<div class="popup text-center">
	<?php $post217 = get_post( 217 );
	$text = $post217->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<a class="close" title="Закрыть" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win3"></a>
<div class="popup text-center" style="width: 500px;">
	<?php $post220 = get_post( 220 );
	$text = $post220->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<a class="close" title="Закрыть" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win5"></a>
<div class="popup text-center" style="overflow-y: auto;height: 80%;">
	<?php $post382 = get_post( 382 );
	$text = $post382->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<a class="close" title="Закрыть" href="#close"></a>
</div>

<a href="#x" class="overlay" id="win4"></a>
<iframe class="popup text-center" style="width: 500px;" class="hidden" src="about:blank">
	<img class="m-t-70" src="wp-content/uploads/2016/02/ok.png">
	<h4 class="modal_tnx_h m-t-70"><p style="line-height: 1.5">Ваша заявка отправлена!<br/>Мы свяжемся с Вами в кратчайшее время!<br/>Наши специалисты будут звонить Вам с номера<br/>+7 (923) 775-32-16<br/>не забудьте добавить эти номера<br/>к себе в телефон, что бы узнать нас!</h4>
</iframe>

<a href="#x" class="overlay" id="gorod"></a>
<div class="popup text-center" style="width: 200px;line-height: 1.5;">
	<?php $post331 = get_post( 331 );
	$text = $post331->post_content; // контент поста
	echo apply_filters('the_content', $text); // выводим контент ?>
	<a class="close" title="Закрыть" href="#close"></a>
</div>

<div class="modal fade"  id="modalthx" tabindex="-1" role="dialog" aria-hidden="true" onfocus="yaCounter32106753.reachGoal('otpravleno'); return true;">
	<div class="modal-dialog modal_tnx" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				<img class="m-t-70" src="<?php get_template_directory(); ?>wp-content/uploads/2016/02/ok.png">
				<h4 class="modal_tnx_h m-t-70"><p style="line-height: 1.5">Ваша заявка отправлена!<br/>Мы свяжемся с Вами в кратчайшее время!<br/>Наши специалисты будут звонить Вам с номера<br/><span class="nsk">+7 (923) 775-32-16</span><span class="omsk">+7 (908) 319-79-52</span><br/>не забудьте добавить эти номера<br/>к себе в телефон, что бы узнать нас!<br/><br/><br/>Не стесняйтесь следить за нами в соц. сетях!</p></h4>
			</div>
		</div>
	</div>
</div>
