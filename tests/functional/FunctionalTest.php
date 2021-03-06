<?php

require_once __DIR__.'/../../vendor/autoload.php';

use Silex\WebTestCase;

/**
 * Functional Tests for Cips
 *
 * @author Alfred Danda
 */
class FunctionalTest extends WebTestCase
{

    public function createApplication()
    {
        $app = require __DIR__ . '/../../src/bootstrap.php';
        require __DIR__ . '/../../src/app.php';
        return $app;
    }

    public function testIndexPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals(1, count($crawler->filter(
                'title:contains("CIPS | Continuous Integration PHP Server")'
        )));
        $this->assertTrue(
            $crawler->filter('html:contains("Project")')->count() == 1
        );
        $this->assertTrue($crawler->filter('html:contains("Build")')->count() == 1);
        $this->assertTrue($crawler->filter('html:contains("Date")')->count() == 1);
    }

    public function testProjectPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue(
            $crawler->filter('html:contains("Project")')->count() == 1
        );
        $this->assertTrue($crawler->filter('html:contains("Build")')->count() == 1);
        $this->assertTrue($crawler->filter('html:contains("Date")')->count() == 1);
    }
}