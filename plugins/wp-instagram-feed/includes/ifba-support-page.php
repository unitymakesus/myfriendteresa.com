<?php if ( ! defined( 'ABSPATH' ) ) exit;  if( isset($_POST['submit']) ){ $formok = true; $errors = array(); $ipaddress = $_SERVER['REMOTE_ADDR']; $date = date('d/m/Y'); $time = date('H:i:s');  $name = $_POST['name']; $email = $_POST['email']; $telephone = $_POST['telephone']; $enquiry = $_POST['enquiry']; $message = $_POST['message']; if(empty($name)){ $formok = false; $errors[] = "You have not entered a name"; } if(empty($email)){ $formok = false; $errors[] = "You have not entered an email address"; }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $formok = false; $errors[] = "You have not entered a valid email address"; } if(empty($message)){ $formok = false; $errors[] = "You have not entered a message"; } elseif(strlen($message) < 20){ $formok = false; $errors[] = "Your message must be greater than 20 characters"; } if($formok){ $headers = "From: {$name} <{$email}> "."\r\n"; $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; $emailbody = "<p>Instagram Feed Support From Plugin (Free Version).</p> <p><strong>Name: </strong> {$name} </p> <p><strong>Email Address: </strong> {$email} </p> <p><strong>Website URL: </strong> {$telephone} </p> <p><strong>Enquiry: </strong> {$enquiry} </p> <p><strong>Message: </strong> {$message} </p> <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>"; mail("arrowplugins@gmail.com","Instagram Feed Support From Plugin (Free Version)",$emailbody,$headers); } $returndata = array( 'posted_form_data' => array( 'name' => $name, 'email' => $email, 'telephone' => $telephone, 'enquiry' => $enquiry, 'message' => $message ), 'form_ok' => $formok, 'errors' => $errors ); if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){ $_SESSION['cf_returndata'] = $returndata; } }

?> <script type="text/javascript"> window.log = function(){ log.history = log.history || []; log.history.push(arguments); arguments.callee = arguments.callee.caller; if(this.console) console.log( Array.prototype.slice.call(arguments) ); }; (function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();)b[a]=b[a]||c})(window.console=window.console||{}); 

 jQuery(document).ready(function($){

 var form = $('#upc_contact-form').find('form'), formElements = form.find('input[type!="submit"],textarea'), formSubmitButton = form.find('[type="submit"]'), errorNotice = $('#upc_errors'), successNotice = $('#upc_success'), loading = $('#loading'), errorMessages = { required: ' is a required field', email: 'You have not entered a valid email address for the field: ', minlength: ' must be greater than ' } formElements.each(function(){

 if(!Modernizr.input.placeholder){ var placeholderText = this.getAttribute('placeholder'); if(placeholderText){ $(this) .addClass('placeholder-text') .val(placeholderText) .bind('focus',function(){ if(this.value == placeholderText){ $(this) .val('') .removeClass('placeholder-text'); } }) .bind('blur',function(){ if(this.value == ''){ $(this) .val(placeholderText) .addClass('placeholder-text'); } }); } } if(!Modernizr.input.autofocus){ if(this.getAttribute('autofocus')) this.focus(); } }); formSubmitButton.bind('click',function(){ var formok = true, errors = []; formElements.each(function(){ var name = this.name, nameUC = name.ucfirst(), value = this.value, placeholderText = this.getAttribute('placeholder'), type = this.getAttribute('type'), isRequired = this.getAttribute('required'), minLength = this.getAttribute('data-minlength'); if( (this.validity) && !this.validity.valid ){ formok = false; console.log(this.validity); if(this.validity.valueMissing){ errors.push(nameUC + errorMessages.required); } else if(this.validity.typeMismatch && type == 'email'){ errors.push(errorMessages.email + nameUC); } this.focus(); return false; } if(isRequired){ if(!Modernizr.input.required){ if(value == placeholderText){ this.focus(); formok = false; errors.push(nameUC + errorMessages.required); return false; } } }

 if(type == 'email'){ if(!Modernizr.inputtypes.email){ var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; if( !emailRegEx.test(value) ){ this.focus(); formok = false; errors.push(errorMessages.email + nameUC); return false; } } } if(minLength){ if( value.length < parseInt(minLength) ){ this.focus(); formok = false; errors.push(nameUC + errorMessages.minlength + minLength + ' charcters'); return false; } } }); if(!formok){ $('#req-field-desc') .stop() .animate({ marginLeft: '+=' + 5 },150,function(){ $(this).animate({ marginLeft: '-=' + 5 },150); }); showNotice('error',errors); } else { loading.show(); $.ajax({ url: form.attr('action'), type: form.attr('method'), data: form.serialize(), success: function(){ showNotice('success'); form.get(0).reset(); loading.hide(); } }); } return false; });

 function showNotice(type,data) { if(type == 'error'){ successNotice.hide(); errorNotice.find("li[id!='info']").remove(); for(x in data){ errorNotice.append('<li>'+data[x]+'</li>'); } errorNotice.show(); } else { errorNotice.hide(); successNotice.show(); } } String.prototype.ucfirst = function() { return this.charAt(0).toUpperCase() + this.slice(1); } }); 

