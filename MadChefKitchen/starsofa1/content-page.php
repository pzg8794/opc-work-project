<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
global $SMTheme;


?>
        <div class="entry-content">

                <h1 class="post-title" style="margin-top:-11.5%; position:absolute; font-family	: FontAwesome;
  				font-size	: 40px;
				font-weight	: bold;
  				color		: #990066;
  				text-align	: center;
				margin-left	: -0px;
    				text-shadow	: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;"><?php the_title(); ?></h1>

                <?php the_post_thumbnail(
                                'post-thumbnail',
                                array("class" => $SMTheme->get( 'layout','imgpos' ) . " featured_image")
                ); ?>
                <?php the_content( ); ?>
                <?php wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'letheme' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                ) ); ?>

        </div><!-- .entry-content -->