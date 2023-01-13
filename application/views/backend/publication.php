<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $subtitle?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo '+ ' .$subtitle?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('adm/publication/insert');
                            ?>
                            <div class="form-group">
                                <label id="select-categoria">Categoria</label>
                                <select class="form-control" id="select-categoria" name="select-categoria">

                                <?php foreach($categories as $category){?>
                                    <option value="<?php echo $category->id?>"><?php echo $category->titulo?></option>
                                <?php }?> 

                                </select>
                            </div>

                            <div class="form-group">
                                <label id="txt-titulo">Título</label>
                                <input type="text" id="txt-titulo" name="txt-titulo"class="form-control" 
                                placeholder="Digite o título da publicação" value="<?php echo set_value('txt-nome')?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-subtitulo">Subtitulo</label>
                                <input type="text" id="txt-subtitulo" name="txt-subtitulo"class="form-control" 
                                placeholder="Digite o subtítulo da publicação" value="<?php echo set_value('txt-email')?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-conteudo">Conteúdo</label>
                                <textarea name="txt-conteudo" id="txt-conteudo" class="form-control" cols="30" rows="10"><?php echo set_value('txt-conteudo')?></textarea>
                            </div>

                            <div class="form-group">
                                <label id="txt-data">Data</label>
                                <input type="datetime-local" id="txt-data" name="txt-data"class="form-control" 
                                value="<?php echo set_value('txt-user')?>">
                            </div>

                            <input type="hidden" name="txt-usuario" id="txt-usuario" value="<?php echo $this->session->userdata('userLogged')->id; ?>">
                            <button type="submit" class="btn btn-default">Cadastrar</button>

                            <?php echo form_close(); ?>
                        </div>      
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->


        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Editar ' .$subtitle?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <style>
                                img{
                                    width: 120px;
                                }
                            </style>
                            <?php 
                                $this->table->set_heading("Foto", "Titulo", "Data", "Alterar", "Excluir");
                                foreach($publications as $publication){

                                    if($publication->img == 1){
                                        $imgPubli= img("assets/frontend/images/publication/" .md5($publication->id) .".jpg");
                                    }else{
                                        $imgPubli= img("assets/frontend/images/publication/photoNull.png"); 
                                    } 
                         
                                    $title= $publication->titulo;
                                    $edit= anchor(base_url('adm/publication/edit/' .md5($publication->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                    $delete= anchor(base_url('adm/publication/delete/' .md5($publication->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');
                                    $data= formatDate($publication->data);
                                    $this->table->add_row($imgPubli, $title, $data, $edit, $delete);
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