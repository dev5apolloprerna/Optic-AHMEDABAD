<?php
//dd($data);
$mailmsg = "Dear Participant, <br /><br />

Many Congratulations and A Big welcome to OPTIC EXPO Family!!<br />

We are growing faster and Building Stronger with your support. Below we are sharing Login credentials for your easy Participation at OPTIC EXPO <br />

Please 🖥️ Login to find. <br />

▪️Participation Confirmation Letter<br />
▪️Facia/Lanyard Details<br />
▪️Additional Furniture<br />
▪️Whatsapp einvites.<br />
▪️Transport Letter & Much More.<br />

👇Please find below Login credentials. <br />
URL : https://opticexhibition.com/Ahmedabad/exhibitor_login <br />
Login Id: $data->Mobile <br />
Password : $data->strPlainPassword";

echo $mailmsg;

?>
