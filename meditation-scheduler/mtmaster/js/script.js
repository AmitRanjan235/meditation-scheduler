const is_valid_name = (name) => {
	if (/^[a-z?A-Z?0-9?.?\-?,?_?\s?]+$/.test(name)) {
		return true;
	}
	return false;
}

const is_valid_date = (date) => {
	if (/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/.test(date)) {
		return true;
	}
	return false;
}

const is_valid_time = (time) => {
	if (/\d+ (Min|Mins|Hour|Hours)/.test(time)) {
		return true;
	}
	return false;
}

const toggle_modal = (head, body) => {
	$('#modal_head_text').text(head);
	$('#modal_body_text').text(body);
	$('#info_modal').modal();
}

const set_default_date = () => {
	let date = new Date(new Date().toLocaleString("en-US", {timeZone: "Asia/Kolkata"}));

	year = date.getFullYear();
	month = date.getMonth()+1;
	month = ('0' + month).slice(-2);
	day = ('0' + date.getDate()).slice(-2);

	full_date = year+"-"+month+"-"+day;

	$('#date').attr('value', full_date);
}

const fetch_dropdown_data = () => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "drop"
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {

	    	html = '<option value="0">-- Select --</option>';

	    	for (var i = 0; i < data.length; i++) {
	    		html += '<option value="' + data[i]['time_value'] + '">' + data[i]['time_value'] + '</option>';
	    	}
	    	$('#mtime').html(html);
	    }
	  }
	});
}

const add_data = (name, date, time) => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "save",
	    "name": name,
	    "date": date,
	    "time": time
	  },
	  error: function(e) {
	  	console.log("Error : " + e);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {
	    	toggle_modal("Success", data['msg']);
	    	$('#name').val("");
	    	$('#mtime').prop('selectedIndex',0);
	    	set_default_date();
	    	fetch_data();
	    }
	  }
	});
}

const toggle_it = (id) => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "toggle",
	    "id": id,
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {
	    	fetch_data();
	    }
	  }
	});
}

const delete_data = (id) => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "delete",
	    "id": id,
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {
	    	toggle_modal("Success", data['msg']);
	    	fetch_data();
	    }
	  }
	});
}

const generate_edit_dropdown = (val) => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "drop"
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {

	    	html = '<option value="0">-- Select --</option>';

	    	for (var i = 0; i < data.length; i++) {
	    		if (data[i]['time_value'] === val) {
	    			html += '<option value="' + data[i]['time_value'] + '" selected>' + data[i]['time_value'] + '</option>';
	    		} else {
		    		html += '<option value="' + data[i]['time_value'] + '">' + data[i]['time_value'] + '</option>';
		    	}
	    	}
	    	$('#mtime_edit').html(html);
	    	$('#edit_modal').modal();
	    }
	  }
	});
}

const edit_it = (id) => {

	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "edit",
	    "id": id
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {
	    	$('#name_edit').val(data[0]['name']);
	    	$('#date_edit').val(data[0]['date']);
	    	$('#update_btn').attr('onclick', 'update_it("' + data[0]['id'] + '");');

	    	generate_edit_dropdown(data[0]['time']);
	    }
	  }
	});
}


const update_it = (id) => {

	let name = $('#name_edit').val();

	let date = $('#date_edit').val();

	let time = $('#mtime_edit').val();

	$('#edit_modal').modal('hide');

	if(!is_valid_name(name)){
		toggle_modal("Error", "Invalid Name!");
		return;
	}

	if(!is_valid_date(date)){
		toggle_modal("Error", "Invalid Date Selection!");
		return;
	}

	if(!is_valid_time(time)){
		toggle_modal("Error", "Invalid Time Selection!");
		return;
	}


	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "update",
	  	"id": id,
	    "name": name,
	    "date": date,
	    "time": time
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {
	    	toggle_modal("Success", data['msg']);
	    	fetch_data();
	    }
	  }
	});

}

const delete_it = (id) => {
	$('#confirm_delete_btn').attr('del-id', id);

	$('#delete_modal').modal('show');
}

const delete_from_modal = () => {
	$('#delete_modal').modal('hide');
	let id = $('#confirm_delete_btn').attr('del-id');
	delete_data(id);
}

const fetch_data = () => {
	$.ajax({
	  url: './backend/request-handler.php',
	  type: 'POST',
	  data: {
	  	"action": "fetch"
	  },
	  error: function(e) {
	  	console.log("Error : " + e.responseText);
	    toggle_modal("Error", "Oops! Something went wrong!");
	  },
	  dataType: 'json',
	  success: function(data) {
	    if (data['code'] === "0") {
	    	toggle_modal("Error", data['msg']);
	    } else {

	    	html = '';

	    	if (data.length == 0) {
		    	html += '<tr><td colspan="4">No Records Found!</td></tr>';
	    	} else {

		    	for (var i = 0; i < data.length; i++) {

		    		if (data[i]['is_completed'] == "1") {
	    				t_class = 'table-active';
	    				name = '<s>'+data[i]['name']+'</s>';
	    				date = '<s>'+data[i]['date']+'</s>';
	    				time = '<s>'+data[i]['time']+'</s>';
	    				icon = 'fa-eye-slash';
	    				iconText = 'Un-Done';
	    			} else {
	    				t_class = '';
	    				name = data[i]['name'];
	    				date = data[i]['date'];
	    				time = data[i]['time'];
	    				icon = 'fa-eye';
	    				iconText = 'Done';
	    			}


		    		
		    		html += '<tr class="'+t_class+'"><th scope="row">'+(i+1)+'</th><td>'+name+'</td><td>'+time+'</td><td>'+date+'</td><td><a onclick="toggle_it('+data[i]['id']+');" class="link_item" href="#" data-toggle="tooltip" data-placement="left" title="Mark as '+iconText+'"><i class="fa '+icon+'" aria-hidden="true"></i></a>&nbsp;&nbsp;<a class="link_item" onclick="edit_it('+data[i]['id']+');" href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;<a class="link_item" href="#" data-toggle="tooltip" data-placement="right" onclick="delete_it('+data[i]['id']+');" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
			    }
	    	}
	    	$('#insert_table').html(html);
		  }
		}
	});
}

$(() => {

	set_default_date();

	fetch_dropdown_data();

	fetch_data();

	$('.add_btn').click(() => {

		let name = $('#name').val();

		let date = $('#date').val();

		let time = $('#mtime').val();

		if(!is_valid_name(name)){
			toggle_modal("Error", "Invalid Name!");
			return;
		}

		if(!is_valid_date(date)){
			toggle_modal("Error", "Invalid Date Selection!");
			return;
		}

		if(!is_valid_time(time)){
			toggle_modal("Error", "Invalid Time Selection!");
			return;
		}

		add_data(name, date, time);

	})
})