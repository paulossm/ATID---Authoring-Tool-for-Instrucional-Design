var network {
    title: "",
    created_by: "",
    created_in: new Date(),
    modified: new Date(),
    sharing: [],
 
    subnets: [
        {
            id: 0,
            begin: new Begin(),
            end: new End(),
            nodes: [new Subnet(), new Node()],
        },
        {
            id: 1,
            begin: new Begin(),
            end: new End(),
            nodes: [new Node(), new Node()],
        },
        // ...
    ]
};