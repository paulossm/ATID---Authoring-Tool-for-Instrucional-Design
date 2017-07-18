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
        <script src="<?php echo base_url(); ?>javascript/notify.js"></script> 
                
        <!--Functions to share a network and autocomplete for e-mails of Users already registered-->
        <script type="text/javascript">          
                                
            $(document).ready(function(){                
                                            
                $("span.help-block").hide();                
                //$("#email").keyup(validar);                                  

                //Clean modal when close
                $("#botaoCloseModal").add("#iconeFecharModal").click(function() {
                    $("#email").parent().parent().attr("class", "form-group");
                    $("#email").parent().children("span").text("").hide();
                    $("#email").val("");                                        
                });

                $(":submit").click(function() {
                   
                    $("#myModal").on('hidden.bs.modal', function () {
                        notificarEmailCompartilhado();
                    });                    

                });                
  
                var ehListaEmails = "";                             
                //Autocomplete for emails                        
                $(function(){                                          
                    $("#email").autocomplete({                        
                        source: "<?php echo base_url(); ?>index.php/Dashboard/autoCompleteEmails",   
                        
                        response: function( event, ui ) {                                                        
                            ehListaEmails = true;
                            validar(ui, ehListaEmails);
                        },
                        
                        select: function( event, ui ) {                            
                            ehListaEmails = false;                                                                                        
                            $("#email").attr("value", ui);                                                                                    
                            validar(ui, ehListaEmails);                            
                        },
                        
                        change: function( event, ui ) {
                            $("#email").attr("value", ui);
                            validar(ui, ehListaEmails);
                        }                        
                    })
                         
                }); 
                                                                        
           });                                            

            function entradaCorreta(){
                $("#iconeFeedBack").remove(); 
                $("#email").parent().parent().attr("class", "form-group has-success has-feedback");
                $("#email").parent().children("span").text("Email valid").show();
                $("#email").parent().append("<span id='iconeFeedBack' class='glyphicon glyphicon-ok form-control-feedback'></span>");
                $(":submit").attr("disabled", false);
                return true;
            }

            function entradaIncorreta(){
                $("#iconeFeedBack").remove(); 
                $("#email").parent().parent().attr("class", "form-group has-error has-feedback");
                $("#email").parent().children("span").text("Select a email address from the list").show();
                $("#email").parent().append("<span id='iconeFeedBack' class='glyphicon glyphicon-remove form-control-feedback'></span>");
                $(":submit").attr("disabled", true);
                return false;
            } 

            function validar(emails, flagListaDeEmails){                                
                
                var emailDigitado = document.getElementById("email").value;                                      

                //Vazio
                if(!emailDigitado){
                    entradaIncorreta();
                }

                //Lista de Emails ou email selecionado de autocomplete
                if(flagListaDeEmails == true){

                    for (var i = 0; i < emails.content.length; i++) {                                                      
                    
                        if( emailDigitado.localeCompare(emails.content[i].value) == 0 ){
                            entradaCorreta();                            
                            break;
                        }                                            
                        entradaIncorreta();
                    }                    
                }
                else{
                    entradaCorreta();
                }                               
            }
            
            function compartilhar (idDado){
                
                //seta o caminho para quando clicar em "Apagar".
                var value =  idDado;
                
                //adiciona atributo de delecao ao link
                $('#id_rede').prop("value", value);
                
            }

            function notificarEmailCompartilhado(){
                $.notify(
                        "You have share a network!",
                        { globalPosition: "bottom left",                                   
                          hideDuration: 1000,
                          autoHide: true,
                          autoHideDelay: 3500  }
                );
            }

        </script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/atid.css" type="text/css">                        
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">                
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">                
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">                
        <link rel="stylesheet" href="<?php echo base_url(); ?>javascript/jquery-ui-1.12.1.custom/jquery-ui.css" type="text/css">
    
        <!-- CANVAS SUPPORT FOR INTERNET EXPLORER 8 AND EARLIER -->
        <!--[if lte IE 8]><script type="text/javascript" src="javascript/excanvas.js"></script><![endif]-->
    </head>
    
    <body id="atid-desktop" class="row">
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
            <h3 class="col-xs-3 col-md-2"><a class="btn btn-edit" href="<?php echo base_url(); ?>index.php/Draw/"><i class="fa fa-plus fa-fw"></i> New</a></h3>
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
                                    <a class="btn btn-edit" <a href="<?php echo base_url(); ?>index.php/Dashboard/editar/<?php echo md5($id) ?>"/><i class="fa fa-pencil-square-o"></i> edit</a>
                                    <a class="btn btn-success" data-toggle="modal" onclick="compartilhar(<?php echo $id ?>)" data-target="#myModal"><i class="fa fa-share-square-o"></i> share</a>                        
                                </div>
                            </div>
                        </li>
                        
                        
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">                         
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button id="iconeFecharModal" type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Share network</h4>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="form-group">

                                            <form id="formShareEmail" role="form" action="<?=base_url()?>index.php/Dashboard/cadastrarRedeCompartilhada" method="get">
                                                <label for="email">E-Mail</label>
                                                
                                                <input class="form-control" name="email" id="email"  placeholder="email@you.com" type="email" >
                                                <span class="help-block"></span>                                            

                                                <input type="hidden" name="id_rede" id="id_rede" />                                            
                                        </div>        

                                    </div>
                                    <div class="modal-footer">                                                                                
                                                <button id="botaoCloseModal"  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button id="<?php echo ($id) ?>" name="<?php echo ($id) ?>" type="submit" class="btn btn-default" disabled="true">Send</button>
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
