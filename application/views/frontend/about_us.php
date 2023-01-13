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

        <div class="col-md-12 "> 
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <br>

            <h1 class="page-header">
                Nossos autores
            </h1>
            <div class="col-md-12 row">
                <?php foreach($users as $user) { ?>
                    <div class="col-md-4 col-xs-6">
                        <?php 
                            if($user->img == 1){
                                $img= "assets/frontend/images/users/" .md5($user->id) .".jpg";
                            }else{
                                $img= "assets/frontend/images/users/photoPattern.jpg"; 
                            } 
                        ?>
                        <img class="img-responsive img-circle" src="<?php echo base_url($img)?>" alt="">
                        
                        <h4 class="text-center">
                            <a href="<?php echo base_url('user/' .$user->id .'/' .clean($user->nome))?>"><?php echo $user->nome?></a>
                        </h4> 
                    </div>
                <?php } ?>
            </div>
    </div>