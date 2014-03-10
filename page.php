<?php
global $post;
$category_id = get_post_meta($post->ID, '_digitalsign_category', true);
$catslug = get_category($category_id)->slug;
//$collegeName = get_post_meta($post->ID, '_digitalsign_collegename', true);
$args = array( 'post_type' => 'post',
               'cat' => $category_id
             );
$post_query = new WP_Query($args);
?>

<?php get_header(); ?>

    <header id="branding" role="banner" class="row">
      <div id="inner-header" class="twelve columns">
        <div id="site-heading">
            <div class="ual-logo-desktop">
            <div class="logo-ual-<?php echo get_post_meta($post->ID, '_digitalsign_collegename', true)?> college"></div>
            </div>
        </div>
      </div>
    </header><!-- #branding -->

    <div id="content" class="twelve columns" role="main">

        <div class="row">

        <div id="setorbitwidth" class="eight columns">

            <div class="post-box eight columns">

                <?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>

                        <div id="post-<?php the_ID(); ?>" class="<?php echo get_post_meta($post->ID, '_digitalsign_background', true) ?> post eight columns">
                		<header>
                			<h1 class="entry-title"><?php the_title(); ?></h1>
                			<h2 class="entry-title"><?php echo get_post_meta($post->ID, '_digitalsign_subtitle', true) ?></h2>
                		</header>

                    		<div class="entry-content ten columns">
                    			<!-- <?php the_post_thumbnail('medium');?> -->
                    			<?php if(has_post_thumbnail()) {
                    			    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    			     echo '<img src="' . $image_src[0]  . '" class="five columns"  />';
                    			}
                    			?>
                    			<?php the_content(); ?>
                    			<a href="http://<?php echo get_post_meta($post->ID, '_digitalsign_link', true) ?>" class="link"><?php echo get_post_meta($post->ID, '_digitalsign_link', true) ?></a>
                    		</div>
                	    </div>

                <?php endwhile; ?> <!-- end of the loop -->
                <?php wp_reset_postdata(); ?>

            </div> <!-- end .post-box -->

        </div> <!-- end #main -->
<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebar = get_post_meta($post->ID, '_digitalsign_displaySidebar', $single = off);
	if ($disableSidebar !== 'off') { get_sidebar('page'); }
?>
        <?php // get_sidebar('page'); // sidebar 1, two columns ?>

        </div> <!-- end .row -->

    </div> <!-- end #content -->

<?php get_footer(); ?>
