<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <?php foreach($publications as $publication) { ?>
            <h1>
               <?php echo $publication->titulo ?>
            </h1>
            <p class="lead">
                por <a href="<?php echo base_url('user/' .$publication->usuarioId .'/' .clean($publication->nome))?>"><?php echo $publication->nome?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo formatDate($publication->data)?></p>
            <hr>
            <p><i><?php echo $publication->subtitulo?></i></p>
            
            <?php if($publication->img == 1){ 
                $imgPubli= base_url("assets/frontend/images/publication/" .md5($publication->id) .".jpg");    
            ?>
            <img class="img-responsive" src="<?php echo  $imgPubli?>" alt="">
            <hr>

            <?php } ?>
            
            <p><?php echo $publication->conteudo ?></p>
            <hr>
        <?php } ?>
    </div>