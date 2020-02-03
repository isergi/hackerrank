<?php

namespace SitemapTool\Generator;

interface iGenerator
{
    /**
     * Get and prepare sitemap data from a source.
     * 
     * @return iGenerator
     */
    public function fetchData(array $queryOptions = []) : iGenerator;

    /**
     * Make a handler and create a header for a new sitemap file.
     * 
     * @param string              $fileName  A name of a news sitemap file.
     * @return iGenerator
     */
    public function initFile(string $fileName) : iGenerator;

    /**
     * Write data into a new sitemap file.
     * 
     * @return iGenerator
     */
    public function writeData() : iGenerator;

    /**
     * Cleanup generator resources
     * 
     */
    public function finalize() : void;
}
