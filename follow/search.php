<?php
    get_header();
?>

<article class="content px-3 py-5 p-md-5">

    <?php
    $args = array(
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'field', 
                'field'    => 'slug',
                'terms'    => 'Name',
            ),
        ),
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) {
            $my_query->the_post();
    ?>
            <div class="post mb-5">
                <div class="media">
                    <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="image">
                    <div class="media-body">
                        <h3 class="title mb-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="meta mb-1"><span class="date"><?php the_date(); ?></span>
                            <span class="comment"><a href="#"><?php comments_number(); ?></a></span>
                        </div>
                        <div class="intro">
                            <?php the_excerpt(); ?>
                        </div>
                        <a class="more-link" href="<?php the_permalink(); ?>">Read more &rarr;</a>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        
        echo 'No portfolio posts found.';
    }

    wp_reset_postdata();
    ?>

</article>

<?php
    get_footer();
?>
