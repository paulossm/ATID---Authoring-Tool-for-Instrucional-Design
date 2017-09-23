var Node = function() {
	this.id = "";
	this.x = "";
	this.y = "";
	this.arcs = {
		"input": [],
		"output": []
	}
};

Node.prototype.getId = function() { return this.id; };
Node.prototype.getCoords = function() { return {'x': this.x, 'y': this.y }; };
Node.prototype.setId = function(id) { this.id = id; };

var Activity = function () {
	Node.call(this);

	this.title = "";
	this.startDate = undefined;
	this.endDate = undefined;
	this.type = "activity";
};

// Node Inheritance
Activity.prototype = new Node();
// corrects constructor pointer, that points to Node
Activity.prototype.constructor = Activity;

var Repository = function () {
	Node.call(this);

	this.title = "";
    this.type = "repository";
};
Repository.prototype = new Node();
Repository.prototype.constructor = Repository;


var Event = function() {
	Node.call(this);

	this.title = "";
    this.type = "event";
};
Event.prototype = new Node();
Event.prototype.constructor = Event;

var Transition = function() {
	this.title = "";
	this.conditions = [];
	this.type = "transition";
};
Transition.prototype = new Node();
Transition.prototype.constructor = Transition;

var Subnet = function() {
	Node.call(this);

	this.title = '';
    this.nodes = [];
    this.type = "subnet";
};

Subnet.prototype = new Node();
Subnet.prototype.constructor = Subnet;

var Begin = function() {
    Node.call(this);
    
    this.title = "Begin";
    this.type = "begin";
};
Begin.prototype = new Node();
Begin.prototype.constructor = Begin;

var End = function() {
    Node.call(this);
    
    this.title = "End";
    this.type = "end";
};
End.prototype = new Node();
End.prototype.constructor = End;

var Network = function() {
	this.title = '';
	this.nodes = [];
};