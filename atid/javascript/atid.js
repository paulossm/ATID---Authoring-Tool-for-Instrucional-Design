
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
            group.setAttributeNS(null, "id", "node" + node.id);
            group.setAttribute("class", "draggable");
            group.setAttribute("transform", "translate(" + (node.x - 16) + "," + (node.y - 16) + ")");

        var drawing = document.createElementNS(svgNS, "use");
            drawing.setAttributeNS(null, "x", 0);
            drawing.setAttributeNS(null, "y", 0);
            drawing.setAttributeNS(null, "href", "#" + tool);
            drawing.setAttribute("data-type", tool);
            drawing.setAttribute("data-reference", node.id);

            drawing.addEventListener("click", function() {
                interactElement(node.id);
            });
            drawing.addEventListener("mousedown", function() {
                if(currentTool != "arc") {
                    startDrag(node.id);
                    select(node.id);
                }
            });
            drawing.addEventListener("mousemove", function(event) {
                mouse = trackMousePosition(board, event);
                if(drag.isDragging) {
                    dragging();
                }
            });
            drawing.addEventListener("mouseup", function() {
                if(drag.isDragging) {
                    dragEnd();
                }
            });
            

        // Add to network object
        network.nodes.push(node)

        // Add to board
        group = subnet.appendChild(group);

        drawing = group.appendChild(drawing);

        currentElement = group;
        select(node.id);

    } else {
        node = new Arc();
        configArc(node, cursor);
    }
};

var interactElement = function(id) {
    if(currentTool == "arc") {
        var clicked_node = network.nodes[id];
        arcInteraction(clicked_node);
    } else {
        select(id);
    }
};

var drag = {
    'node': '',
    'isDragging': false,
};
var startDrag = function(id) {
    drag.node = network.nodes[id];
    drag.isDragging = true;
};

var dragging = function(event) {
    console.log("NODE: x" + drag.node.x + ", y: " + drag.node.y);
    console.log("MOUSE: x" + mouse.x + ", y: " + mouse.y);
    drag.node.x = mouse.x;
    drag.node.y = mouse.y;
    (document.getElementById("node" + drag.node.id)).setAttribute("transform", "translate(" +(drag.node.x - 16)+","+(drag.node.y - 16)+")");
    console.log("NODE: x" + drag.node.x + ", y: " + drag.node.y);
    console.log("MOUSE: x" + mouse.x + ", y: " + mouse.y);
    updateArcsOnDrag(drag.node.id);
};

var dragEnd = function(event) {
    drag.node = undefined;
    drag.isDragging = false;
};

var updateArcsOnDrag = function(id) {
    var inputs = network.nodes[id].arcs.input;
    if(inputs.length > 0) {
        for(var i = 0; i < inputs.length; i++) {
            var start_point = getRelativePosition(inputs[i].destiny, inputs[i].origin);
            var end_point = getRelativePosition(inputs[i].origin, inputs[i].destiny);
            var path = document.getElementById("arc" + inputs[i].id);
                path.setAttributeNS(null, "d", "M" + start_point.x + "," + start_point.y + " L" + end_point.x + "," + end_point.y);
        }
    }

    var outputs = network.nodes[id].arcs.output;
    if(outputs.length > 0) {
        for(var i = 0; i < outputs.length; i++) {
            var start_point = getRelativePosition(outputs[i].destiny, outputs[i].origin);
            var end_point = getRelativePosition(outputs[i].origin, outputs[i]. destiny);
            var path = document.getElementById("arc" + outputs[i].id);
                path.setAttributeNS(null, "d", "M" + start_point.x + "," + start_point.y + " L" + end_point.x + "," + end_point.y);
        }
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
            if(isLinkable(arc.origin, node)) {
                arc.destiny = node;
                subnet.removeChild(document.getElementById("temp-arc"));
                drawArc();
            } else {
                alert("wrong elements chosen.");
                subnet.removeChild(document.getElementById("temp-arc"));
                arc = undefined;
                $("#drawingArea").removeClass("arc");
            }
            linking = false;
        }
    }
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
            if(destiny.constructor != Activity && destiny.constructor != Subnet)
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
    }
    return true;
};

var select = function(id) {
    var node = network.nodes[id];
    
    if(document.getElementById("node-id").value != "") {
        if (node.id === document.getElementById("node-id").value)
            return;
        else 
            unselect(document.getElementById("node-id").value);    
    }
    

    // Make selected graphic blue
    var image = document.getElementById("node" + id).children[0];
        image.setAttributeNS(null, "href", "#" + image.dataset.type + "_hover");

    // Show data modal
    promptDescription(id, image.dataset.type);
};

var unselect = function(id) {
    var image = document.getElementById("node" + id).children[0];
        image.setAttributeNS(null, "href", "#" + image.dataset.type);
    currentElement = undefined;
};

var promptDescription = function(id, type) {
    var base_url = document.getElementById("url-reference").value;
    var node = network.nodes[id];
    
    document.getElementById("prompt").reset();
    document.getElementById("_" + type + "-form").hidden = false;

    
    switch (type)  {
        case "activity":
            if(node.title)
                $("#nodeTitle").val(node.title);
            if(node.startDate)
                $("#start-date").datepicker("update", node.startDate);
            // if(node.startTime)
            //     $("#start-time").timepicker("setTime", node.startTime);
            // if(node.endTime)
            //     $("#end-time").timepicker("setTime", node.endTime);
            if(node.endDate)
                $("#end-date").datepicker("update", node.endDate);
            break;

        case "transition":
            if(node.title)
                $("#nodeTitle").val(node.title);
            if(node.condition)
                $("#condition").val(node.condition);
            break;

        default:
            if(node.title)
                $("#nodeTitle").val(node.title);
            break;
    } 

    document.getElementById("node-id").value = node.id;
    document.getElementById("descriptionInput").hidden = false;
    $(board).addClass("prompting");
};

