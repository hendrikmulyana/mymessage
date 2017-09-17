/**
 * Created by EBOD on 7/29/2017.
 */
var __global_node_now			= 'null';
var __global_node 				= false;
var __global_line 				= false;
var __global_destination		= false;
var __global_destination_now	= 'null';
var __global_load_json			= false;
var __global_load_route			= false;
var __global_arr_node			= new Array();
var __global_first_line			= 0;

function add_node(){

    var active_x = document.getElementById('add_nodex');
    var active_y = document.getElementById('add_linex').innerHTML = 'Add Line';
    var active_z = document.getElementById('add_destinationx').innerHTML = 'Add Place';

    __global_line		 	= false;
    __global_destination 	= false;

    if(__global_node == false){
        __global_node	= true;
        active_x.innerHTML = 'Add Node [x]';

    }else{
        __global_node 	= false;
        active_x.innerHTML = 'Add Node';

    }
}

function add_line(){

    var active_x = document.getElementById('add_nodex').innerHTML = 'Add Node';
    var active_y = document.getElementById('add_linex');
    var active_z = document.getElementById('add_destinationx').innerHTML = 'Add Place';

    __global_node 			= false;
    __global_destination	= false;

    if(__global_line == false){
        __global_line	= true;
        active_y.innerHTML = 'Add Line [x]';

    }else{
        __global_line 	= false;
        active_y.innerHTML = 'Add Line';

    }
}

function add_destination(){
    var active_x = document.getElementById('add_nodex').innerHTML = 'Add Node';
    var active_y = document.getElementById('add_linex').innerHTML = 'Add Line';
    var active_z = document.getElementById('add_destinationx');

    __global_node 	= false;
    __global_line 	= false;

    if(__global_destination == false){
        __global_destination	= true;
        active_z.innerHTML = 'Add Place [x]';

    }else{
        __global_destination 	= false;
        active_z.innerHTML = 'Add Place';

    }
}
