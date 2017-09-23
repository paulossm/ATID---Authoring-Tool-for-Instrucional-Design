/* ~. GLOBALS .~ */
var svg = document.getElementById("boardSVG");
var subnet = document.getElementById("subnet-1");
var board = document.getElementById("board");

// SVG URI
var svgNS = "http://www.w3.org/2000/svg";

var pt = svg.createSVGPoint();  // Created once for document

// graph: used while drawing a graph into the canvas. stores temporarily the image file 
var graph;
 
// currentTool: used when user picks up a tool for drawing in the canvas 
var currentTool = "cursor";

// currentElement: reference to element being interacted by the user
var currentElement;

// network: array storing nodes drawned in canvas
var network = new Subnet();
var currentNetwork = network;

/*
 *   arc:
 *   used when user is drawing a new arc between two tools.
 *   dinamically updated when user selects origin and destiny for the arc
 */
var arc = undefined;
var linking = false;

/*
 *  allowAction: defines if an action is allowed over the drawing screen
 */
var allowAction = true;


var menu = document.querySelector("#context-menu");
var menuState = 0;
var active = "context-menu--active";

// mouse: window mouse position reference
var mouse = {};
var trackMousePosition = function (screen, event) {
    pt.x = event.clientX;
    pt.y = event.clientY;
    var cursor = pt.matrixTransform(svg.getScreenCTM().inverse());
    return {
        x: cursor.x,
        y: cursor.y
    };
};

/* 
*  pickTool:
*  TRIGERRED WHEN USER SELECTS A TOOL IN THE TOOLBAR
*/
var pickTool = function () {
    if(linking) {
        subnet.removeChild(document.getElementById("temp-arc"));
        arc = undefined;
        linking = false;
    }
    currentTool = document.querySelector("[name=tool]:checked").value;
    
    $(".currentTool").removeClass("currentTool") 
    
    $("[name=tool]:checked").parent().addClass("currentTool");
    
    // GET VALUE FROM TOOL SELECTED BY USER
    var toolImg = document.querySelector("[name=tool]:checked + img");

    // CREATE NEW IMAGE ELEMENT FROM TOOL SELECTED
    graph = new Image();
    if(currentTool == "transition") {
        graph.width = 19;
        graph.height = 32;
    } else {
        graph.width = 32;
        graph.height = 32;
    }
    graph.src = toolImg.src;
    
    // set mouse cursor
    setCursorClass(toolImg.src, graph.width, graph.height);
        
}; 

/* 
*  setCursorClass
*  DEFINES CUSTOM CURSOR BASED ON CURRENT TOOL SELECTED
*/
var setCursorClass = function(tool) {
    if (tool == "move" && currentTool != "arc")
        board.style.cursor = "move";
    else {
        if(currentTool != "arc")
            board.style.cursor = "url('" + tool + "') " + graph.width / 2 + " " + graph.height / 2 + ", auto";
        
        else {
            $("#drawingArea").addClass("arc");
            board.style.cursor = "url('" + tool + "'), auto";
        }
    }
};

var prepareEnvironment = function(currentBoard) {
    drawNode("begin", {x: 30, y: ($(svg).height() / 2)}, currentBoard.parentNode);
    drawNode("end", {x: $(svg).width() - 30, y: ($(svg).height() / 2)}, currentBoard.parentNode);
    
    $(currentBoard).on({
        'mousemove': function (evt) {
            mouse = trackMousePosition(currentBoard, evt);
            if(linking == true) {
                drawTempArc(arc.origin, mouse);
            }
            if(drag.isDragging) {
                dragging();
            }
        },
        'mouseup': function(evt) {
            if(drag.isDragging) {
                dragEnd();
            }
        },
        'mouseout': function(evt) {
            if(drag.isDragging) {
                dragEnd();
            }
        },
        'click': function (evt) {
            if ($(currentBoard).hasClass("prompting") || $(currentBoard).hasClass("forbidden")) {
                return;
            }
            if(currentTool != "arc") {
                drawNode(currentTool, mouse, subnet);    
            }
        }
    });
};

/** 
*   Defines if two elements are linkable
*/
var isLinkable = function (origin, destiny) {
    switch(origin.constructor) {
        case Activity:
            if(destiny.constructor != Transition)
                return false;
            break;
        case Transition:
            if(destiny.constructor != Activity && destiny.constructor != Subnet && destiny.constructor != End)
                return false;
            break;
        case Subnet:
            if(destiny.constructor != Transition)
                return false;
            break;
        case Event:
            if(destiny.constructor != Transition)
                return false;
            break;
        case Repository:
            if(destiny.constructor != Activity)
                return false;
            break;
        case Begin:
            if(destiny.constructor != Transition)
                return false;
            break;
        case End:
            return false;
            break;
    }
    return true;
};

