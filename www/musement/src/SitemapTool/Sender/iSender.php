<?php

namespace SitemapTool\Sender;

interface iSender
{
    /**
     * Apply configuration for a sender
     * 
     * @param array              $config  colleted params for a configuration.
     * 
     * @return iGenerator
     */
    public function init(array $config) : iSender;

    /**
     * Setup body text of the email
     * 
     * @param string              $body  text of the email body
     * 
     * @return iGenerator
     */
    public function setBody(string $text) : iSender;

    /**
     * Setup subject of the email
     * 
     * @param string              $subject  text of the email subject
     * 
     * @return iGenerator
     */
    public function setSubject(string $subject) : iSender;

    /**
     * Collect a list of recipients of the sitemap file
     * 
     * @param array              $emailList  array of recipients
     * 
     * @return iGenerator
     */
    public function addEmailList(array $emailList) : iSender;

    /**
     * Attach file to the sender
     * 
     * @param string              $fileName  path to the file
     * 
     * @return iGenerator
     */
    public function attachFile(string $fileName) : iSender;

    /**
     * Send file to recipients
     * 
     * @return bool
     */
    public function send() : bool;
}
