<?php 

/** 
 * 
 * Template Name:blogs_template
 */ 
 ?>
 <?php
get_header();
while(have_posts())
{
the_post();
?>
 <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/bg.gif')?>"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p></p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <?php 
$theparent=wp_get_post_parent_id(get_the_ID());
if($theparent)
{?>
  <div class="metabox metabox--position-up metabox--with-home-link">
  <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theparent);?>">
  <i class="fa fa-home" aria-hidden="true"></i> Back to <?php get_the_title($theparent);?></a> <span class="metabox__main">
  <?php the_title(); ?></span></p>
</div>

<?php } ?>
    <?php 
    $testarray=get_pages(array(
      'child_of' =>get_the_ID()
    ));
    if($theparent or $testarray ){ ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theparent); ?> "><?php echo get_the_title($theparent)?>
      </a></h2>
      <ul class="min-list">
       <?php 
if($theparent)
{
$findchildrenof=$theparent;
}else
{
  $findchildrenof=get_the_ID();
}
       wp_list_pages(array(
         'title_li'=> null,
         'child_of'=>$findchildrenof,
         'sort_column' =>order
       ));
       ?>
      </ul>
    </div>
   
    <?php  }?>
    <div class="generic-content">
    <?php 
   $paged=(get_query_var('paged')) ? get_query_var('paged') :1;
   $args=array(
     'post_type'=>'post' ,
     'post_status'=>'publish',
     'cat'=>'124',
     'posts_per_page'=>10,
     'paged'=>$paged,);

   $arr_posts=new WP_Query($args);
   if($arr_posts->have_posts()):
    while($arr_posts->have_posts()):$arr_posts->the_post();
   ?>
   <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4><br>
   <?php the_ID() ?>"<?php post_class(); ?>
   <?php 
   if (has_post_thumbnail()):the_post_thumbnail();
   endif;
    ?>
    <?php the_excerpt("more"); ?>
    <p><a href="<?php the_permalink() ?>"></a></p>
  <?php endwhile; 
  wp_pagenavi
  (array('query'=>$arr_posts,));
  endif;
  ?>
  </div>
<?php
}
get_footer();
?>