</script> <style> 

#upc_contact-form { background-color:#F2F7F9; width:465px; padding:20px; margin: 50px; border: 6px solid #8FB5C1; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; position:relative; text-align: center; }

#upc_contact-form h1 { font-size:42px; }

#upc_contact-form h2 { margin-bottom:15px; font-style:italic; font-weight:normal; }

#upc_contact-form input, #upc_contact-form select, #upc_contact-form textarea, #upc_contact-form label { font-size:15px; margin-bottom:2px; }

#upc_contact-form input, #upc_contact-form select, #upc_contact-form textarea { width:450px; border: 1px solid #CEE1E8; margin-bottom:20px; padding:4px; height: 40px; }

#upc_contact-form input:focus, #upc_contact-form select:focus, #upc_contact-form textarea:focus { border: 1px solid #AFCDD8; background-color: #EBF2F4; }

#upc_contact-form textarea { height:150px; resize: none; }

#upc_contact-form label { display:block; }

#upc_contact-form .required { font-weight:bold; color:#F00; }

#upc_contact-form #submit-button { width: 97%; background-color:#333; color:#FFF; border:none; display:block; margin-bottom:0px; margin-right:6px; background-color:#8FB5C1; -moz-border-radius:8px; margin: 0 auto; }

#upc_contact-form #submit-button:hover { background-color: #A6CFDD; }

#upc_contact-form #submit-button:active { position:relative; top:1px; }

#upc_contact-form #loading { width:32px; height:32px; display:block; position:absolute; right:130px; bottom:16px; display:none; }

#upc_errors { border:solid 1px #E58E8E; padding:10px; margin:25px 0px; display:block; width:437px; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px; display:none; }

#upc_errors li { padding:2px; list-style:none; }

#upc_errors li:before { content: ' - '; }

#upc_errors #upc_info { font-weight:bold; }

#upc_errors #upc_info:before { content: ''; }

#upc_success { border:solid 1px #83D186; padding:25px 10px; margin:25px 0px; display:block; width:437px; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px; font-weight:bold; display:none; }

#upc_errors.visible, #upc_success.visible { display:block; }

#upc_req-field-desc { font-style:italic; } </style> <div id="container"> <div id="upc_contact-form" class="clearfix"> <h1>Get 24/7 Support!</h1> <h2>Contact us anytime, we'll do our best to answer and resolve all your questions & issues as soon as possible</h2>

 <?php $cf = array(); $sr = false; if(isset($_SESSION['cf_returndata'])){ $cf = $_SESSION['cf_returndata']; $sr = true; } ?> <ul id="upc_errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>"> <li id="upc_info">There were some problems with your form submission:</li> <?php if(isset($cf['errors']) && count($cf['errors']) > 0) : foreach($cf['errors'] as $error) : ?> <li><?php echo $error ?></li> <?php endforeach; endif; ?> </ul> <p id="upc_success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">THANK YOU!<br/> Your message has been sent successfully, Our support team will be in touch with you very soon.</p> <form method="post" action=""> <label for="name">Name: <span class="required">*</span></label> <input type="text" id="name" name="name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['name'] : '' ?>" placeholder="John Doe" required autofocus /> <label for="email">Email Address: <span class="required">*</span></label> <input type="email" id="email" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : '' ?>" placeholder="johndoe@example.com" required />  <label for="telephone">Website URL: <span class="required">*</span></label>
                <p>Example: http://www.website.com</p>
                <input placeholder="http://www.website.com" type="url" id="telephone" name="telephone" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['telephone'] : '' ?>" required/> <label for="enquiry">Enquiry: </label> <select id="enquiry" name="enquiry"> <option value="General" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'General') ? "selected='selected'" : '' ?>>General</option> <option value="Support" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Support') ? "selected='selected'" : '' ?>>Support</option> </select> <label for="message">Message: <span class="required">*</span></label> <textarea id="message" name="message" placeholder="Your message must be greater than 20 charcters" required data-minlength="20"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?></textarea> <span id="loading"></span> <input type="submit" value="Submit!" name="submit" id="submit-button" /> <p id="req-field-desc"><span class="required">*</span> indicates a required field</p> </form> <?php unset($_SESSION['cf_returndata']); ?> </div> </div> 