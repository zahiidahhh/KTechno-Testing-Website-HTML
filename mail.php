<?php 
// Email configuration 
$toEmail = 's202020550@studentmail.unimap.edu.my'; 
$fromName = 'Website KTechno'; 
$formEmail = ''; 
 
$postData = $statusMsg = $valErr = ''; 
$status = 'error'; 
 
// If the form is submitted 
if(isset($_POST['submit'])){ 
    // Get the submitted form data 
    $postData = $_POST; 
    $name = trim($_POST['name']); 
    $email = trim($_POST['email']); 
    $phone = trim($_POST['phone']); 
    $message = trim($_POST['message']); 
     
    // Validate form fields 
    if(empty($name)){ 
         $valErr .= 'Please enter your name.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($phone)){ 
        $valErr .= 'Please enter your number phone.<br/>'; 
    } 
    if(empty($message)){ 
        $valErr .= 'Please enter your message.<br/>'; 
    } 
     
    if(empty($valErr)){ 
        // Send email notification to the site admin 
        $subject = "New Contact Form Enquiry ; Questions that have been asked from KTechno website visitors"; 
        $htmlContent = " 
            <h2>Contact Form KTechno</h2> 
            <p><b>Name: </b>".$name."</p> 
            <p><b>Email: </b>".$email."</p> 
            <p><b>Phone No.: </b>".$phone."</p> 
            <p><b>Message: </b>".$message."</p> 
        "; 
         
        // Always set content-type when sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        // Header for sender info 
        $headers .= 'From:'.$fromName.' <'.$formEmail.'>' . "\r\n"; 
         
        // Send email 
        @mail($toEmail, $email, $htmlContent, $headers); 
         
        $status = 'success';
        $statusMsg = 'Your details has been successfully sent! We will be contact you as soon as possible.
        If there is no further response from us, please call the number listed on Contact Info.
        Thank you for your understanding!'; 
        $postData = ''; 
    }else{ 
        $statusMsg = '<p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>'); 
    } 
}

?>