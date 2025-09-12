<?php
// 代码生成时间: 2025-09-13 00:20:57
class WebContentScraper {

    /**
     * Constructor to initialize the CodeIgniter instance
     */
    public function __construct() {
        // Get the CI instance
        $this->ci =& get_instance();
    }

    /**
     * Fetches content from a given URL
     *
     * @param string $url The URL to scrape content from
     * @return mixed Content of the URL or false on error
     */
    public function fetchContent($url) {
        try {
            // Use cURL to fetch the content
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                // Handle cURL error
                $this->ci->load->library('logger');
                $this->ci->logger->error('Error fetching content: ' . curl_error($ch));
                return false;
            }

            // Decode HTML entities and convert to UTF-8
            $response = html_entity_decode($response, ENT_QUOTES, 'UTF-8');

            // Use DOMDocument to parse the HTML content
            $dom = new DOMDocument();
            @$dom->loadHTML($response); // Suppress warnings for invalid HTML
            $dom->preserveWhiteSpace = false;

            // Remove any unwanted elements or attributes
            $this->cleanupDOM($dom);

            // Return the cleaned HTML content
            return $dom->saveHTML();
        } catch (Exception $e) {
            // Handle any other exceptions
            $this->ci->load->library('logger');
            $this->ci->logger->error('Error fetching content: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Removes unwanted elements and attributes from the DOM
     *
     * @param DOMDocument $dom The DOMDocument instance to clean
     */
    private function cleanupDOM(DOMDocument $dom) {
        // Remove script and style elements
        $scripts = $dom->getElementsByTagName('script');
        for ($i = $scripts->length - 1; $i >= 0; --$i) {
            $scripts->item($i)->parentNode->removeChild($scripts->item($i));
        }
        $styles = $dom->getElementsByTagName('style');
        for ($i = $styles->length - 1; $i >= 0; --$i) {
            $styles->item($i)->parentNode->removeChild($styles->item($i));
        }

        // Remove any inline JavaScript and CSS
        $this->removeInlineScriptsAndStyles($dom);
    }

    /**
     * Removes inline JavaScript and CSS from the DOM
     *
     * @param DOMDocument $dom The DOMDocument instance to clean
     */
    private function removeInlineScriptsAndStyles(DOMDocument $dom) {
        $xpath = new DOMXPath($dom);
        $attributesToRemove = ['onload', 'onerror', 'onclick', 'onmouseover', 'onmouseout', 'style'];
        foreach ($attributesToRemove as $attribute) {
            $nodes = $xpath->query('//*[@' . $attribute . ']');
            foreach ($nodes as $node) {
                $node->removeAttribute($attribute);
            }
        }
    }
}
