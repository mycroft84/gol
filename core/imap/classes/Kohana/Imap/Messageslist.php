<?php
/**
 * User: MyCroft
 * Date: 2013.07.04.
 * Time: 18:09
 * Company: d2c
 */
class Kohana_Imap_Messageslist
{
    public $start;
    public $end;
    public $order;
    public $revers;

    public $messages = array();

    public static function factory()
    {
        $ms = new Kohana_Imap_Messageslist();
        return $ms;
    }

    public function addMessage(Kohana_Imap_Message $message)
    {
        $this->messages[] = $message;
        return $this;
    }

    public function getSeen()
    {
        return $this->checkSeenStatus(1);
    }

    public function getUnseen()
    {
        return $this->checkSeenStatus(0);
    }

    private function checkSeenStatus($type)
    {
        $result = array();
        foreach($this->messages as $item)
        {
            if ($item->seen == $type) $result[] = $item;
        }

        return $result;
    }
}