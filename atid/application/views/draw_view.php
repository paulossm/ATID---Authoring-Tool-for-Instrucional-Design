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
        <!--[if lte IE 8]><script type="text/javascript" src="<?php echo base_url(); ?>javascript/excanvas.js"></script><![endif]-->
    </head>
    
    <body id="atid-desktop" class="row">
        <header class="col-xs-12 col-lg-12">
            <a id="logo" class="logo col-lg-2">ATID</a>
            <ul class="headerBar col-lg-10" style="list-style-type: none;">
                <li id="institute" style="display: inline;" class="col-lg-3">
                    <h2>UFRN<br>Instituto Metrópole Digital</h2>
                </li>
                
                <li id="course" style="display: inline;" class="col-lg-3">
                    <h2>Current Editing <span class="courseName">Tecnico em Tecnologia da Informação</span></h2>
                </li>
                
                <li id="userInfo" style="display: inline;" class="col-lg-6">
                    <div class="media">
                        <div class="text-right media-body">
                            <h4 class="media-heading"><?php echo @$_SESSION['nome'];?><br><span id="userRole">Instructor</span></h4>
                        </div>
                        <div class="media-right media-middle">
                            <a href="#">
                            <img class="media-object" src="<?php echo base_url(); ?>images/profile.jpg" alt="user profile picture">
                            </a>
                        </div>
                        <div class="media-right media-middle">
                            <button id="logout" type="button"><a href="<?php echo base_url(); ?>index.php/Principal/deslogar"><i class="fa fa-sign-out"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
        
        <!-- CONTROL TOOLS -->
        <ul id="control-tools" class="col-xs-12 col-lg-12" style="list-style-type: none;">
            <!--<li style="display: inline;"><button type="button"><i class="fa fa-file-o" aria-hidden="true"></i>
 new</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-folder-open-o" aria-hidden="true"></i>
open</button></li>-->
            <li style="display: inline;"><button type="button" onclick="saveNetwork()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
save</button></li>
            <!--<li style="display: inline;"><button type="button"><i class="fa fa-share-square-o" aria-hidden="true"></i>
share</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-undo" aria-hidden="true"></i>
undo</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-repeat" aria-hidden="true"></i>
redo</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-clone" aria-hidden="true"></i>
copy</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-scissors" aria-hidden="true"></i>
cut</button></li>
            <li style="display: inline;"><button type="button"><i class="fa fa-clipboard" aria-hidden="true"></i>
paste</button></li>
            <li style="display: inline;"><button type="button">reachability</button></li>-->
        </ul>
        

    <section id="drawingArea" class="col-lg-12">

        <form id="drawTools" class="col-lg-1" style="list-style-type: none;">
                <label class="currentTool">
                    <input class="tool tool-cursor" type="radio" name="tool"  value="cursor" onchange="pickTool()" checked="checked">
                    <img src="<?php echo base_url(); ?>images/tools/dft_hover.svg" alt="cursor tool"  data-source="url('images/tools/dft.svg')" data-highlighted="url('images/tools/dft_hover.svg')">
                    <p class="tool-title">cursor</p> 
                </label>
            
                <label>
                    <input class="tool tool-activity" type="radio"   name="tool"  value="activity" onchange="pickTool()">
                    <img data-source="url('images/tools/activity.svg')" data-highlighted="url('images/tools/activity_hover.svg')" src="<?php echo base_url(); ?>images/tools/activity.svg" alt="cursor tool">
                    <p class="tool-title">activity</p>
                </label>
            
                <label>
                    <input class="tool tool-transition" type="radio"   name="tool" value="transition" onchange="pickTool()">
                    <img data-source="url('images/tools/transition.svg')" data-highlighted="url('images/tools/transition_hover.svg')" src="<?php echo base_url(); ?>images/tools/transition.svg" alt="cursor tool">
                    <p class="tool-title">transition</p>
                </label>
            
                <label>
                    <input class="tool tool-event" type="radio"   name="tool" value="event" onchange="pickTool()">
                    <img data-source="url('images/tools/event.svg')" data-highlighted="url('images/tools/event_hover.svg')" src="<?php echo base_url(); ?>images/tools/event.svg" alt="cursor tool">
                    <p class="tool-title">event</p>
                </label>
            
                <label>
                    <input class="tool tool-repository" type="radio" name="tool" value="repository" onchange="pickTool()">
                    <img data-source="url('images/tools/repository.svg')" data-highlighted="url('images/tools/repository_hover.svg')" src="<?php echo base_url(); ?>images/tools/repository.svg" alt="cursor tool">
                    <p class="tool-title">repository</p>
                </label>
            
                <label>
                    <input class="tool tool-subnet" type="radio"   name="tool" value="composition" onchange="pickTool()">
                    <img data-source="url('images/tools/composite_activity.svg')" data-highlighted="url('images/tools/composite_activity_hover.svg')" src="<?php echo base_url(); ?>images/tools/composite_activity.svg" alt="cursor tool">
                    <p class="tool-title">subnet</p>
                </label>
            
                <label>
                    <input class="tool tool-arc" type="radio"   name="tool" value="arc" onchange="pickTool()">
                    <img data-source="url('images/tools/arc.svg')" data-highlighted="url('images/tools/arc_hover.svg')" src="<?php echo base_url(); ?>images/tools/arc.svg" alt="arc tool">
                    <p class="tool-title">arc</p>
                </label>
        </form>      
        <div id="drawScreen">
            <canvas class="tool-cursor">Your browser doesn't support canvas</canvas>
            
            <div id="descriptionInput" hidden>                
                <h4 id="descriptionTitle"></h4>
                <label for="nodeTitle">título</label>
                <input type="text" id="nodeTitle">
                <button type="button" onclick="submitDescription()" id="submitDescription">Ok</button>
            </div>
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
