'use strict';

/* ~. GLOBALS .~ */
// canvas: html canvas reference
var canvas = document.getElementById("drawScreen");
    canvas.width = window.innerWidth * 0.88;
    //canvas.width = window.innerWidth - (window.innerWidth * 0.1);
    canvas.height = 500;

if(canvas.getContext)
    var canvasCtx = canvas.getContext('2d');

// mouse: window mouse position reference
var mouse = {};

// graph: used while drawing a graph into the canvas. stores temporary the image file 
var graph;
 
// currentTool: used when user picks up a tool for drawing in the canvas 
var currentTool;

// array storing nodes drawned in canvas
var network = new Array();

// arcMap: array of arcs already drawed
var arcMap = new Array();

/*
 *   arc:
 *   used when user is drawing a new arc between two tools.
 *   dinamically updated when user select origin and destiny for the arc
 */
var arc = {
    'enable': false,
    'layers': {
        'origin': '',
        'destiny': ''
    }
};

/* 
*  pickTool
*  TRIGERRED WHEN USER SELECTS A TOOL IN THE TOOLBAR
*/
var pickTool = function () {
    currentTool = document.querySelector("[name=tool]:checked").value;

    // GET VALUE FROM TOOL SELECTED BY USER
    var toolImg = document.querySelector("[name=tool]:checked + img");

    // CREATE NEW IMAGE ELEMENT FROM TOOL SELECTED
    graph = new Image();
    graph.width = 36;
    graph.height = 36;
    graph.src = toolImg.src;
    // set mouse cursor
    setCursorClass(toolImg.src);

    if(currentTool == "arc")
        configArc();
}; 

/* 
*  setCursorClass
*  DEFINES CUSTOM CURSOR BASED ON CURRENT TOOL SELECTED
*/
var setCursorClass = function(tool) {
    canvas.style.cursor = "url('" + tool + "'), auto";
};

/* 
*  getMousePos
*  Map mouse position in order to place drawing correctly
*/
var getMousePos = function (canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
        y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
    };
};

/* 
*  drawImage
*  Draw image on canvas
*/
var drawImage = function (source, posX, posY, width, height) {
    $(canvas).addLayer({
      name: "element" + network.length + 1,
      type: 'image',
      source: source,
      x: posX, y: posY,
      width: width, height: height,
      draggable: false,
      data : {
        element: currentTool,
        arc: {
            input: '',
            output: ''
        }
      },
        mousedown: function(layer) {

            if(currentTool == "arc" && arc.enable) {
                if(arc.origin == '') {
                    arc.origin = layer;
                    arcMap.push({
                        name: layer.name,
                        element: layer.data.element,
                        x: layer.x,
                        y: layer.y,
                    });
                }
                else {
                    if(arc.destiny == '') {
                        if(layer.data.element == arc.origin.data.element) {
                            alert("Can't create arc between same tools!");
                            arc.origin = '';
                            arc.destiny = '';
                            return;
                        }

                        else {
                            arc.destiny = layer;
                            arcMap.push({
                                name: layer.name,
                                element: layer.data.element,
                                x: layer.x,
                                y: layer.y,
                            });
                            drawArc(arc);
                        }
                    }
                }
            }
        }
    })
    .drawLayers();
    network.push($(canvas).getLayer("element" + network.length+1));
};

var configArc = function () {
    arc.enable = true;
};

var drawArc = function () {
    $('canvas#drawScreen').drawLine({
        layer: true,
        name: 'arc' + (Math.floor(arcMap.length / 2) + 1),
        strokeStyle: '#000',
        strokeWidth: 2,
        rounded: true,
        draggable: false,
        startArrow: false,
        endArrow: true,
        arrowRadius: 15,
        arrowAngle: 45,
        x1: arc.layers.origin.x, y1: arc.layers.origin.y,
        x2: arc.layers.destiny.x, y2: arc.layers.destiny.y
    });
};

var toggleDrawing = function () {
    $("canvas#drawScreen").getLayers().draggable = !($("canvas#drawScreen").getLayers().draggable);
};

// PREPARE CANVAS FOR DRAWING [IMPORTANT]
$('canvas#drawScreen').on({
    "mousemove": function (evt) {
        mouse = getMousePos(canvas, evt);
    },
    
    "click": function(evt) {
        if(currentTool == "cursor") {
            toggleDrawing();
            return;
        }
        else {
            toggleDrawing();
            if(currentTool == "arc") {
                return;
            }
            drawImage(graph.src, mouse.x + (graph.width / 2), mouse.y + (graph.height / 2), graph.width, graph.height);
        }
    }
});  