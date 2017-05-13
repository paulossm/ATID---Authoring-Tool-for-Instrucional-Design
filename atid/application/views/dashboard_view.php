<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>ATID - Authoring Tool for Instructional Design</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/atid.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">

        <!-- CANVAS SUPPORT FOR INTERNET EXPLORER 8 AND EARLIER -->
        <!--[if lte IE 8]><script type="text/javascript" src="javascript/excanvas.js"></script><![endif]-->
    </head>
    
    <body id="atid-desktop" class="">
        <header class="col-xs-12 col-lg-12">
            <a id="logo" class="logo col-lg-2">ATID</a>
            <ul class="headerBar col-lg-10" style="list-style-type: none;">
                
                <li id="userInfo" style="display: inline;" class="col-lg-3 pull-right">
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#">
                            <img class="media-object" src="<?php echo base_url(); ?>images/profile.jpg" alt="user profile picture">
                            </a>
                        </div>
                        <div class="text-left media-body media-middle">
                            <h4 class="media-heading"><?php echo @$_SESSION['nome'];?><br><span id="userRole">Instructor</span></h4>
                        </div>
                        <div class="media-right media-middle btn-group" role="group">
                            <button id="logout" type="button"  class="btn"><a href="<?php echo base_url(); ?>index.php/Principal/deslogar"/><i class="fa fa-sign-out"></i> Sair</a></button>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
        <section id="networkList" class="col-xs-12 col-lg-12">
            <header>

            </header>
            <h2>Minhas redes <span id="networkCounter"><?php echo $qtd?></span></h2>
            <ul id="networks" class="list-group">
                

                <?php foreach ($list as $item): 
                    $nome = $item->nome;
                    $usuario = $item->nome_usuario;
                    $data = $item->data_modificacao;?>

                     <li class="col-xs-6 col-lg-3">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $nome?></h3>
                            </div>
                            <div class="panel-body">
                                <p><i class="fa fa-lightbulb-o"></i> criado por: <span class="author"><?php echo $usuario?></span>
                                <p><i class="fa fa-clock-o"></i> última edição: <?php echo $data?></p>
                            </div>
                            <div class="panel-footer text-center">
                                <button type="button" class="btn btn-warning"><a href="<?php echo base_url(); ?>index.php/Dashboard/editar"/><i class="fa fa-pencil-square-o"></i> editar</a></button>
                            </div>
                        </div>
                    </li>

                <?php endforeach ?>
                
            </div>
        </section>
        
        <script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>javascript/jcanvas.js"></script>
        <script src="<?php echo base_url(); ?>javascript/atid.js"></script> 
    </body>
</html>
