
	
	<script src="../lib/jquery.js"></script>
	<script src="../dist/jquery.validate.js"></script>
	<script>
	$.validator.setDefaults({
		submitHandler: function() {
			alert("submitted!");
		}
	});

	$().ready(function() {
		// validate the comment form when it is submitted
		$("#Change").validate();

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			}
		});

		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

		//code to hide topic selection, disable for demo
		var newsletter = $("#newsletter");
		// newsletter topics are optional, hide at first
		var inital = newsletter.is(":checked");
		var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		var topicInputs = topics.find("input").attr("disabled", !inital);
		// show when newsletter is checked
		newsletter.click(function() {
			topics[this.checked ? "removeClass" : "addClass"]("gray");
			topicInputs.attr("disabled", !this.checked);
		});
	});
	</script>
	<style>
	#Change label.error {
    color: red;
    vertical-align: top;
    margin-bottom: 10px;
    margin-top: -9px;
    padding-top: 0px;
    width: 100%;
    display: inline;
    font-size: 12px;
  }
  
  input.error,
  select.error,
  textarea.error {
    border: 1px solid #e86b52!important;
  }
	</style>



	
	<!--<form class="cmxform" id="Change" method="get" action="">
		<fieldset>
			<legend>Please provide your name, email address (won't be published) and a comment</legend>
			<p>
				<label for="cname">Name (required, at least 2 characters)</label>
				<input id="cname" name="name" minlength="2" type="text" required>
			</p>
			<p>
				<label for="cemail">E-Mail (required)</label>
				<input id="cemail" type="email" name="email" required><br>
			</p>
			<p>
				<label for="curl">URL (optional)</label>
				<input id="curl" type="url" name="url">
			</p>
			<p>
				<label for="ccomment">Your comment (required)</label>
				<textarea id="ccomment" name="comment" required></textarea>
			</p>
			<p>
				<input class="submit" type="submit" value="Submit">
			</p>
		</fieldset>
	</form>-->
	
	
	<form class="form-horizontal" method="POST" id="Change">


									<div class="form-group has-feedback">
										<label for="inputEmail" class="col-sm-3 control-label">Email </label>
										<div name="" class="col-sm-8">
										<i class="fa fa-user form-control-feedback"></i>
 <input type="email" class="form-control" name="inputEmail" id="inputEmails" placeholder="Email" required><br>
 
											
										</div>
									</div>
									
									
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">Password</label>
										
										<div class="col-sm-8">
										<i class="fa fa-lock form-control-feedback"></i>
<input type="password" class="form-control"
name="password"	id="inputPassword" placeholder="Password" required><br>
											
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input 
													name="remember" type="checkbox" value="1"> Remember me.
												</label>
											</div>											
											<button type="submit" name="submit" class="btn btn-sm btn-default shop-btn" style="color:#fff;">Log In <i class="fa fa-user"></i></button>
											<ul style="padding-left:0;">
												<li style="list-style:none;"><a data-toggle="modal" data-target="#changepasswordModal" href="#changepasswordModal">Forgot your password?</a></li>
											</ul>
											
                                      	<span class="text-center text-muted"><a href="<?php echo SITE_URL;?>/user-registration.php"> <i class="fa fa-user"></i> Create a new account</a></span>

										</div>
									</div>
								</form>
	


