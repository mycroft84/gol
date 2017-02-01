<?php
/**
 * User: Tibor
 * Date: 2014.07.17.
 * Time: 15:56
 * Project: delina.hu
 * Company: d2c
 */
class SimpleXMLExtended extends SimpleXMLElement {

    public function addCData($cdata_text) {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
    }

    public function addCustomData($name,$value)
    {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createElement($name))->appendChild($no->createTextNode($value));
    }
}