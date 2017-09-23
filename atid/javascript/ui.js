var clipboard = {};

var drawNode = function(tool, cursor, board) {
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
                var temp = currentNetwork;
                currentNetwork = node;
                newSubnet(temp.nodes.length);
                currentNetwork = temp;
                break;
            case "begin":
                node = new Begin();
                break;
            case "end":
                node = new End();
                break;
        };
        node.id = currentNetwork.nodes.length;
        node.x = cursor.x;
        node.y = cursor.y;

        // Generate visualization
        var group = document.createElementNS(svgNS, "g");
            group.setAttributeNS(null, "id", "node" + node.id);
            group.setAttribute("data-referenceId", node.id);
            group.setAttribute("class", "draggable");
            group.setAttribute("transform", "translate(" + (node.x - 16) + "," + (node.y - 16) + ")");

        var drawing = document.createElementNS(svgNS, "use");
            drawing.setAttributeNS(null, "x", 0);
            drawing.setAttributeNS(null, "y", 0);
            drawing.setAttributeNS(null, "href", "#" + tool);
            drawing.setAttribute("data-type", tool);
            drawing.setAttribute("data-reference", node.id);

            if(node.constructor == Subnet) {
                drawing.addEventListener("dblclick", function() {
                    console.log("double clicked!");
                    showSubnet(node.id);
                });
            }
            
            
            drawing.addEventListener("mousedown", function() {
                if(currentTool != "arc") {
                    startDrag(node.id);
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

            drawing.addEventListener("contextmenu", function(e) {
                e.preventDefault();
                toggleMenuOn();
              });
        
        
        
        drawing.addEventListener("click", function() {
            interactElement(node.id);
        });  
        
        if(tool == "begin" || tool == "end") {
            var text = document.createElementNS(svgNS, "text");
                text.setAttributeNS(null, "x", 16.25);
                text.setAttributeNS(null, "y", 50);
                text.setAttributeNS(null, "text-anchor", "middle");
                text.setAttributeNS(null, "fill", "#d8335b");
                text.innerHTML = node.title;
                group.appendChild(text);
        } else {
            currentElement = group;    
        }
        
        // Add to network object
        currentNetwork.nodes.push(node);
        
        // Add to board
        group = board.appendChild(group);
        drawing = group.appendChild(drawing);
        
        
        if(tool != "begin" && tool != "end") {
            select(node.id);
        }
            
    } else {
        node = new Arc();
        configArc(node, cursor);
    }
};

var interactElement = function(id) {
    if(currentTool == "arc") {
        var clicked_node = currentNetwork.nodes[id];
        arcInteraction(clicked_node);
    } else {
        if(currentNetwork.nodes[id].type != "begin" && currentNetwork.nodes[id].type != "end") {
            select(id);
        }
            
    }
};

var drag = {
    'node': '',
    'isDragging': false,
};

var startDrag = function(id) {
    drag.node = currentNetwork.nodes[id];
    drag.isDragging = true;
};

var dragging = function(event) {
    drag.node.x = mouse.x;
    drag.node.y = mouse.y;
    (document.querySelector("#" + subnet.id + " #node" + drag.node.id)).setAttribute("transform", "translate(" +(drag.node.x - 16)+","+(drag.node.y - 16)+")");
    updateArcsOnDrag(drag.node.id);
};

var dragEnd = function(event) {
    drag.node = undefined;
    drag.isDragging = false;
};

var updateArcsOnDrag = function(id) {
    var inputs = currentNetwork.nodes[id].arcs.input;
    if(inputs.length > 0) {
        for(var i = 0; i < inputs.length; i++) {
            var start_point = getRelativePosition(inputs[i].destiny, inputs[i].origin);
            var end_point = getRelativePosition(inputs[i].origin, inputs[i].destiny);
            var path = document.querySelector("#" + subnet.id + " #arc" + inputs[i].id);
                path.setAttributeNS(null, "d", "M" + start_point.x + "," + start_point.y + " L" + end_point.x + "," + end_point.y);
        }
    }

    var outputs = currentNetwork.nodes[id].arcs.output;
    if(outputs.length > 0) {
        for(var i = 0; i < outputs.length; i++) {
            var start_point = getRelativePosition(outputs[i].destiny, outputs[i].origin);
            var end_point = getRelativePosition(outputs[i].origin, outputs[i]. destiny);
            var path = document.querySelector("#" + subnet.id + " #arc" + outputs[i].id);
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

var configArc = function(tool, cursor) {

};

var drawArc = function() {
    var newArc = new Arc();
        newArc.id = currentNetwork.nodes.length;
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
            path.setAttribute("id", "arc" + currentNetwork.nodes.length);
    }

    // adiciona arco aos dois elementos
    newArc.origin.arcs.output.push(newArc);
    newArc.destiny.arcs.input.push(newArc);
    // adiciona arco a rede
    currentNetwork.nodes.push(newArc);
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

var copyNode = function (id) {
    var node = currentNetwork.nodes[id];
    var newObj = $.extend(true, {}, node);
    newObj.id = currentNetwork.nodes.length;
    newObj.arcs.input = newObj.arcs.output = [];
    clipboard = newObj;
    if(newObj.constructor == Subnet) {
        // Construct new Subnet
    }
};

var deleteNode = function(id) {
    // delete all output arcs
    
    // delete all input arcs

    // delete from network

    // delete from board
};

var select = function(id) {
    var node = currentNetwork.nodes[id];
    
    if(document.getElementById("node-id").value != "") {
        if (node.id === (document.querySelector(document.getElementById("node-id").value).id))
            return;
        else
            unselect(document.getElementById("node-id").value);    
    }
    

    // Make selected graphic blue
    var image = document.querySelector("#" + subnet.id + " #node" + id).children[0];
        image.setAttributeNS(null, "href", "#" + image.dataset.type + "_hover");

    // Show data modal
    promptDescription(id, image.dataset.type);
};

var unselect = function(query) {
    console.log(query);
    var image = document.querySelector(query).children[0];
        image.setAttributeNS(null, "href", "#" + image.dataset.type);
    currentElement = undefined;
};

var promptDescription = function(id, type) {
    var base_url = document.getElementById("url-reference").value;
    var node = currentNetwork.nodes[id];
    
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

    document.getElementById("node-id").value = "#" + subnet.id + " > #node" + node.id;
    document.getElementById("descriptionInput").hidden = false;
    $(board).addClass("prompting");
};

var submitDescription = function() {
    var id = document.querySelector((document.getElementById("node-id").value)).getAttribute("data-referenceId");
    var node = currentNetwork.nodes[id];
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
        case Subnet:
            document.getElementById("subnetLink" + node.id).innerHTML = node.title;
            break;
        default:
            break;
    }

    appendDescription(node.id, title);

    document.getElementById("prompt").reset();
    
    document.getElementById("descriptionInput").hidden = true;
    unselect("#" + subnet.id + " #node" + node.id);
    $(board).removeClass("prompting");
    
};

var appendDescription = function(id, title) {
    if(title != "") {
        var group = document.querySelector("#" + subnet.id + " #node" + id);
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

