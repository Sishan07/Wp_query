<?php

/*
Template Name: WP Template

*/

 get_header();   

$args = [
    'post_type'=> 'post',
    'post_status'=> 'publish',
     'posts_per_page' => -1,
    // 'cat' => "20,21"
    // 'category__in'=> [21,20],
    // "category_name" => 'sports',
    // 'tag'  => 'another',
    // 'tag_id' => 22,
    // 'tag__in' => [5,4],
    // 'p' => 29,
    // 'author' => -3,
    // 'author__not_in' => [3],
    // 'author__in' => [3],
    // 'orderby' => 'title',
    // 'meta_key' => 'size',
    // 'meta_compare' => '=',
    // 'meta_value' => 's: S',
    // 'orderby' => 'meta_value',
    // 'order' => 'DESC',

    // 'meta_query' => array(
    //     'relation' => 'AND',
    //     array(
    //         'key'=> 'size',
    //         'value' => 's: S',
    //         'type' => 'char',
    //         'compare' => '='
    //     ),
    //     array(
    //         'key'=> 'price',
    //         'value' => array(50, 200),
    //         'type' => 'NUMERIC',
    //         'compare' => 'BETWEEN',
    //     )
    // )

    'tax_query' => [
        'relation'=> 'OR',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('education','sports'),
        ),
        array(
            'taxonomy' => 'post_cat',
            'field' => 'term_id',
            'terms' => array(4),
        ),
    ]
];      

$my_query = new WP_Query($args); 

if($my_query->have_posts()) {
    while ($my_query->have_posts()) { 
        $my_query->the_post(); 
        $size = get_field('size');
        $color = get_field('color');
        $price = get_field('price');
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <?php if(!empty($size) ||!empty($color) ||!empty($price)); ?>
        <ul>
            <?php if(!empty($size)): ?>
                <li><?php echo $size; ?></li>
                <?php endif; 
                 if(!empty($color)): ?>
                <li><?php echo $color; ?></li>
                <?php endif; 
                if(!empty($price)): ?>
                <li><?php echo $price; ?></li>
                <?php endif; 
                ?>
                <p>Category : <?php the_category(','); ?></p>
                <p>Tags : <?php the_tags(','); ?></p>
        </ul>
         <!-- <h4><?php the_author(); ?></h4>
         <h5>Order <?php the_field('order'); ?></h5> 
        <h6><?php echo get_comments_number(); ?></h6>  -->
        <?php the_excerpt(); ?>
    <?php
    }
    wp_reset_postdata();
}

?>

<?php

    get_footer();
?>
    