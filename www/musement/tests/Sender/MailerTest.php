<?php

namespace Tests\Sender;

use PHPUnit\Framework\TestCase;
use SitemapTool\Sender\Mailer;
use SitemapTool\Exceptions\SenderException;

class MailerTest extends TestCase
{

    const TEST_FILE_NAME = __DIR__ . '/test.xml';

    protected $_sender;

    public function setUp()
    {
        $this->_sender = new Mailer();

        $this->_sender->init(['from' => 'nobody@examble.com'])
                      ->setBody('Hello. You have recieved a new Sitemap file.')
                      ->setSubject('PHPUnit test message')
                      ->addEmailList(['noreply@example.com'])
                      ->attachFile(self::TEST_FILE_NAME);
    }

    public function testSendEmail()
    {
        $this->assertTrue($this->_sender->send());
    }

    public function testAttachFile()
    {
        $this->expectException("SitemapTool\Exceptions\SenderException");
        $this->expectExceptionCode(Mailer::ERROR_CODE_NO_SUCH_FILE);
        $this->_sender->attachFile(self::TEST_FILE_NAME . '.no-file-exists.txt');
    }
}
