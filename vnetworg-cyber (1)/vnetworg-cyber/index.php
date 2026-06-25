<?php get_header(); ?>
<div class="content-area">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            echo '<article class="card">';
            echo '<h2>' . get_the_title() . '</h2>';
            the_content();
            echo '</article>';
        endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
</div>
<?php get_footer(); ?>
