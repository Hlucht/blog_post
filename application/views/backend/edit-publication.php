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
                    <?php echo 'Editar ' .$subtitle?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('adm/publication/update');

                                foreach($publications as $publication){
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
                                placeholder="Digite o título da publicação" value="<?php echo $publication->titulo?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-subtitulo">Subtitulo</label>
                                <input type="text" id="txt-subtitulo" name="txt-subtitulo"class="form-control" 
                                placeholder="Digite o subtítulo da publicação" value="<?php echo $publication->subtitulo?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-conteudo">Conteúdo</label>
                                <textarea name="txt-conteudo" id="txt-conteudo" class="form-control" cols="30" rows="10"><?php echo $publication->conteudo?></textarea>
                            </div>

                            <div class="form-group">
                                <label id="txt-data">Data</label>
                                <input type="datetime-local" id="txt-data" name="txt-data"class="form-control" 
                                value="<?php echo $publication->data?>">
                            </div>

                            <input type="hidden" name="txt-id" value="<?php echo $publication->id ?>"?>
                            <button type="submit" class="btn btn-default">Atualizar</button>

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
                    <?php echo 'Imagem de destaque do ' .$subtitle?>

                    <style>
                        img{
                            width:300px;
                        }
                    </style>
                </div>
                <div class="panel-body">

                <div class="row" style="padding-bottom: 15px">
                    <div class="col-lg-3 col-lg-offset-3">
                        <?php 
                            if($publication->img == 1){
                                echo img("assets/frontend/images/publication/" .md5($publication->id) .".jpg");
                            }else{
                                echo img("assets/frontend/images/publication/photoNull.png"); 
                            } 
                        ?>
                    </div>    
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            $divOpen='<div class="form-group">';
                            $divClose='</div>';

                            echo form_open_multipart('adm/publication/new_img');
                            echo form_hidden('id', md5($publication->id));

                            echo $divOpen;
                            $image=array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                            echo form_upload($image);
                            echo $divClose;    

                            echo $divOpen;
                            $button=array('name' => 'btn_add', 'id' => 'btn_add', 'class' => 'btn btn-default', 'value' => 'Adicionar imagem');
                            echo form_submit($button);
                            echo $divClose; 
                                
                            echo form_close();  
                        }
                        ?>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>