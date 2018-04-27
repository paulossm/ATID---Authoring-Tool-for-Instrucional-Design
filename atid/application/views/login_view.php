<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>ATID - Authoring Tool for Instructional Design</title>
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/base.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/atid.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        

        <!-- CANVAS SUPPORT FOR INTERNET EXPLORER 8 AND EARLIER -->
        <!--[if lte IE 8]><script type="text/javascript" src="<?php echo base_url(); ?>javascript/excanvas.js"></script><![endif]-->
    </head>
    
    <body id="atid-desktop" class="row signupScreen">
        
        <section id="authentication" class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="artwork text-center">
                <h1 class="text-primary">ATID</h1>
                <small>Authoring Tool for Instructional Design</small>
            </div>
            <ul class="nav nav-tabs formTabs">
                <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
                <li role="presentation"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab">Signup</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="login">
                    <form class="loginForm" action="<?=base_url()?>index.php/Principal/autenticar" method="post">                
                                            
                        <?php 
                            if(isset($_GET['invalid']))
                            {
                                echo "Invalid Email and Password";
                            }   
                        ?>
                                                                     
                        <fieldset class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="email@domain.com" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="senha">Passsword</label>
                            <input class="form-control" type="password" name="senha" id="senha" placeholder="type your password" required>
                            <a href="<?php echo base_url(); ?>index.php/Principal/resetar_senha">Forgot password?</a>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">Log me in</button>
                    </form>        
                </div>
                <div role="tabpanel" class="tab-pane" id="signup">
                    <form class="signupForm" action="<?=base_url()?>index.php/Principal/cadastrar_usuario" method="post">                
                        <fieldset class="form-group" >
                            <label for="nome">Full name</label>
                            <input class="form-control" type="text" name="nome" id="nome" placeholder="type your name" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="email@domain.com" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="senha">Password</label>
                            <input class="form-control" type="password" name="senha" id="senha" placeholder="choose a password" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="senha-confirma">Confirm password</label>
                            <input class="form-control" type="password" name="senha-confirma" placeholder="confirm the password" id="senha-confirma" required>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">Sign me up</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-12">
                <ul class="partners">
                    <li class="pull-left"><a title="Instituto Metrópole Digital" href="https://imd.ufrn.br" target="_blank"><img src="<?php echo base_url(); ?>images/imd.png" alt="Logo Instituto Metrópole Digital"></a></li>
                    <li class="pull-right"><a title="Universidade Federal do Rio Grande do Norte" href="https://ufrn.br" target="_blank"><img src="<?php echo base_url(); ?>images/ufrn.png" alt="Logo Universidade Federal do Rio Grande do Norte"></a></li>
                </ul>
            </div>
        </section>
        
        <script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo base_url(); ?>javascript/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>javascript/jcanvas.js"></script>
        <script src="<?php echo base_url(); ?>javascript/atid.js"></script> 
    </body>
</html>
