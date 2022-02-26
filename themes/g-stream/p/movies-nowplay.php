<?php

$hack_title = 'Now Playing Movies';
$hack_description = 'See a full list of Now Playing Movies at Theater on '.site_path();
get_header(); ?>

    <div class="jumbo-hero" style="background-image:url(<?php style_theme();?>/images/bg.jpg)">
        <div class="container">
            <div class="jumbo-hero__inner">
                <h1 class="header">Now Playing Movies</h1>
            </div>
        </div>
    </div>
<section class="mopie-fade">
        <div class="container">
            <div class="row">
<?php 
        if ( empty( $_GET[page] ) ) { $page = 1; }else{ $page = $_GET[page]; }
        $Movies = unserialize( ocim_data_movie('home_m_',$page, 'getNowPlayingMovies') );
        if( is_array($Movies['result']) ):
        foreach ( (array) array_slice($Movies['result'], 0, 18) as $row ) {
                ?>
         <article id="<?php echo $row['id'];?>" class="item col-6 col-md-2">
            <div class="thumb mb-4">
               <a href="<?php echo seo_movie($row['id'],$row['title']);?>" rel="bookmark" title="<?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)">
                  <div class="_img_holder">
                     <img class="img-fluid rounded" src="<?php echo $row['poster_path'];?>?resize=300,450" alt="Image <?php echo $row['title'];?>" title="Image <?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)">
                     <div class="_overlay_link">
                        <button class="play-button play-button--small" type="button"></button>
                        <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white">6.3/10</span></div>
                     </div>
                  </div>
               </a>
               <header class="entry-header">
                  <h2 class="entry-title">
                     <a href="<?php echo seo_movie($row['id'],$row['title']);?>" class="_title" rel="bookmark" title="<?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)"><?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)</a>
                  </h2>
               </header>
            </div>
         </article>
		 <?php 
                }
        endif; 
        ?>
                                                </div>

            <div class="row">
                <div class="col-12 text-center pagenate">
                    <ul class="pagination" role="navigation">
       <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">&lsaquo; Prev</span>
            </li>
        
        
                    <li class="page-item">
                <a class="page-link" href="/p/movies-nowplay/?page=1" rel="next">Next &rsaquo;</a>
            </li>
            </ul>

                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>