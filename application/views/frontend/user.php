<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            <?php echo $title?>
            <small>> 
                <?php 
                    if(!empty($subtitle))  echo $subtitle;
                    else {
                        foreach($subtitleDb as $subtitledb){
                            echo $subtitledb->titulo;
                        }
                    }
                ?>
            </small>
        </h1>

        <?php foreach($users as $user) { ?>
            <div class="col-md-4">
                <?php 
                    if($user->img == 1){
                        $img= "assets/frontend/images/users/" .md5($user->id) .".jpg";
                    }else{
                        $img= "assets/frontend/images/users/photoPattern.jpg"; 
                    } 
                ?>
                <img class="img-responsive img-circle" src="<?php echo base_url($img)?>" alt="">
                </div>
                <div class="col-md-8 ">
                    <h2>
                       <?php echo $user->nome?>
                    </h2> 
                    <hr>
                    <p><?php echo $user->historico?></p>
                    <hr>
                </div>
        <?php } ?>
    </div>