<?php defined('SYSPATH') OR die('No direct script access.');

class Feed extends Kohana_Feed {


    public static function create($info, $items, $encoding = 'UTF-8')
    {
        $info += array('title' => 'Generated Feed', 'link' => '', 'generator' => 'KohanaPHP');

        $feed = '<?xml version="1.0" encoding="'.$encoding.'"?><rss version="2.0" xmlns:d2c="' . Route::url('feedMod') . '"><channel></channel></rss>';
        //$feed = simplexml_load_string($feed);
        $feed = new SimpleXMLExtended($feed);

        foreach ($info as $name => $value)
        {
            if ($name === 'image')
            {
                // Create an image element
                $image = $feed->channel->addChild('image');

                if ( ! isset($value['link'], $value['url'], $value['title']))
                {
                    throw new Kohana_Exception('Feed images require a link, url, and title');
                }

                if (strpos($value['link'], '://') === FALSE)
                {
                    // Convert URIs to URLs
                    $value['link'] = URL::site($value['link'], 'http');
                }

                if (strpos($value['url'], '://') === FALSE)
                {
                    // Convert URIs to URLs
                    $value['url'] = URL::site($value['url'], 'http');
                }

                // Create the image elements
                $image->addChild('link', $value['link']);
                $image->addChild('url', $value['url']);
                $image->addChild('title', $value['title']);
            }
            else
            {
                if (($name === 'pubDate' OR $name === 'lastBuildDate') AND (is_int($value) OR ctype_digit($value)))
                {
                    // Convert timestamps to RFC 822 formatted dates
                    $value = date('r', $value);
                }
                elseif (($name === 'link' OR $name === 'docs') AND strpos($value, '://') === FALSE)
                {
                    // Convert URIs to URLs
                    $value = URL::site($value, 'http');
                }

                // Add the info to the channel
                $feed->channel->addChild($name, $value);

            }
        }

        foreach ($items as $item)
        {
            // Add the item to the channel
            $row = $feed->channel->addChild('item');

            foreach ($item as $name => $value)
            {
                if ($name === 'image')
                {
                    // Create an image element
                    $image = $row->addChild('image');

                    if ( ! isset($value['link'], $value['url'], $value['title']))
                    {
                        throw new Kohana_Exception('Feed images require a link, url, and title');
                    }

                    if (strpos($value['link'], '://') === FALSE)
                    {
                        // Convert URIs to URLs
                        $value['link'] = URL::site($value['link'], 'http');
                    }

                    if (strpos($value['url'], '://') === FALSE)
                    {
                        // Convert URIs to URLs
                        $value['url'] = URL::site($value['url'], 'http');
                    }

                    // Create the image elements
                    $image->addChild('link', $value['link']);
                    $image->addChild('url', $value['url']);
                    $image->addChild('title', $value['title']);
                }
                else
                {
                    if ($name === 'pubDate' AND (is_int($value) OR ctype_digit($value)))
                    {
                        // Convert timestamps to RFC 822 formatted dates
                        $value = date('r', $value);
                    }
                    elseif (($name === 'link' OR $name === 'guid') AND strpos($value, '://') === FALSE)
                    {
                        // Convert URIs to URLs
                        $value = URL::site($value, 'http');
                    }

                    if ($name !== 'description')
                    {
                        if (strpos($name,':') === false) {
                            $row->addChild($name, $value);
                        } else {
                            $row->addCustomData($name,$value);
                        }

                    } else {
                        $row->addChild($name)->addCData($value);
                    }
                }
            }
        }
        
        if (function_exists('dom_import_simplexml'))
        {
            // Convert the feed object to a DOM object
            $feed = dom_import_simplexml($feed)->ownerDocument;

            // DOM generates more readable XML
            $feed->formatOutput = TRUE;

            // Export the document as XML
            $feed = $feed->saveXML();
        }
        else
        {
            // Export the document as XML
            $feed = $feed->asXML();
        }

        return $feed;
    }

}
