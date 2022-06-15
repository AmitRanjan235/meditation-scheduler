<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meditation Master!</title>
	<!-- CSS dependencies -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/responsive.css">
</head>
<body>

	<div class="container">
		<div class="header_section">
			<div class="row text-center">
				<div class="col">
					<h3 class="header_title">Meditation Master</h3>
					<p class="header_description text-white">Welcome to Meditation Master! Add your daily meditation goals and compare with others that how you are improving!<br>Set a Goal, Complete it, Mark as Done! As simple as it sounds!</p>
				</div>
			</div>
		</div>


		<div class="form_section">
				<div class="row">
					

					<div class="col-md-3">
						<div class="form-group">
							<label for="name" class="text-white">Name</label>
			    			<input type="text" class="form-control" id="name" aria-describedby="name_error">
			    		</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="date" class="text-white">Date</label>
			    			<input type="date" class="form-control" id="date" aria-describedby="date_error">
			    		</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="mtime" class="text-white">Meditation Goal Time</label>
			    			<select class="form-control" id="mtime">
						      <option value="0">-- Select --</option>
						    </select>
			    		</div>
					</div>
					<div class="col-md-3 align-items-start">
						<div class="form-group">
							<button type="button" id="add_btn" class="btn btn-block btn-outline-light add_btn"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Set Goal!</button>
						</div>
					</div>
					
				</div>
		</div>


		<div class="table_section text-center table-responsive">
			<table class="table table-dark table-hover">
			  <thead>
			    <tr>
			      <th scope="col">Sl No</th>
			      <th scope="col">Name</th>
			      <th scope="col">Meditation Goal</th>
			      <th scope="col">Date</th>
			      <th scope="col">Actions</th>
			    </tr>
			  </thead>
			  <tbody id="insert_table">
			    
			  </tbody>
			</table>
		</div>





	</div>


	<div class="modal_section">
		<div class="modal fade" id="info_modal" tabindex="-1" role="dialog">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="modal_head_text"></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p id="modal_body_text"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>


	<div class="modal_section_delete">
			<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="modal_head_text">Confirm</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <p id="modal_body_text">Do you really want to delete it ?</p>
			      </div>
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
			        <button del-id="#" id="confirm_delete_btn" onclick="delete_from_modal();" type="button" class="btn btn-outline-danger">Yes</button>
			      </div>
			    </div>
			  </div>
			</div>
		</div>


		<div class="modal_section_edit_form">
			<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Change Data</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">

			          <div class="form-group">
							<label for="name_edit">Name</label>
			    			<input type="text" class="form-control" id="name_edit" aria-describedby="name_error">
			    		</div>

			    		<div class="form-group">
							<label for="date_edit">Date</label>
			    			<input type="date" class="form-control" id="date_edit" aria-describedby="date_error">
			    		</div>

			          <div class="form-group">
							<label for="mtime_edit">Meditation Goal Time</label>
			    			<select class="form-control" id="mtime_edit">
						      <option value="0">-- Select --</option>
						    </select>
			    		</div>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" id="update_btn" onclick='javascript:void(0)' class="btn btn-primary">Update</button>
			      </div>
			    </div>
			  </div>
			</div>
		</div>


	<!-- This Footer Section should not be removed!!! -->
	<div style="position: fixed; bottom: 0; width: 100%; text-align: center; background: #586776; color: #FFF; padding: 5px;" class="m-auto" align="center">Developed by - Amit Ranjan</div>

	<!-- Js dependencies -->
	<script
	  src="https://code.jquery.com/jquery-3.5.1.js"
	  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
	  crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="./js/script.js"></script>
</body>
</html>