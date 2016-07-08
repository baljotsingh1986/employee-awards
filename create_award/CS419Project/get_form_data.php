<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
ini_set('display_errors', 'On');

require_once '../phpmailer/vendor/autoload.php';
include("../../secret.php");

if(isset($_POST['a-last-name'], $_POST['a-middle-name'], $_POST['a-first-name'])) {
	$certificate_data = array($_POST['r-first-name'], $_POST['r-middle-name'], $_POST['r-last-name'], $_POST['award-type'], $_POST['date'], $_POST['signature'], $_POST['a-first-name'], $_POST['a-middle-name'], $_POST['a-last-name'], $_POST['job-title'],);
	echo "awarder's full name is " . $certificate_data[6] . " " . $certificate_data[7] . " " . $certificate_data[8] . "\r\r";
}
else {
	echo "didn't work";
}


//Output a csv file from POST data


// create a file pointer connected to the output stream
$file = fopen('data.csv', 'w');

// output the column headings
fputcsv($file, array('RFirstName', 'RMiddleName', 'RLastName', 'AwardType', 'Date', 'Signature', 'AFirstName', 'AMiddleName', 'ALastName', 'JobTitle'));

//fetch single row of data from POST variable
fputcsv($file, $certificate_data);

fclose($file);

exec("/usr/bin/pdflatex certificate_style3.ltx 2>&1");


//*******Send the certificate via email
if(isset($_POST['a-email'], $_POST['r-email'])) {
	$AEmail = $_POST['a-email']; //Awarder's email 
	$REmail = $_POST['r-email']; //Recipient's email
}
else {
	echo "Need email addresses\r";
}
if(isset($_POST['a-first-name'], $_POST['r-first-name'])) {
	$AFirstName = $_POST['a-first-name']; //Awarder's first name 
	$RFirstName = $_POST['r-first-name']; //Recipient's first name
	$ALastName = $_POST['a-last-name']; //Awarder's last name 
	$RLastName = $_POST['r-last-name']; //Recipient's last name
}
else {
	echo "Need email addresses\r";
}
$m = new PHPMailer;

$m->isSMTP();
$m->SMTPAuth = true;
$m->SMTPDebug = 2;

$m->Host = 'smtp.gmail.com';
$m->Username = 'akane.tanaban@gmail.com';
$m->Password = $myPassword;
$m->SMTPSecure = 'ssl';
$m->Port = 465;

$m->From = $AEmail;
$m->FromName = $AFirstName . " " . $ALastName;
$m->addReplyTo($REmail, 'Reply address');
$m->addAddress($REmail, $RFirstName . " " . $RLastName);

$m->MsgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$m->Subject = 'Here is your award';
$m->Body = 'This is the body of an email';
$m->AltBody = 'This is the body of an email';
//Make sure relative path to certificate pic is correct here
$m->AddAttachment('certificate_style3.pdf');

//send the message, check for errors
if (!$m->send()) {
    echo "Mailer Error: " . $m->ErrorInfo;
} else {
    echo "Message sent!";
}



//header("Location: /CS419Project/send_award.php");
//echo $output;
// fetch the data from database
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('database');
//$rows = mysql_query('SELECT field1,field2,field3 FROM table');

// loop over the rows, outputting them
//while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);


