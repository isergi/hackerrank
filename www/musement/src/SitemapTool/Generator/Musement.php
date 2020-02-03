<?php

namespace SitemapTool\Generator;

use SitemapTool\Exceptions\GeneratorException;

/**
 * Musement generator.
 *
 * The **Musement** class is a generator of a sitemap file for the Musement web-site.
 *
 */
class Musement implements iGenerator
{

    /**
     * Return this code error when ubable to create a hande to the sitemap file
     */
    const ERROR_CODE_UNABLE_OPEN_FILE = 120;
    /**
     * Return this code error when could not to write data into stiemap file
     */
    const ERROR_CODE_UNABLE_TO_WRITE_FILE = 121;

    /**
     * API Url of cities 
     */
    const URL_CITIES         = 'https://api.musement.com/api/v3/cities';
    /**
     * API Url of activities of selected city
     */
    const URL_ACTIVITIES     = 'https://api.musement.com/api/v3/cities/{city_id}/activities';

    /**
     * Priority of city block in a sitemap
     */
    const CITY_PRIORITY      = 0.7;
    /**
     * Priority of activity block in a sitemap
     */
    const ACTIVITY_PRIORITY  = 0.5;

    /**
     * Handle of an opened new sitemap file
     */
    private $_fileLink       = null;
    /**
     * Locale of getting data from source
     */
    private $_locale         = 'it-IT';

    /**
     * Collected cities data from the api of cities
     */
    private $_cities         = [];
    /**
     * Collected activities data from the api of activities
     */
    private $_activities     = [];

    /**
     * Constructor.
     *
     * Setup locale for the generator
     * 
     * @param string         $locale  Defined locale for the generator
     */
    public function __construct($locale = null)
    {
        $this->_locale   = $locale ?? 'it-IT';
    }

    /**
     * Get cities data from a musement api and prepare the data for a sitemap.
     * Get activites data from a musement api and prepare the data for a sitemap.
     * 
     * @param array             $queryOptions  Extra API url params
     * 
     * @return iGenerator
     */
    public function fetchData(array $queryOptions = []) : iGenerator
    {
     
        // Header for CURL
        $headers = [
            'accept: application/json',
            'content-type: application/json',
            'accept-language: ' . $this->_locale,
        ];

        $ch = curl_init();
        
        // Make a request to API to get cities
        $queryParams = http_build_query($queryOptions);
        curl_setopt($ch, CURLOPT_URL, self::URL_CITIES . '?' . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $cities = json_decode(curl_exec($ch), true);

        // Collect data from responce that sitemap file needs
        foreach ($cities as $city) {
            $this->_cities[] = $city['url'];
            
            // Make a request to API to get activities of each city
            curl_setopt($ch, CURLOPT_URL, str_replace('{city_id}', $city['id'], self::URL_ACTIVITIES) . '?' . $queryParams);
            $activitiesList = json_decode(curl_exec($ch), true);

            foreach ($activitiesList['data'] as $activity) {
                $this->_activities[] = $activity['url'];
            }
        }

        curl_close($ch);

        return $this;
    }

    /**
     * Make a handler and create a header for a new sitemap file.
     * 
     * @param string              $fileName  A name of a news sitemap file.
     * @return iGenerator
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function initFile(string $fileName) : iGenerator
    {
        $this->_fileHandle = fopen($fileName, 'w+');

        if ($this->_fileHandle === false) {
            throw new GeneratorException('Unable to open sitemap file "' . $fileName . '"', self::ERROR_CODE_UNABLE_OPEN_FILE);
        }

        $this->_safeWrite('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL);
        $this->_safeWrite('<!-- locale:' . $this->_locale . ' -->' . PHP_EOL);
        return $this;
    }

    /**
     * Write data about cities into a new sitemap file.
     * Write data about activities into a new sitemap file.
     * 
     * @return iGenerator
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function writeData() : iGenerator
    {
        foreach ($this->_cities as $cityUrl) {
            $this->_safeWrite('<url>' . PHP_EOL . 
            '   ' . '<loc>' . $cityUrl . '</loc>' . PHP_EOL .
            '   ' . '<lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL .
            '   <changefreq>monthly</changefreq>' . PHP_EOL .
            '   ' . '<priority>' . self::CITY_PRIORITY . '</priority>' . PHP_EOL .
            '</url>' . PHP_EOL);
        }

        foreach ($this->_activities as $activityUrl) {
            $this->_safeWrite('<url>' . PHP_EOL . 
            '   ' . '<loc>' . $activityUrl . '</loc>' . PHP_EOL .
            '   ' . '<lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL .
            '   <changefreq>monthly</changefreq>' . PHP_EOL .
            '   ' . '<priority>' . self::ACTIVITY_PRIORITY . '</priority>' . PHP_EOL .
            '</url>' . PHP_EOL);
        }

        return $this;
    }

    /**
     * Remove a handler for a new created sitemap file
     * 
     * @throws GeneratorException  if unable to write a data into the file
     */
    public function finalize() : void
    {
        $this->_safeWrite('</urlset>');
        fclose($this->_fileHandle);
    }

    /**
     * Write to resource and verify write result
     * 
     * @param string            $data  Data to be written
     * 
     * @throws GeneratorException  if unable to write a data
     */
    private function _safeWrite(string $data) : void
    {
        $writeResult = fwrite($this->_fileHandle, $data);

        if ($writeResult === false) {
            throw new GeneratorException('Unable to write data into sitemap file.', self::ERROR_CODE_UNABLE_TO_WRITE_FILE);
        }
    }
}
