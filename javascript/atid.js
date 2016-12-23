'use strict';

/* ~. GLOBALS .~ */
// canvas: html canvas reference
var canvas = document.getElementById("drawScreen");
    canvas.width = window.innerWidth - (window.innerWidth * 0.2);
    canvas.height = 500;

if(canvas.getContext)
    var canvasCtx = canvas.getContext('2d');

// mouse: window mouse position reference
var mouse = {};

// graph: used while drawing a graph into the canvas. stores temporary the image file 
var graph;
 
// currentTool: used when user picks up a tool for drawing in the canvas 
var currentTool;

var network = new Array();

/* 
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
    // DEFINES CUSTOM CURSOR BASED ON CURRENT TOOL SELECTED
    setCursorClass(toolImg.src);
}; 

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

var getMousePos = function (canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
        y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
    };
};


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

$('#drawTools input[name="tool"]').each( function ( index, value ) {
    $(value).on("change", pickTool);
});

$('canvas#drawScreen').on({
    "mousemove": function (evt) {
        mouse = getMousePos(canvas, evt);
    },
    
    "click": function(evt) { 
        drawImage(graph.src, mouse.x, mouse.y, graph.width, graph.height);
    }
});  