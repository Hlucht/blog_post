<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Busca no Blog</h4>
        <div class="input-group">

            <?php echo form_open('publication/search'); ?>

                <input type="text" class="form-control" name="search" id="search" >

                <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span></button>

            <?php echo form_close(); ?>

        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Categorias do Blog</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php foreach($categories as $category){ ?>

                        <li><a href="<?php echo base_url('category/' .$category->id .'/' .clean($category->titulo)) ?>"><?php echo $category->titulo?></a></li>

                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>