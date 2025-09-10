<?php get_header(); ?>

<main id="main" class="site-main">
    <section class="intro">
        <h1>Welcome to the Remote Controlled Theme</h1>
        <p>This theme dynamically loads styling and scripts from a remote server.</p>
    </section>

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            echo '<article>';
            the_title('<h2>', '</h2>');
            the_content();
            echo '</article>';
        endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
