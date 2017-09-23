var newSubnet = function(id) { 

    var group = document.createElementNS(svgNS, "g");
        group.setAttributeNS(null, "id", "subnet" + id);        
        group.setAttribute("class", "subnet");

    var subnetBoard = document.createElementNS(svgNS, "use");
        subnetBoard.setAttributeNS(null, "x", 0);
        subnetBoard.setAttributeNS(null, "y", 0);
        subnetBoard.setAttributeNS(null, "href", "#drawBoard");
        subnetBoard.setAttributeNS(null, "fill", "#FFF");

    var subnetList = document.querySelector(".subnets > ul");
    var subnetListItem = document.createElement("LI");
    var subnetListLink = document.createElement("BUTTON");
    subnetListLink.setAttribute("type", "button");
    subnetListLink.setAttribute("class", "btn-link");
    subnetListLink.setAttribute("id", "subnetLink" + id);
    subnetListLink.addEventListener("click", function() {
        showSubnet(id);
    });
    subnetListLink.innerHTML = "Subnet " + (id + 1);

    subnetListLink = subnetListItem.appendChild(subnetListLink);
    subnetListItem = subnetList.appendChild(subnetListItem);
    
    group = svg.appendChild(group);
    subnetBoard = group.appendChild(subnetBoard);
    
    prepareEnvironment(subnetBoard);
};

var showSubnet = function(id) {
    if (id == -1) {
        var toShow = document.getElementById("subnet-1");
        currentNetwork = network;
    } else {
        var toShow = document.getElementById("subnet" + id);
        currentNetwork = currentNetwork.nodes[id];

    }
    $(subnet).hide();
    subnet = toShow;
    board = toShow.children[0];
    $(subnet).show();
    document.querySelector(".subnet-active").classList.remove("subnet-active");
    document.getElementById("subnet" + id).classList.add("subnet-active");
};

var saveNetwork = function() {
    var dataarray = [];
    var stringData = '{"network":[ ';
    for(var i = 0; i < network.nodes.length; i++) {
        if(network.nodes[i].constructor !== Arc) {
            if(network.nodes[i].constructor == Subnet) {
                for(var j = 0; j < network.nodes[i].nodes.length; j++) {
                    if(network.nodes[i].nodes[j].constructor !== Arc)
                        network.nodes[i].nodes[j].arcs = null;
                }
            }
            network.nodes[i].arcs = null;
        }
        dataarray.push(JSON.stringify(network.nodes[i]));
    }
    stringData += dataarray.join();
    stringData += "]} ";

    $.ajax({
        type: 'POST',
        url:  (document.getElementById("base-url").value + "index.php/Draw/salvarRede"),
        data: {"rede": stringData},
        cache: false,
        success: function(data){
            //alert(data);
            window.location = 'http://localhost/ATID---Authoring-Tool-for-Instrucional-Design/atid/index.php/Dashboard';
        }
    });
};