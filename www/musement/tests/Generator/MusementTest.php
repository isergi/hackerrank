<?php

namespace Tests\Generator;

use PHPUnit\Framework\TestCase;
use SitemapTool\Generator\Musement;

class MusementTest extends TestCase
{

    const TEST_FILE_NAME = __DIR__ . '/../../' . 'test.xml';
    const API_LIMIT_ITEMS = 3;

    const MINIMAL_FILE_SIZE = 1000;

    protected $_generator;

    public function setUp()
    {
        if (file_exists(self::TEST_FILE_NAME)) {
            unlink(self::TEST_FILE_NAME);
        }

        $this->_generator = new Musement();
        $this->_generator->initFile(self::TEST_FILE_NAME)
                         ->fetchData(['limit' => self::API_LIMIT_ITEMS])
                         ->writeData()
                         ->finalize();
    }

    public function tearDown()
    {
        unlink(self::TEST_FILE_NAME);
    }

    public function testFileGenerated()
    {
        $this->assertFileExists(self::TEST_FILE_NAME);
    }

    public function testFileNotEmpty()
    {
        $this->assertTrue(self::MINIMAL_FILE_SIZE < filesize(self::TEST_FILE_NAME));
    }

    public function testFileEndsCorrectly()
    {
        $this->assertTrue((bool)preg_match('/<\/urlset>$/', file_get_contents(self::TEST_FILE_NAME)));
    }
}
