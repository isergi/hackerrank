<?php

namespace SitemapTool\Tool;

use SitemapTool\Generator\iGenerator;
use SitemapTool\Sender\iSender;
use SitemapTool\Cli\Console;

/**
 * A general tool for generating or sending a sitemap file.
 *
 */
class Tool
{

    /**
     * Limit of items requests from API
     */
    const API_LIMIT_ITEMS    = 20;

    /**
     * Path to the sitemap file
     */
    private $_fileName = null;

    /**
     * Setup a path to the sitemap file
     * 
     * @param string        $fileName  a path to the sitemap file
     */
    public function __construct(string $fileName)
    {
        $this->_fileName = $fileName;
    }

    /**
     * Generate a new sitemap file from a source
     * 
     * @param iGenerator        $generator  generator of a new sitemap file
     * 
     * @throws GeneratorException if unable to create or write a file
     */
    public function generate(iGenerator $generator) : void
    {
        $generator->initFile($this->_fileName)
            ->fetchData(['limit' => self::API_LIMIT_ITEMS])
            ->writeData()
            ->finalize();
    }

    /**
     * Send a sitemap file to recipients
     * 
     * @param iSender        $sender  class sending a data by email adresses
     * @param array          $emailList  a list of recipients of the sitemap file
     * @param array          $config  configuration of a sender
     * 
     * @throws SenderException if unable to send file via email
     */
    public function send(iSender $sender, array $emailList, array $config) : void
    {
        $sender->init($config)
               ->setBody('Hello. You have recieved a new Sitemap file.')
               ->addEmailList($emailList)
               ->attachFile($this->_fileName)
               ->send();
    }
}
