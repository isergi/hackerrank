<?php

namespace SitemapTool\Cli;

/**
 * "Console" is a tool of a command line interface.
 */
class Console extends \Commando\Command
{
    /**
     * Make initialization of a base commands and flags. 
     * Make a description and usage of a sitemap tool.
     */
    public function __construct()
    {
        // Base description and usage of the tool
        $this->setHelp(
            '      A tool that generates a sitemap for the site www.musement.com for a given locale' . PHP_EOL . 
            PHP_EOL . PHP_EOL .
            'USAGE: ' . 
            PHP_EOL . '      ./sitemap-tool -f [file ..] -g                  generate a new XML sitemap file' . 
            PHP_EOL . '      ./sitemap-tool -f [file ..] -g -l               generate a new XML sitemap file using specific locale' . 
            PHP_EOL . '      ./sitemap-tool -f [file ..] -e <emails>         send an XML sitemap file via email' . 
            PHP_EOL . PHP_EOL . PHP_EOL .
            'OPTIONS:'
        );
        
        $this->option('g')
             ->aka('generate')
             ->describedAs('Generate a new sitemap file.')
             ->boolean();
        
        $this->option('f')
             ->aka('file')
             ->describedAs('Path to the sitemap file.')
             ->require();
        
        $this->option('l')
             ->aka('locale')
             ->describedAs('Using locale to generate a sitemap file [it-IT, fr-FR, es-ES].')
             ->must(function($locale) {
                $localies = array('it-IT', 'fr-FR', 'es-ES');
                return in_array($locale, $localies);
            });
        
        $this->option('e')
             ->aka('emails')
             ->describedAs('Email list of recipients of the sitemap file. Use "," to set multiple recipients.');

        parent::__construct();
    }
}
