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
                                echo form_open('adm/login/update');
            
                                foreach($users as $user){
                            ?>

                            <div class="form-group">
                                <label id="txt-nome">Nome</label>
                                <input type="text" id="txt-nome" name="txt-nome"class="form-control" 
                                placeholder="Digite o nome do usuário" value="<?php echo $user->nome?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-email">E-mail</label>
                                <input type="text" id="txt-email" name="txt-email"class="form-control" 
                                placeholder="Digite o email do usuário" value="<?php echo $user->email?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-historico">Histórico</label>
                                <textarea name="txt-historico" id="txt-historico" class="form-control" cols="30" rows="10"><?php echo $user->historico?></textarea>
                            </div>

                            <div class="form-group">
                                <label id="txt-user">User</label>
                                <input type="text" id="txt-user" name="txt-user"class="form-control" 
                                placeholder="Digite o user" value="<?php echo $user->user?>">
                            </div>

                            <div class="form-group">
                                <label id="txt-senha">Senha</label>
                                <input type="password" id="txt-senha" name="txt-senha"class="form-control">
                            </div>

                            <div class="form-group">
                                <label id="txt-confirmar-senha">Confirmar senha</label>
                                <input type="password" id="txt-confirmar-senha" name="txt-confirmar-senha"class="form-control">
                            </div>

                            <input type="hidden" name="txt-id" id="txt-id" value="<?php echo $user->id?>">
                            <button type="submit" class="btn btn-default">Atualizar</button>

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


        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Imagem de destaque do ' .$subtitle?>
                </div>
                <div class="panel-body">

                <div class="row" style="padding-bottom: 15px">
                    <div class="col-lg-3 col-lg-offset-3">
                        <?php 
                            if($user->img == 1){
                                echo img("assets/frontend/images/users/" .md5($user->id) .".jpg");
                            }else{
                                echo img("assets/frontend/images/users/photoPattern.jpg"); 
                            } 
                        ?>
                    </div>    
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            $divOpen='<div class="form-group">';
                            $divClose='</div>';

                            echo form_open_multipart('adm/login/new_img');
                            echo form_hidden('id', md5($user->id));

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