<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $subtitle?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo '+ ' .$subtitle?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('adm/category/insert');
                            ?>

                            <div class="form-group">
                                <label id="txt-categoria">Nome</label>
                                 <input type="text" id="txt-categoria" name="txt-categoria"class="form-control" placeholder="Digite o nome da categoria">
                            </div>

                            <button type="submit" class="btn btn-default">Cadastrar</button>

                            <?php
                            echo form_close();
                            ?>
                        </div>
                                
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->


        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Editar ' .$subtitle?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                $this->table->set_heading("Nome", "Alterar", "Excluir");
                                foreach($categories as $category){
                                    $name= $category->titulo;
                                    $edit= anchor(base_url('adm/category/edit/' .md5($category->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                    $delete= anchor(base_url('adm/category/delete/' .md5($category->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');
                                
                                    $this->table->add_row($name, $edit, $delete);
                                }

                                $this->table->set_template(array(
                                    'table_open' => '<table class="table table-striped">'
                                ));
                                echo $this->table->generate();
                            ?>
                        </div>    
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>