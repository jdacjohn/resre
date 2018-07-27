<?php

/*
 * resre
 * PWResetRequest
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Jul 26, 2018 10:13:28 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

namespace resre;

/**
 * Description of PWResetRequest
 *
 * @author John Arnold <john@jdacsolutions.com>
 */
class PWResetRequest {

    private $recipient = '';
    private $hash = '';
    
    public function __construct($recipient, $hash) {
        $this->recipient = $recipient;
        $this->hash = $hash;
    }
    public function getRecipient() {
        return $this->recipient;
    }

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    // Send password reset information to user
    public function sendPWResetMsg() {
        
        $msg = $this->getHTMLReqMsg();
        // multiple recipients
        //$to  = 'aidan@example.com' . ', '; // note the comma
        // DEV ONLY - once fully tested and ready to deploy replace with commented line below
        //$to = EMAIL_LEADS_NOTIFICATION;
        $to = $this->getRecipient();
        // subject
        $subject = PROJECT_TITLE_SHORT . ' Password Reset Request';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        //$headers .= 'To: ' . PROJECT_TITLE_SHORT . ' Leads Contact <' . EMAIL_LEADS_NOTIFICATION . '>' . "\r\n";
        $headers .= 'From: ' . EMAIL_CONTACT . "\r\n";
        //$headers .= 'Cc: jdaceasttexas@gmail, webbheadz@gmail.com' . "\r\n";
        //$headers .= 'Bcc: john@arnoldsrule.com' . "\r\n";

        // Mail it
        if (mail($to, $subject, $msg, $headers)) {
            return $msg;
        } else {
            return "Error occurred while attempting to send mail";
        }
    }
    
    private function getHTMLReqMsg() {
        $msgbody = '
            
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> ' . PROJECT_TITLE_SHORT . ' Password Reset Request</title>
    </head>
    <body yahoo>
        <table width="600" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="left" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                            <![endif]-->
                            <table width="100%" align="left" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="25%" align="left">
                                        <img src="' . HOME_LINK . 'us/images/pdf/FLASH-logo.png" alt="Resilient Residence by University of Florida" width="250" height="100" />
                                    </td>
                                    <td><h3> ' . PROJECT_TITLE_SHORT. ' Password Reset Request</h3></td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                        </td>
                    </tr>
                </table>
                <![endif]-->
                </td>
            </tr>
            <tr>
                <td>
                <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="left" cellpadding="20px 5px 20px 5px" cellspacing="0" border="0">
                    <tr>
                        <td>
                            <![endif]-->
                            <table width="100%" align="left" cellpadding="20px 5px 20px 5px" cellspacing="0" border="0">
                                <tr style="padding-top: 15px; padding-bottom: 15px;">
                                    <td>' . PROJECT_TITLE_SHORT . ' has received a request to reset the password for the account registered to this email address.</td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                        </td>
                    </tr>
                </table>
                <![endif]-->
                </td>
            </tr>
            <tr>
                <td>
                 <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="left" cellpadding="20px 5px 20px 5px" cellspacing="0" border="0" style="background-color: #E3E4E5;">
                    <tr>
                        <td>
                            <![endif]-->
                            <table width="100%" align="left" cellpadding="20px 5px 20px 5px" cellspacing="0" border="0" style="background-color: #ffffff; padding: 2px;">
                                <tr style="padding-bottom: 10px;">
                                    <td align="left">Please click on the link below to reset your password.  <strong>This link will only be valid for 24 hours</strong>.</td>
                                </tr>
                                <tr style="padding-bottom: 10px;">
                                    <td align="left"><a href="' . HOME_LINK .  'us/index.php?postFrom=reset&pr=' . $this->hash . '">Reset Password</a></td>
                                </tr>
                                <tr style="padding-bottom: 10px;">
                                    <td align="left">Or, you can copy and paste the following link into your browser address bar:</td>
                                </tr>
                                <tr style="padding-bottom: 20px;">
                                    <td align="left">' . HOME_LINK .  'us/index.php?postFrom=reset&pr=' . $this->hash . '</td>
                                </tr>
                                <tr style="padding-bottom: 10px;">
                                    <td align="left">If you did not make this request, please ignore this message, or contact <a href="mailto:suppor@resilientres.com">support@resilientres.com</a></td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                        </td>
                    </tr>
                </table>
                <![endif]-->               
                </td>
            </tr>
        </table>
    </body>
</html>';            
 
        return $msgbody;
    }
    
}
