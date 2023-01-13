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
                                echo form_open('adm/login/insert');
                            ?>

                            <div class="form-group">
                                <label id="txt-nome">Nome</label>
                                <input type="text" id="txt-nome" name="txt-nome"class="form-control" 
                                placeholder="Digite o nome do usuário" value="<?php echo set_value('txt-nome')?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-email">E-mail</label>
                                <input type="text" id="txt-email" name="txt-email"class="form-control" 
                                placeholder="Digite o email do usuário" value="<?php echo set_value('txt-email')?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-historico">Histórico</label>
                                <textarea name="txt-historico" id="txt-historico" class="form-control" cols="30" rows="10"><?php echo set_value('txt-historico')?></textarea>
                            </div>

                            <div class="form-group">
                                <label id="txt-user">User</label>
                                <input type="text" id="txt-user" name="txt-user"class="form-control" 
                                placeholder="Digite o user" value="<?php echo set_value('txt-user')?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-senha">Senha</label>
                                <input type="password" id="txt-senha" name="txt-senha"class="form-control">
                            </div>

                            <div class="form-group">
                                <label id="txt-confirmar-senha">Confirmar senha</label>
                                <input type="password" id="txt-confirmar-senha" name="txt-confirmar-senha"class="form-control">
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
                            <style>
                                img{
                                    width: 80px;
                                }
                            </style>
                            <?php 
                                $this->table->set_heading("Foto", "Nome", "Alterar", "Excluir");
                                foreach($users as $user){
                                    
                                        if($user->img == 1){
                                            $photo= img("assets/frontend/images/users/" .md5($user->id) .".jpg");
                                        }else{
                                            $photo= img("assets/frontend/images/users/photoPattern.jpg"); 
                                        } 

                                    $name= $user->nome;
                                    $edit= anchor(base_url('adm/login/edit/' .md5($user->id)), '<i class="fa fa-refresh fa-fw"></i> Alterar');
                                    $delete= anchor(base_url('adm/login/delete/' .md5($user->id)), '<i class="fa fa-remove fa-fw"></i> Excluir');
                                
                                    $this->table->add_row($photo, $name, $edit, $delete);
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


<!-- <form role="form">
    <div class="form-group">
        <label>Titulo</label>
        <input class="form-control" placeholder="Entre com o texto">
    </div>
    <div class="form-group">
        <label>Foto Destaque</label>
        <input type="file">
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <textarea class="form-control" rows="3"></textarea>
    </div>
                                       
    <div class="form-group">
        <label>Selects</label>
        <select class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Cadastrar</button>
    <button type="reset" class="btn btn-default">Limpar</button>
</form> -->