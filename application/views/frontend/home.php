<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            <?php echo $title?>
            <small>> <?php echo $subtitle?></small>
        </h1>

        <?php foreach($publications as $publication) { ?>
            <h2>
                <a href="<?php echo base_url('publication/' .$publication->id .'/' .clean($publication->titulo)) ?>"><?php echo $publication->titulo ?></a>
            </h2>
            <p class="lead">
                por <a href="<?php echo base_url('user/' .$publication->usuarioId .'/' .clean($publication->nome))?>"><?php echo $publication->nome?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo formatDate($publication->data)?></p>
            <hr>

            <?php if($publication->img == 1){ 
                $imgPubli= base_url("assets/frontend/images/publication/" .md5($publication->id) .".jpg");    
            ?>
            <img class="img-responsive" src="<?php echo  $imgPubli?>" alt="">
            <hr>

            <?php } ?>

            <p><?php echo $publication->subtitulo; ?></p>
            
            <a class="btn btn-primary" href="<?php echo base_url('publication/' .$publication->id .'/' .clean($publication->titulo)) ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
        <?php } ?>
    </div>