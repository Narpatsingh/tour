<?php
require_once("mailProvider.php");

$fromAddress = array(
    'support@managed-me.com',
    'support@managedservices.me',
    'mazhar@managed-me.com',
    'devp@managed-me.com'
    //'alexsprojects@live.com',
);
$attachmentSavePath = WWW_ROOT.
class syncMails
{
    public $currentDate = '';

    function __construct()
    {
        $this->currentDate = date('Y-m-d');
    }

    public function getUserDetails()
    {
        $sql = 'select id, email_config, email_address, email_password, last_sync_date, last_mail_id from users';
        $result = mysql_query($sql);
        if (mysql_num_rows($result) < 0) {
            die('Could not get data: ' . mysql_error());
        }

        $userDetails = array();

        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            if (!empty($row['email_address']) && !empty($row['email_password']) && !empty($row['email_config'])) {
                $lastSyncDate = ($row['last_sync_date'] != '0000-00-00') ? $row['last_sync_date'] : $this->currentDate;

                $userDetails[] = array(
                    'userId' => $row['id'],
                    'email' => $row['email_address'],
                    'password' => base64_decode($row['email_password']),
                    'config' => $row['email_config'],
                    'lastSyncDate' => date('d M Y', strtotime($lastSyncDate)),
                    'lastMailId' => $row['last_mail_id']
                );
            }
        }
        return $userDetails;
    }

    public function getMail($fromAddress)
    {
        $userDetails = $this->getUserDetails();

        foreach ($userDetails as $key => $user) {
            $mail = new Mail('{' . $user['config'] . '}INBOX', $user['email'], $user['password']);
            $mail->connect();
            $options = array(
                'from' => $fromAddress,
                'since' => $user['lastSyncDate']
            );
            $emails = $mail->getDetails($options, $user);
            $this->saveEmail($emails, $user);
        }
    }

    public function saveEmail($emails, $userDetails)
    {
        $tmpLastMailId = $lastMailId = $userDetails['lastMailId'];
		$arrPriority = array(
							1 => 'critical',
							2 => 'high',
							3 => 'medium',
							4 => 'guarded',
							5 => 'low',
						);
        foreach ($emails['emails'] as $key => $email) {
            if ($email['msgno'] > $tmpLastMailId) {				
                $ticketNumber ='';

				$priority = str_replace('P','',substr($email['subject'],0,2));
				$priority = is_numeric ($priority)?$priority:'';
				$is_flash = $priority==1?1:0;
				$priority = isset($arrPriority[$priority])?$arrPriority[$priority]:'';
				if(empty($priority)){
					continue;
				}
                preg_match_all('(\[#\d+\])', $email['subject'], $ticketNumber);
                $ticketNumber = !empty($ticketNumber[0]) ? $ticketNumber[0][0] : '';
                $sql = 'INSERT INTO tickets (user_id, priority,is_flash,number, date_and_time, subject, email_body, from_user, created_at) VALUES (' .
                    "'" . $userDetails['userId'] . '\',' .
                    "'" . $priority . '\',' .
                    "" . $is_flash . ', \'' .
                    $ticketNumber . '\', \'' .
                    date('Y-m-d H:i:s', strtotime($email['date'])) . '\', \'' .
                    addslashes($email['subject']) . '\', \'' .
                    addslashes($email['body'])  . '\', \'' .
                    addslashes($email['from']) . '\', \'' .
                    $this->currentDate . '\')';
                $lastMailId = $email['msgno'];

                mysql_query($sql);

                if (!empty($email['attachment'])) {
                    $lastId = mysql_insert_id();
                    $attachments = $email['attachment'];
                    foreach ($attachments as $key => $attachment) {
                        $sql = 'INSERT INTO email_attachment (user_id, ticket_id, name, location, created_at) VALUES (' .
                            "'" . $userDetails['userId'] . '\', \'' .
                            $lastId . '\', \'' .
                            $attachment['filename'] . '\', \'' .
                            $attachment['location'] . '\', \'' .
                            $this->currentDate . '\')';
                        mysql_query($sql);
                    }
                }
            }
        }
        $sql = 'UPDATE users SET last_sync_date=\'' . $this->currentDate . '\', last_mail_id=\'' . $lastMailId . '\' WHERE id=' . $userDetails['userId'];
        mysql_query($sql);
        echo "\nDone\n";
    }
}

$syncMail = new syncMails();
$syncMail->getMail($fromAddress);
