<?php

namespace SitemapTool\Sender;

use SitemapTool\Exceptions\SenderException;
use \PHPMailer\PHPMailer\PHPMailer;

/**
 * Mailer sender.
 *
 * The **Mailer** class is a sender of a sitemap file via email.
 *
 */
class Mailer implements iSender
{

    /**
     * Return this code error when no file to attach
     */
    const ERROR_CODE_NO_SUCH_FILE = 110;
    /**
     * Return this code error when Mailer gets FALSE trying to send email
     */
    const ERROR_CODE_MESSAGE_COULD_NOT_SENT = 111;
    /**
     * Return this code when there is no locale in a sitemap file
     */
    const ERROR_CODE_NO_FILE_LOCALE = 112;

    /**
     * Instans of the PHPMailer class
     */
    private $_phpMailer = null;

    /**
     * List of email recipients
     */
    private $_emailList  = [];

    /**
     * Collect a list of email recipients of the sitemap file
     * 
     * @param array              $emailList  array of recipients
     * 
     * @return iSender
     */
    public function addEmailList(array $emailList) : iSender
    {
        $this->_emailList = $emailList;
        return $this;
    }

    /**
     * Apply SMTP configuration for a sender
     * Set a subject for email sender
     * 
     * @param array              $config  smtp configuration
     * 
     * @return iSender
     */
    public function init(array $config) : iSender
    {

        $this->_phpMailer = new PHPMailer();

        if (!empty($config['smtp'])) {
            $this->_phpMailer->isSMTP();
            $this->_phpMailer->Host       = $config['host'];
            $this->_phpMailer->SMTPAuth   = $config['auth'];
            $this->_phpMailer->Username   = $config['username'];
            $this->_phpMailer->Password   = $config['password'];
            $this->_phpMailer->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $this->_phpMailer->Port       = $config['port'];587;
        }
        $this->_phpMailer->setFrom($config['from']);

        return $this;
    }

    /**
     * Attach file to the sender
     * 
     * @param string              $fileName  path to the file
     * 
     * @return iSender
     */
    public function attachFile(string $fileName) : iSender
    {
        // If there is no file throw a new Exception
        if (file_exists($fileName)) {

            $locale = $this->_getAttachmentLocale($fileName);
            $this->setSubject('MUSEMENT.COM sitemap for ' . $locale);

            $this->_phpMailer->addAttachment($fileName);
        } else {
            throw new SenderException('No such file "' . $fileName . '" to send ', self::ERROR_CODE_NO_SUCH_FILE);
        }
        
        return $this;
    }

    /**
     * Setup body text of the email
     * 
     * @param string              $body  text of the email body
     * 
     * @return iSender
     */
    public function setBody(string $text) : iSender
    {
        $this->_phpMailer->Body = $text;
        return $this;
    }

    /**
     * Setup subject of the email
     * 
     * @param string              $subject  text of the email subject
     * 
     * @return iSender
     */
    public function setSubject(string $subject) : iSender
    {
        $this->_phpMailer->Subject = $subject;
        return $this;
    }

    /**
     * Send file to recipients
     * 
     * @return bool
     * 
     * @throws SenderException
     */
    public function send() : bool
    {
        $sendResult = false;
        foreach ($this->_emailList as $email) {
            $this->_phpMailer->addAddress($email); 

            $sendResult = $this->_phpMailer->send();

            if ($sendResult === false) {
                throw new SenderException("Message could not be sent. Mailer Error: {$this->_phpMailer->ErrorInfo}", self::ERROR_CODE_MESSAGE_COULD_NOT_SENT);
            }

            $this->_phpMailer->clearAddresses();
        }

        return $sendResult;
    }

    /**
     * Get a locale of the sitemap file
     * 
     * @param string              $fileName  path to the sitemap file
     * 
     * @return string
     * 
     * @throws SenderException
     */
    private function _getAttachmentLocale(string $fileName) : string
    {
        $fileHandler = fopen($fileName, 'r');
        fgets($fileHandler);
        $fileLocale = fgets($fileHandler);

        if (strpos($fileLocale, '<!-- locale:') === false) {
            throw new SenderException('Incorrect file content "' . $fileName . '". Unable to finde a locale.', self::ERROR_CODE_NO_FILE_LOCALE);
        }

        $fileLocale = str_replace(['<!-- ', ' -->'], '', $fileLocale);
        fclose($fileHandler);

        list(,$locale) = explode(':', $fileLocale);
        
        return trim($locale);
    }
}
