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
}; 

/* 
*  setCursorClass
*  DEFINES CUSTOM CURSOR BASED ON CURRENT TOOL SELECTED
*/
var setCursorClass = function(tool) {
    canvas.style.cursor = "url('" + tool + "'), auto";
    /*
    var classes = canvas.classList;
    var toolClass = "tool-" + tool;
    for(var i = 0; i < classes.length; i++) {
        if(classes[i].startsWith("tool-")) {
            canvas.classList.remove( canvas.classList.item(i) );
            canvas.classList.add( toolClass );
        }
    } 
    */
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
      draggable: true,
      data : {
        element: currentTool,
        arc: {
            input: '',
            output: '',
        }
      }
    })
    .drawLayers();
    network.push($(canvas).getLayer("element" + network.length+1));
};

// PREPARE CANVAS FOR DRAWING [IMPORTANT]
$('canvas#drawScreen').on({
    "mousemove": function (evt) {
        mouse = getMousePos(canvas, evt);
    },
    
    "click": function(evt) {
        if(currentTool == "cursor") {
            return;
        }
        drawImage(graph.src, mouse.x + (graph.width / 2), mouse.y + (graph.height / 2), graph.width, graph.height);
    }
});  