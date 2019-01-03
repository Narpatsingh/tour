<?php

set_time_limit(3000);

function debug($data = '')
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

class Mail
{
    public $hostName = '';
    public $userName = '';
    public $password = '';
    public $folder = null;
    public $emails = '';
    public $emailCount = 0;
    public $emailDetails = array();

    public function __construct($host = null, $user = null, $pass = null)
    {
        $this->hostName = $host;
        $this->userName = $user;
        $this->password = $pass;
    }

    public function connect()
    {
        $this->folder = imap_open($this->hostName, $this->userName, $this->password) or die('Cannot connect due to : ' . imap_last_error());
    }

    public function getDetails($options = array(), $userDetails)
    {
        $critaria = 'ALL';
        $since = '';
        $since = (isset($options['since']) ? ' SINCE "' . $options['since'] . '"' : '');

        if (isset($options['from'])) {
            foreach ($options['from'] as $key => $from) {
                $critaria = $since . ' FROM "' . $from . '"';
                $this->emails = imap_search($this->folder, $critaria);

                if ($this->emails) {
                    foreach ($this->emails as $key => $emailNo) {
                        $this->emailCount += 1;
                        $overview = imap_fetch_overview($this->folder, $emailNo, 0);
                        $this->emailDetails[] = array(
                            'subject' => $overview[0]->subject,
                            'body' => $this->getBody($emailNo),
                            'from' => $overview[0]->from,
                            'to' => $overview[0]->to,
                            'date' => $overview[0]->date,
                            'message_id' => $overview[0]->message_id,
                            'size' => $overview[0]->size,
                            'uid' => $overview[0]->uid,
                            'msgno' => $overview[0]->msgno,
                            'recent' => $overview[0]->recent,
                            'flagged' => $overview[0]->flagged,
                            'answered' => $overview[0]->answered,
                            'deleted' => $overview[0]->deleted,
                            'seen' => $overview[0]->seen,
                            'draft' => $overview[0]->draft,
                            'udate' => $overview[0]->udate,
                            'attachment' => $this->getAttachment($emailNo)
                        );
                    }
                }
            }
            return array('emails' => $this->emailDetails, 'totalEmails' => $this->emailCount);
        }
    }

    public function getBody($emailNumber = null)
    {
        $dataTxt = $this->get_part($this->folder, $emailNumber, "TEXT/PLAIN");
        $dataHtml = $this->get_part($this->folder, $emailNumber, "TEXT/HTML");

        if ($dataHtml != "") {
            $msgBody = $dataHtml;
        } else {
            $msgBody = ereg_replace("\n", "<br>", $dataTxt);
        }
        return $msgBody;
    }

    public function get_mime_type(&$structure)
    {
        $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
        if ($structure->subtype) {
            return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }

    public function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
    {

        if (!$structure) {
            $structure = imap_fetchstructure($stream, $msg_number);
        }
        if ($structure) {
            if ($mime_type == $this->get_mime_type($structure)) {
                if (!$part_number) {
                    $part_number = "1";
                }
                $text = imap_fetchbody($stream, $msg_number, $part_number);
                if ($structure->encoding == 3) {
                    return imap_base64($text);
                } else if ($structure->encoding == 4) {
                    return imap_qprint($text);
                } else {
                    return $text;
                }
            }

            if ($structure->type == 1) {
                while (list($index, $sub_structure) = each($structure->parts)) {
                    $prefix = '';
                    if ($part_number) {
                        $prefix = $part_number . '.';
                    }
                    $data = $this->get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
                    if ($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }

    public function getAttachment($emailNumber = null)
    {
        $structure = imap_fetchstructure($this->folder, $emailNumber);
        $attachments = array();

        // if any attachments found...
        if (isset($structure->parts) && count($structure->parts)) {
            for ($i = 0; $i < count($structure->parts); $i++) {
                if ($structure->parts[$i]->ifdparameters) {
                    foreach ($structure->parts[$i]->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;

                            $attachments[$i]['attachment'] = imap_fetchbody($this->folder, $emailNumber, $i + 1);

                            /* 4 = QUOTED-PRINTABLE encoding */
                            if ($structure->parts[$i]->encoding == 3) {
                                $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                            }
                            /* 3 = BASE64 encoding */ elseif ($structure->parts[$i]->encoding == 4) {
                                $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                            }
                        }
                    }
                }
            }
        }

        /*
         *  iterate through each attachment and save it
         */
        foreach ($attachments as $k => $attachment) {
            if ($attachment['is_attachment'] == 1) {
                $filename = isset($attachment['name']) ? $attachment['name'] : '';
                if (empty($filename))
                    $filename = $attachment['filename'];

                if (empty($filename))
                    $filename = time() . ".dat";

                /*
                 * prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $attachments[$k]['location'] = $location = md5(microtime()) . '.' . $ext;

                $path = '/home/brandhawkmanaged/public_html/files/attachment/' . $location;
                $fp = fopen($path, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
                unset($attachments[$k]['attachment']);
            }
        }

        return $attachments;
    }
}
