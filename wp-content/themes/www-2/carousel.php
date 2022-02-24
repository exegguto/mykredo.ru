<div id="myCarousel" class="carousel slide container" data-interval="3000" data-ride="carousel">
    <div class="carousel-inner">
    <? $carousel_posts = get_posts('category=12&showposts=3');
    if (sizeof($carousel_posts) > 0){
        $count = 0;
        foreach ($carousel_posts as $post) :
            setup_postdata($post);?>
            <?php if ($count != 0){
                echo '<div class="item">';
            }else{
                echo '<div class="item active">';
                $count++;
            } ?>
                <div class="carousel-caption">
                    <h3 class="hidden-xs"><?php the_title(); ?></h3>
                    <p class="hidden-xs"><?php the_content(); ?></p>
                </div>
                <img src="<? bloginfo('template_directory'); ?>/images/slider-content/1.jpg" alt="">
            </div>
        <?php endforeach; ?>
    }
    </div>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>