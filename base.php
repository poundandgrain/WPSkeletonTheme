<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

    <?php
    do_action('get_header');
    get_template_part('templates/header');
    ?>

    <?php include pandg_template_path(); ?>



    <?php get_template_part('templates/footer'); ?>
</body>
</html>