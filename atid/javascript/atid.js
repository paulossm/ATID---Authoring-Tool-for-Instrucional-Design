
/* ~. GLOBALS .~ */

var svg = document.getElementById("boardSVG");
var subnet = document.getElementById("network");
var board = document.getElementById("board");

// SVG URI
var svgNS = "http://www.w3.org/2000/svg";

// mouse: window mouse position reference
var mouse = {};

var pt = svg.createSVGPoint();  // Created once for document

var trackMousePosition = function (screen, event) {
    pt.x = event.clientX;
    pt.y = event.clientY;
    var cursor = pt.matrixTransform(svg.getScreenCTM().inverse());
    return {
        x: cursor.x,
        y: cursor.y
    };
};

// graph: used while drawing a graph into the canvas. stores temporarily the image file 
var graph;
 
// currentTool: used when user picks up a tool for drawing in the canvas 
var currentTool = "cursor";

// currentElement: reference to element being interacted by the user
var currentElement;

// network: array storing nodes drawned in canvas
var network = {
    'title': "test",
    
    'begin': {
        'node': null,
        'date': new Date()
    },
    
    'end': {
        'node': null,
        'date': new Date()
    },

    'nodes': []
};

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

/* 
*  pickTool:
*  TRIGERRED WHEN USER SELECTS A TOOL IN THE TOOLBAR
*/
var pickTool = function () {
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

    if(currentTool == "arc")
        configArc();
}; 

var configArc = function() {
};

/* 
*  setCursorClass
*  DEFINES CUSTOM CURSOR BASED ON CURRENT TOOL SELECTED
*/
var setCursorClass = function(tool) {
    if (tool == "move")
        board.style.cursor = "move";
    else {
        if(currentTool != "arc")
            board.style.cursor = "url('" + tool + "') " + graph.width / 2 + " " + graph.height / 2 + ", auto";
        
        else 
            board.style.cursor = "url('" + tool + "'), auto";
    }
};

var drawNode = function(tool, cursor) {
    // Generate Node
    var node;
    if(tool != "arc" && tool != "cursor") {
        switch (tool) {
            case "activity":
                node = new Activity();
                break;
            case "repository":
                node = new Repository();
                break;
            case "event":
                node = new Event();
                break;
            case "transition":
                node = new Transition();
                break;
            case "subnet":
                node = new Subnet();
                // configSubnet(node);
                break;
        };
        node.id = network.nodes.length;
        node.x = cursor.x;
        node.y = cursor.y;

        // Generate visualization
        var group = document.createElementNS(svgNS, "g");
        group.setAttributeNS(null, "id", "node" + network.nodes.length);
        group.setAttribute("class", "draggable");

        var drawing = document.createElementNS(svgNS, "use");
        if(tool !== "arc" && tool !== "cursor") { 
            drawing.setAttributeNS(null, "x", cursor.x - 16);
            drawing.setAttributeNS(null, "y", cursor.y - 16);
        } else {
            drawing.setAttributeNS(null, "x", cursor.x);
            drawing.setAttributeNS(null, "y", cursor.y);
        }
        
        drawing.setAttributeNS(null, "href", "#" + tool);
        drawing.setAttribute("data-type", tool);
        drawing.setAttribute("data-reference", node.id);

//        group.addEventListener("click", interactGroup, false);
        drawing.addEventListener("click", interactElement, false);

        // Add to network object
        network.nodes.push(node)

        // Add to board
        group = subnet.appendChild(group);

        drawing = group.appendChild(drawing);

        currentElement = group;
        select(drawing);

    } else {
        node = new Arc();
        configArc(node, cursor);
    }
};

var interactElement = function(event) {
    if(currentTool == "arc") {
        var clicked_node = event.target | event.srcElement;
        console.log(clicked_node);
        clicked_node = network.nodes[clicked_node.dataset.reference];
        arcInteraction(clicked_node);
    } else {
        select();
    }
};

var arcInteraction = function(node) {
    if(node != undefined) {
        var id = node.id;
        if(arc == undefined) {
            arc = {
                'origin': node,
                'destiny': undefined
            }
            linking = true;
            drawTempArc(node, mouse);
            // startDrawing();    
        } else {
            arc.destiny = node;
            // deleteTempArc()
            // drawRealArc();
        }
    }
};

var select = function(element) {
    var node = currentElement.children[0];
    node.setAttributeNS(null, "href", "#" + element.dataset.type + "_hover");
    promptDescription(element);
};

