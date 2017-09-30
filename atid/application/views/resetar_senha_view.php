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

            <div class="tab-content">
                    <form class="loginForm" action="<?=base_url()?>index.php/Principal/recuperar_senha" method="post">                
                        <fieldset class="form-group">
                            <label for="email">Reset your password</label>

                            <?php if($id == 1) :?>
                                <p  style="color: red;">E-mail not found</p>
                            <?php endif; ?>

                            <p >Enter your email address and we will send you a link to reset your password.</p>
                            <input class="form-control" type="email" name="email" id="email" placeholder="email@domain.com" required>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Send password reset e-mail</button>
                    </form>
               
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
