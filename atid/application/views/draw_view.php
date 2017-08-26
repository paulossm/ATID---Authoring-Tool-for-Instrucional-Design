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
    </head>
    
    <body id="atid-desktop">
        <header>
            <a id="logo"><img src="<?php echo base_url(); ?>images/logo.svg" alt="ATID logo" class="logo-img"></a>
            <ul class="headerBar" style="list-style-type: none;">
                 <li id="userInfo" style="display: inline;" class="">
                    <div class="media">
                        <div class="media-left media-middle">
                            <span>
                            <i class="fa fa-user-circle fa-lg"></i>
                            </span>
                        </div>
                        <div class="text-left media-body media-middle">
                            <h4 class="media-heading"><?php echo @$_SESSION['nome'];?>
                                <br>
                                <!--<span id="userRole">Instructor</span>-->
                            </h4>
                        </div>
                        <div class="media-right media-middle btn-group" role="group">
                            <a id="logout" class="btn" href="<?php echo base_url(); ?>index.php/Principal/deslogar"/><i class="fa fa-sign-out"></i> Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
        
        <!-- CONTROL TOOLS -->
        <section id="control-tools">
            <div class="btn-group save" role="group">
                <button type="button" class="btn btn-success" onclick="saveNetwork()" ><i class="fa fa-floppy-o" aria-hidden="true" ></i> save</button>
            </div>
        </section>

    <section id="drawingArea">

        <form id="drawTools" style="list-style-type: none;">
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
                    <input class="tool tool-subnet" type="radio"   name="tool" value="subnet" onchange="pickTool()">
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
            <!--<canvas class="tool-cursor">Your browser doesn't support canvas</canvas>-->
            <svg width="100%" height="100%" id="boardSVG" class="tool-cursor">
                <defs>
                    <!-- DEFAULT -->
                    <image id="activity" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/activity.svg"></image>
                    <image id="transition" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/transition.svg"></image>
                    <image id="repository" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/repository.svg"></image>
                    <image id="event" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/event.svg"></image>
                    <image id="subnet" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/composite_activity.svg"></image>

                    <!-- HOVER -->
                    <image id="activity_hover" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/activity_hover.svg"></image>
                    <image id="transition_hover" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/transition_hover.svg"></image>
                    <image id="repository_hover" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/repository_hover.svg"></image>
                    <image id="event_hover" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/event_hover.svg"></image>
                    <image id="subnet_hover" x="0" y="0" width="32.5" height="32.5" href="<?php echo base_url(); ?>images/tools/composite_activity_hover.svg"></image>

                    <!-- ARC -->
                    <marker id="arc_arrow" markerWidth="8" markerHeight="8" refX="8" refY="4" orient="auto" markerUnits="strokeWidth">
                        <path d="M 0 0 q 4 4 0 8 l 8 -4 Z" fill="#000000" />
                    </marker>

                    <marker id="arc_hover" markerWidth="8" markerHeight="8" refX="8" refY="4" orient="auto" markerUnits="strokeWidth">
                        <path d="M 0 0 q 4 4 0 8 l 8 -4 Z" fill="#3290be" />
                    </marker>

                    <marker id="error" markerWidth="8" markerHeight="8" refX="8" refY="4" orient="auto" markerUnits="strokeWidth">
                        <path d="M 0 4 l 8 0" stroke="#c9283b" stroke-width="1" />
                        <path d="M 4 0 l 0 8" stroke="#c9283b" stroke-width="1" />
                    </marker>


                   

                    <rect id="drawBoard" width="100%" height="100%" x="0" y="0" />
                </defs>
                
                <g id="subnet-1" class="subnet subnet-active">
                    <use id="board" fill="#fff" x="0" y="0" href="#drawBoard"></use>
                </g>
            </svg>
            
            <div id="descriptionInput" hidden>  
                <form id="prompt">
                    <div id="loadForm">
                        <h4 class="descriptionTitle">properties</h4>
                        <div class="form-group">
                            <label for="nodeTitle">title</label>
                            <input type="text" maxlength="20" id="nodeTitle" class="form-control" placeholder="">
                        </div>

                        <div id="_activity-form" hidden>
                            <div class="form-group">
                                <label for="start-date">start date</label>
                                <div class="input-group">
                                  <span class="input-group-addon" id="calendar1"><i class="fa fa-calendar"></i></span>
                                  <input type="text" id="start-date" class="date start form-control" aria-describedby="calendar1">
                                </div>

                                <!--<div class="input-group">
                                  <span class="input-group-addon" id="clock1"><i class="fa fa-clock-o"></i></span>
                                  <input type="text" id="start-time" class="time start form-control" aria-describedby="clock1">
                                </div>-->
                                
                                
                                <label for="end-date">end date</label>
                                
                                
                                <!--<div class="input-group">
                                  <span class="input-group-addon" id="clock2"><i class="fa fa-clock-o"></i></span>
                                  <input type="text" id="end-time" class="time end form-control" aria-describedby="clock2">
                                </div>-->

                                <div class="input-group">
                                  <span class="input-group-addon" id="calendar2"><i class="fa fa-calendar"></i></span>
                                  <input type="text" id="end-date" class="date end form-control" aria-describedby="calendar2">
                                </div>
                            </div> 
                        </div>
                        
                        <div id="_transition-form" hidden>
                            <div class="form-group">
                                <label for="condition">condition</label>
                                <input type="textarea" id="condition" value="" class="form-control">
                            </div>
                        </div>

                        <div id="_event-form" hidden></div>

                        <div id="_subnet-form" hidden></div>

                        <div id="_repository-form" hidden></div>
                    </div>

                    <input type="hidden" id="node-id" value="">
                    <input type="hidden" id="url-reference" value="<?= base_url() . 'application/views/'; ?>">
                    <button class="btn btn-edit pull-right" type="button" id="submitDescription">Ok</button>
                </form>
            </div>
        </div>
        
        <footer>
            <nav class="subnets">
                <ul>
                    <li><button type="button" class="btn-link" onclick="showSubnet(-1)">network</button></li>
                </ul>
            </nav>
        </footer>
        
    </section>
        
        
        <script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
            <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>javascript/nodes.js"></script>
        <script src="<?php echo base_url(); ?>javascript/arc.js"></script>
        <script src="<?php echo base_url(); ?>javascript/atid.js"></script> 

        <!-- DATE AND TIME PICKERS -->
        <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

        <script src="<?php echo base_url(); ?>javascript/datepair/datepair.js"></script>
        <script src="<?php echo base_url(); ?>javascript/datepair/jquery.datepair.js"></script>

        <script>
            // initialize input widgets first
            $('#prompt .date').datepicker({
                'format': "dd/mm/yyyy",
                'todayHighlight': true,
                'autoclose': true
            });

            // $('#prompt .time').timepicker({
            //     'showDuration': true,
            //     'timeFormat': 'H\\hi\\m',
            //     'step': 5
            // });

            // initialize datepair
            var form = document.getElementById('loadForm');
            var datepair = new Datepair(form);       
        </script>
    </body>
</html>
