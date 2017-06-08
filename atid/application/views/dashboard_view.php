<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Dashboard - ATID - Authoring Tool for Instructional Design</title>
                 
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous">                
        </script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
                crossorigin="anonymous">
                    
        </script>
        <script src="<?php echo base_url(); ?>javascript/jcanvas.js"></script>
        <script src="<?php echo base_url(); ?>javascript/atid.js"></script> 
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>               
        <script src="<?php echo base_url(); ?>javascript/jquery-ui-1.12.1.custom/jquery-ui.js"></script> 

        <!--Functions to share a network and autocomplete for e-mails of Users already registered-->
        <script>          
            $(function(){
                $("#email").autocomplete({
                    source: "<?php echo base_url(); ?>index.php/Dashboard/autoCompleteEmails"
                    
                })
            });

            function compartilhar (idDado){
                //seta o caminho para quando clicar em "Apagar".
                var value =  idDado;
                //adiciona atributo de delecao ao link
                $('#id_rede').prop("value", value);
            }
        </script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/atid.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">                
        <link rel="stylesheet" href="<?php echo base_url(); ?>javascript/jquery-ui-1.12.1.custom/jquery-ui.css" type="text/css">
    
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
                            <a id="logout" class="btn" href="<?php echo base_url(); ?>index.php/Principal/deslogar"/><i class="fa fa-sign-out"></i> Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>        

        <section id="networkList" class="col-xs-12 col-lg-12">
            <h2 class="col-xs-9 col-md-3">My Networks <span id="networkCounter"><?php echo $qtd?></span></h2>
            <h3 class="col-xs-3 col-md-2"><a class="btn btn-success" href="<?php echo base_url(); ?>index.php/Draw/"><i class="fa fa-plus fa-fw"></i> New</a></h3>
            <ul id="networks" class="list-group col-xs-12">
                

                <?php 
                if (empty($list)) { ?>
                    <h4 class="text-muted">You haven't created any network</h4>
                <?php }
                else {
                    foreach ($list as $item): 
                        $nome = $item->nome;
                        $id = $item->id_rede;
                        $usuario = $item->nome_usuario;
                        $data = $item->data_modificacao;
                        $hora = explode(" ", $data);
                        $dia = explode("-", $hora[0]);?>

                        <li class="col-xs-6 col-lg-3">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $nome?></h3>
                                </div>
                                <div class="panel-body">
                                    <p><i class="fa fa-lightbulb-o"></i> created by: <span class="author"><?php echo $usuario?></span>
                                    <p><i class="fa fa-clock-o"></i> last modified: <?php echo $dia[0].'/'.$dia[2].'/'.$dia[1].' '.$hora[1]?></p>
                                </div>
                                <div class="panel-footer text-center">
                                    <button type="button" class="btn btn-warning"><a href="<?php echo base_url(); ?>index.php/Dashboard/editar/<?php echo md5($id) ?>"/><i class="fa fa-pencil-square-o"></i> edit</a></button>
                                    <button type="button" class="btn btn-warning" ><a  data-toggle="modal" onclick="compartilhar(<?php echo $id ?>)" data-target="#myModal"><i class="fa fa-share-square-o"></i>share</a></button>
                                </div>
                            </div>
                        </li>
                        
                        
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">                         
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Share network</h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <form action="<?=base_url()?>index.php/Dashboard/cadastrarRedeCompartilhada" method="get">
                                            <label>E-Mail</label>
                                            <input class="form-control email" name="email" id="email"  placeholder="email@you.com" type="text" />     
                                            <input type="hidden" name="id_rede" id="id_rede" />                                            
                                    </div>
                                    <div class="modal-footer">                                                                                
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id="<?php echo ($id) ?>" name="<?php echo ($id) ?>" type="submit" class="btn btn-default">Send</button>
                                        </form>    
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    <?php 
                    endforeach;
                } 
                    ?>
            </ul>
        </section>


    </body>
</html>
