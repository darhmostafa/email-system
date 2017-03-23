<?php
try
{
    // Change to your mail server
    $host = "";

    // Connecting to POP3 email server.
    $connection = imap_open($host, '', '');

    // Total number of messages in Inbox
    $count = imap_num_msg($connection);
    echo $count . " messages found<br />";

    // Read Messages in Loop, Forward it to Actual User email and than delete it from current email account.
    for ($i = 1; $i <= $count; $i++) {
        $headers = imap_headerinfo($connection, $i);

        $subject = $headers->subject;

        $from = $headers->from[0]->mailbox . '@' . $headers->from[0]->host;
        if ($headers->cc[0]->mailbox)
            $cc = $headers->cc[0]->mailbox . '@' . $headers->cc[0]->host;
        $subject = $headers->subject;

        $structure = imap_fetchstructure($connection, $i);
        $type = $this->get_mime_type($structure);

        // GET HTML BODY
        $body = $this->get_part($connection, $i, "");

        //$raw_body = imap_body($connection, $i);

        $attachments = array();

        if (isset($structure->parts) && count($structure->parts)) {
            for ($e = 0; $e < count($structure->parts); $e++) {
                $attachments[$e] = array('is_attachment' => false, 'filename' => '', 'name' => '', 'attachment' => '');

                if ($structure->parts[$e]->ifdparameters) {
                    foreach ($structure->parts[$e]->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $attachments[$e]['is_attachment'] = true;
                            $attachments[$e]['filename'] = $object->value;
                        } //if (strtolower($object->attribute) == 'filename')
                    } //foreach ($structure->parts[$e]->dparameters as $object)
                } //if ($structure->parts[$e]->ifdparameters)

                if ($structure->parts[$e]->ifparameters) {
                    foreach ($structure->parts[$e]->parameters as $object) {
                        if (strtolower($object->attribute) == 'name') {
                            $attachments[$e]['is_attachment'] = true;
                            $attachments[$e]['name'] = $object->value;
                        } //if (strtolower($object->attribute) == 'name')
                    } //foreach ($structure->parts[$e]->parameters as $object)
                } //if ($structure->parts[$e]->ifparameters)

                if ($attachments[$e]['is_attachment']) {
                    $attachments[$e]['attachment'] = @imap_fetchbody($connection, $i, $e + 1);
                    if ($structure->parts[$e]->encoding == 3) {
                        // 3 = BASE64
                        $attachments[$e]['attachment'] = base64_decode($attachments[$e]['attachment']);
                    } //if ($structure->parts[$e]->encoding == 3)
                    elseif ($structure->parts[$e]->encoding == 4) {
                        // 4 = QUOTED-PRINTABLE
                        $attachments[$e]['attachment'] = quoted_printable_decode($attachments[$e]['attachment']);
                    } //elseif ($structure->parts[$e]->encoding == 4)
                } //if ($attachments[$e]['is_attachment'])

                if ($attachments[$e]['is_attachment']) {
                    $filename = $attachments[$e]['filename'];
                    $filename = $attachments[$e]['name'];
                    $filecontent = $attachments[$e]['attachment'];
                } //if ($attachments[$e]['is_attachment'])
            } //for ($e = 0; $e < count($structure->parts); $e++)
        } //if (isset($structure->parts) && count($structure->parts))
        /**** ****/


        echo "<pre>";
        echo "From: " . $headers->Unseen . "<br />";
        echo "From: " . $from . "<br />";
        echo "Cc: " . $cc . "<br />";
        echo "Subject: " . $subject . "<br />";
        echo "Content Type: " . $type . "<br />";
        echo "Body: " . $body . "<br />";
        $mail = new Zend_Mail();

        $mail->settype(Zend_Mime::MULTIPART_MIXED);

        for ($k = 0; $k < count($attachments); $k++) {
            $filename = $attachments[$k]['name'];
            $filecontent = $attachments[$k]['attachment'];

            if ($filename && $filecontent) {
                $file = $mail->createAttachment($filecontent);
                $file->filename = $filename;
            } //if ($filename && $filecontent)
        } //for ($k = 0; $k < count($attachments); $k++)


        $mail->setFrom($from);
        $mail->addTo('testmail@softmail.me');
        if ($cc)
            $mail->addCc($cc);
        $mail->setSubject($subject);
        $mail->setBodyHtml($body);
        $mail->send();

        // Mark the email messages once read
        //imap_delete($mbox, 1);
    } //for ($i = 1; $i <= $count; $i++)
    // Delete all marked message from current email account.

    imap_expunge($mbox);
    echo 'If you see this, the number is 1 or below';
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
?>