var drawTempArc = function(origin, mouse) {
    if(document.getElementById("temp-arc") != undefined) {
        subnet.removeChild(document.getElementById("temp-arc"));
    }
    var path = document.createElementNS(svgNS, "path");
    var start_point = getRelativePosition(mouse, origin);
    
    path.setAttributeNS(null, "d", "M" + start_point.x + "," + start_point.y + " l" + mouse.x + "," + mouse.y);
    path.setAttributeNS(null, "marker-end", "url(#arc_arrow");
    path.setAttributeNS(null, "id", "temp-arc");
    
    subnet.appendChild(path);
};

var submitDescription = function() {
    var id = document.getElementById("node-id").value;
    var node = network.nodes[id];
    var title = document.getElementById("nodeTitle").value;
    if(title == undefined)
        title = "";
    node.title = title;

    switch (node.constructor) {
        case "activity":
            if($("#start-date").data().datepicker.viewDate != undefined)
                node.startDate = $("#start-date").data().datepicker.viewDate;
            if($("#start-time").data().uiTimepickerValue != undefined)
                node.startTime = $("#start-time").data().uiTimepickerValue; 
            if($("#end-date").data().datepicker.viewDate != undefined)
                node.startDate = $("#end-date").data().datepicker.viewDate;
            if($("#end-time").data().uiTimepickerValue != undefined)
                node.startTime = $("#end-time").data().uiTimepickerValue; 
            break;
        case "transition":
            node.condition = document.getElementById("condition");
            break;
        default:
            break;
    }

    appendDescription(node.id, title);

    $(board).removeClass("prompting");
    document.getElementById("descriptionInput").hidden = true;
};

var promptDescription = function(element) {
    var base_url = document.getElementById("url-reference").value;
    $("#loadForm").load(base_url + "_" + element.dataset.type + "-form.html", function() {
        document.getElementById("descriptionInput").hidden = false;
        document.getElementById("node-id").value = element.dataset.reference;    
    });
    $(board).addClass("prompting");
};

var appendDescription = function(id, title) {
    if(title != "") {
        var group = document.getElementById("node" + id);

        var text = document.createElementNS(svgNS, "text");
        text.setAttributeNS(null, "x", (group.children[0].getAttributeNS(null, "x")));
        text.setAttributeNS(null, "y", parseInt((group.children[0].getAttributeNS(null, "y")))+50);
        text.setAttributeNS(null, "fill", "#333");
        text.innerHTML = title;
        group.appendChild(text);    
    }
};

var configArc = function(tool, cursor) {

};

var pointMe = function (event) {
    if(currentTool != "arc")
        return;
    
    var element = event.target || event.srcElement;

    if(arc.origin === undefined) {
        arc.origin = network.nodes[network.indexOf(element.dataset.reference)];
        // to do: draw temp arc
    }
    else if (arc.destiny === undefined) {
        // to do: check if it is possible
        arc.destiny = network.nodes[network.indexOf(element.dataset.reference)];
        // to do: draw arc
    }
};

$(board).on({
    'mousemove': function (evt) {
        mouse = trackMousePosition(board, evt);
    },
    'click': function (evt) {
        if ($(board).hasClass("prompting") || $(board).hasClass("forbidden")) {
            return;
        }
        if(currentTool == "arc") {
            configArc();
        } else {
            drawNode(currentTool, mouse);    
        }
        

        /*if($(board).hasClass("forbidden"))
            return false;
        else if(currentTool != "cursor" && currentTool != "arc")
            drawNode(currentTool, mouse);*/
    }
});

var getRelativePosition = function(origin, destiny) {
    /* CALCULATES ARC EDGES BASED ON DEFINED ORIGIN AND DESTINY ELEMENTS */
    switch(destiny.constructor) {
        /* decides which calculations to do in order to get relative position based on type of node */
        case Transition:
            var distance = Math.sqrt(Math.pow((origin.x - destiny.x), 2) + Math.pow((origin.y - destiny.y), 2));
            var ratiox = (32/2 + 1) / distance,
                ratioy = (32/2 + 1) / distance;

            var differencex = (destiny.x - origin.x) * ratiox,
                differencey = (destiny.y - origin.y) * ratioy;

            var finalx = destiny.x - differencex,
                finaly = destiny.y - differencey;
            break;

        default:
            var radius = 16.75;
            distance = Math.sqrt(Math.pow((origin.x - destiny.x), 2) + Math.pow((origin.y - destiny.y), 2));
            var distanceEdges = distance - radius;
            var ratio = distanceEdges / distance;

            differencex = (destiny.x - origin.x) * ratio;
            differencey = (destiny.y - origin.y) * ratio;

            finalx = origin.x + differencex;
            finaly = origin.y + differencey;
            break;
    }
    return {
        x: finalx,
        y: finaly
    };
};

document.getElementById("submitDescription").addEventListener("click", submitDescription, false);