var submitDescription = function() {
    var id = document.getElementById("node-id").value;
    var node = network.nodes[id];
    var title = document.getElementById("nodeTitle").value;
    if(title == undefined)
        title = "";
    node.title = title;

    switch (node.constructor) {
        case Activity:
            if($("#start-date").datepicker)
                node.startDate = $("#start-date").datepicker('getDate');
            // if($("#start-time").timepicker)
            //     node.startTime = $("#start-time").timepicker("getTime"); 
            if($("#end-date").datepicker)
                node.endDate = $("#end-date").datepicker('getDate');
            // if($("#end-time").timepicker)
            //     node.endTime = $("#end-time").timepicker("getTime"); 

            document.getElementById("_activity-form").hidden = true;
            break;
        case Transition:
            node.condition = document.getElementById("condition");
            document.getElementById("_transition-form").hidden = true;
            break;
        default:
            break;
    }

    appendDescription(node.id, title);

    document.getElementById("prompt").reset();
    
    document.getElementById("descriptionInput").hidden = true;
    unselect(node.id);
    $(board).removeClass("prompting");
    
};

var appendDescription = function(id, title) {
    if(title != "") {
        var group = document.getElementById("node" + id);
        if(group.children[1] != undefined) {
            var text = group.children[1];
            text.innerHTML = title;
        } else {
            var text = document.createElementNS(svgNS, "text");
            text.setAttributeNS(null, "x", 16.25);
            text.setAttributeNS(null, "y", 50);
            text.setAttributeNS(null, "text-anchor", "middle");
            text.setAttributeNS(null, "fill", "#333");
            text.innerHTML = title;
            group.appendChild(text);        
        }
    }
};

var configArc = function(tool, cursor) {

};

var drawArc = function() {
    var newArc = new Arc();
        newArc.id = network.nodes.length;
        newArc.origin = arc.origin;
        newArc.destiny = arc.destiny;

    if(arc.origin != undefined && arc.destiny != undefined) {
        var start_point = getRelativePosition(arc.destiny, arc.origin);
        var end_point = getRelativePosition(arc.origin, arc.destiny);

        var path = document.createElementNS(svgNS, "path");
            path.setAttributeNS(null, "d", "M" + start_point.x + "," + start_point.y + " L" + end_point.x + "," + end_point.y);
            path.setAttributeNS(null, "marker-end", "url(#arc_arrow)");
            path.setAttributeNS(null, "stroke-width", 2);
            path.setAttributeNS(null, "stroke", "#333");
            path.setAttribute("id", "arc" + network.nodes.length);
    }

    // adiciona arco aos dois elementos
    newArc.origin.arcs.output.push(newArc);
    newArc.destiny.arcs.input.push(newArc);
    // adiciona arco a rede
    network.nodes.push(newArc);
    subnet.appendChild(path);

    // TODO: atrelar arco ao movimento dos nós

    // limpa variavel arc
    arc = undefined;
};

var drawTempArc = function(origin, mouse) {
    if(document.getElementById("temp-arc") != undefined) {
        subnet.removeChild(document.getElementById("temp-arc"));
    }
    
    var path = document.createElementNS(svgNS, "path");
    var start_point = getRelativePosition(mouse, origin);
    
    path.setAttributeNS(null, "d", "M " + start_point.x + "," + start_point.y + " L" + mouse.x + "," + mouse.y);
    path.setAttributeNS(null, "marker-end", "url(#arc_arrow)");
    path.setAttributeNS(null, "stroke-width", 2);
    path.setAttributeNS(null, "stroke", "#333");
    path.setAttributeNS(null, "id", "temp-arc");
    
    subnet.appendChild(path);
};

var getRelativePosition = function(origin, destiny) {
    /* CALCULATES ARC EDGES BASED ON DEFINED ORIGIN AND DESTINY ELEMENTS */
    switch(destiny.constructor) {
        /* decides which calculations to do in order to get relative position based on type of node */
        case Transition:
            var distance = Math.sqrt(Math.pow((origin.x - destiny.x), 2) + Math.pow((origin.y - destiny.y), 2));
            var ratiox = (19/2 + 1) / distance,
                ratioy = (32/2 + 1) / distance;

            var differencex = (destiny.x - origin.x) * ratiox,
                differencey = (destiny.y - origin.y) * ratioy;

            var finalx = destiny.x - differencex,
                finaly = destiny.y - differencey;
            break;

        default:
            var radius = 16;
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

var deleteNode = function(id) {
    // delete all output arcs
    
    // delete all input arcs

    // delete from network

    // delete from board
};

$(board).on({
    'mousemove': function (evt) {
        mouse = trackMousePosition(board, evt);
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
    'click': function (evt) {
        if ($(board).hasClass("prompting") || $(board).hasClass("forbidden")) {
            return;
        }
        if(currentTool != "arc") {
            drawNode(currentTool, mouse);    
        }
    }
});

document.getElementById("submitDescription").addEventListener("click", submitDescription, false);