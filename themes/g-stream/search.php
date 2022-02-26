<?php
/*
| -------------------------------------------------------------------------------
| Author            : Galih Sophian
| Template Name     : G-Silvers V3
| -------------------------------------------------------------------------------
*/
include('header.php');
$newquery = bad_words( get_search_query() );
?>
<div class="jumbo-hero" style="background-image:url(/assets/v1/images/bg.jpg)">
        <div class="container">
            <div class="jumbo-hero__inner">
                <h1 class="header">Search Result for "<?php echo $newquery;?>"</h1>
            </div>
        </div>
    </div>
<section class="mopie-fade">
   <div class="container">
      <div class="row">
<?php 
        if ( empty( $_GET[page] ) ) { $page = 1; }else{ $page = $_GET[page]; }
        $Movies = unserialize( ocim_data_search_movie(limit_word($newquery, 3),$page) );
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
                        <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $row['vote_average'];?>/10</span></div>
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
        else:
            $unserialize = unserialize( ocim_search(limit_word($newquery, 3), limit_word($newquery, 3).'_search') );
            if( is_array($unserialize['result']) ):
                foreach ( (array) $unserialize['result'] as $sect) {
                ?>
         <article id="<?php echo $sect['id'];?>" class="item col-6 col-md-2">
            <div class="thumb mb-4">
               <a href="<?php echo seo_video($sect['id'],$sect['title']);?>" rel="bookmark" title="<?php echo $sect['title'];?> (<?php echo date('Y', strtotime( $sect['release_date'] ) );?>)">
                  <div class="_img_holder">
                     <img class="img-fluid rounded" src="<?php echo $sect['poster_path'];?>?resize=300,450" alt="Image <?php echo $sect['title'];?>" title="Image <?php echo $sect['title'];?> (<?php echo date('Y', strtotime( $sect['release_date'] ) );?>)">
                     <div class="_overlay_link">
                        <button class="play-button play-button--small" type="button"></button>
                        <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $sect['vote_average'];?>/10</span></div>
                     </div>
                  </div>
               </a>
               <header class="entry-header">
                  <h2 class="entry-title">
                     <a href="<?php echo seo_movie($sect['id'],$sect['title']);?>" class="_title" rel="bookmark" title="<?php echo $sect['title'];?> (<?php echo date('Y', strtotime( $sect['release_date'] ) );?>)"><?php echo $sect['title'];?> (<?php echo date('Y', strtotime( $sect['release_date'] ) );?>)</a>
                  </h2>
               </header>
            </div>
         </article>
            <?php
                }
            else: ?>
            <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2><i class="fa fa-exclamation"></i> No Movie Found for this search</h2>
                        </div>
                    </div>
                </div>
                <br>
            <?php 
            endif; 
        endif;
        ?>
<?php if (config('tvdb_search') == "false"): ?>
<?php
                $tvdb  = new Tvdb(options('tvdb_api'));
                $serie = $tvdb->search($newquery);
                $count = 0;
                ?>
                <?php if (!empty($serie)): ?>
                <?php foreach ($serie as $tv): ?>
                <?php $_seri = $tvdb->seriesEpisode($tv->id)['serie'] ?>
         <article id="<?php echo $sect['id'];?>" class="item col-6 col-md-2">
            <div class="thumb mb-4">
               <a href="<?php seo_serie($tv->id) ?>" rel="bookmark" title="<?php echo $tv->name ?>">
                  <div class="_img_holder">
                     <img class="img-fluid rounded" src="<?php echo $tvdb->poster($_seri->poster) ?>?resize=300,450" alt="Image <?php echo $tv->name ?>" title="Image <?php echo $tv->name ?>">
                     <div class="_overlay_link">
                        <button class="play-button play-button--small" type="button"></button>
                        <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $_seri->rating;?>/10</span></div>
                     </div>
                  </div>
               </a>
               <header class="entry-header">
                  <h2 class="entry-title">
                     <a href="<?php seo_serie($tv->id) ?>" class="_title" rel="bookmark" title="<?php echo $tv->name ?>"><?php echo $tv->name ?></a>
                  </h2>
               </header>
            </div>
         </article>
                <?php endforeach ?>
                <?php else: ?>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2><i class="fa fa-exclamation"></i> No TV Show Found for this search</h2>
                        </div>
                    </div>
                </div>
                <?php endif ?>
        <?php else: ?>
<?php 
                            $TV = unserialize( ocim_data_search_tv(limit_word($newquery, 3),$page) );
                            if( is_array($TV['result']) ):
                                foreach ( (array) array_slice($TV['result'], 0, 18) as $row ) {
                                    ?>
         <article id="<?php echo $row['id'];?>" class="item col-6 col-md-2">
            <div class="thumb mb-4">
               <a href="<?php echo seo_tv($row['id'],$row['title']);?>" rel="bookmark" title="<?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)">
                  <div class="_img_holder">
                     <img class="img-fluid rounded" src="<?php echo $row['poster_path'];?>?resize=300,450" alt="Image <?php echo $row['title'];?>" title="Image <?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)">
                     <div class="_overlay_link">
                        <button class="play-button play-button--small" type="button"></button>
                        <div class="rate"><i class="fa fa-star text-warning"></i> <span class="small text-white"><?php echo $row['vote_average'];?>/10</span></div>
                     </div>
                  </div>
               </a>
               <header class="entry-header">
                  <h2 class="entry-title">
                     <a href="<?php echo seo_tv($row['id'],$row['title']);?>" class="_title" rel="bookmark" title="<?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)"><?php echo $row['title'];?> (<?php echo date('Y', strtotime( $row['release_date'] ) );?>)</a>
                  </h2>
               </header>
            </div>
         </article>
                                    <?php 
                                } 
                                else:
                                    ?>
                                <div class="row">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h2><i class="fa fa-exclamation"></i> No TV Show Found for this search</h2>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <?php
                                endif;
                                ?>
<?php endif ?>
      </div>
      <div class="row">
         <div class="col-12 text-center pagenate">
            <ul class="pagination" role="navigation">
               <?php 
                                if ($TV['total_results'][0] > 19) :
                                    require_once( DOCUMENT_ROOT. '/app/class/CSSPagination.class.php');

                                if ($TV['total_results'][0] > 1000) :
                                    $totalResults = 1000;
                                else:
                                    $totalResults = $TV['total_results'][0];
                                endif;
                                $limit  = 20; 
                                $link   = '/?s='.get_search_query();
                                $pagination = new CSSPagination($totalResults, $limit, $link ); // create instance object
                                $pagination->setPage($_GET[page]); // dont change it
                                echo $pagination->showPage();
                                endif;
                                ?>
            </ul>
         </div>
      </div>
   </div>
</section>
<?php include('footer.php'); ?>