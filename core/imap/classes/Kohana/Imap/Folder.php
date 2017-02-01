<?php
/**
 * User: Tibi
 * Date: 2015.09.17.
 * Time: 9:35
 * Project: enigma
 * Company: d2c
 */
class Kohana_Imap_Folder
{
    protected $imap = null;
    protected $folder = null;

    protected $order = SORTARRIVAL;
    protected $revers = 1;

    public static function factory(Imap $imap)
    {
        $folder = new Imap_Folder();
        $folder->imap = $imap;

        return $folder;
    }

    public function setImap(Imap $imap)
    {
        $this->imap = $imap;
        return $this;
    }

    public function listFolders()
    {
        $list = imap_list($this->imap->getConnection(), $this->imap->getServer(), "*");

        $result = array();
        if (is_array($list)) {
            foreach ($list as $val) {
                $result[] = str_replace($this->imap->getServer(),'',mb_convert_encoding($val,"UTF-8","UTF7-IMAP"));
            }
        } else {
            throw new Exception("imap_list failed: " . imap_last_error());
        }

        return $result;
    }

    public function setFolder($name)
    {
        $name = mb_convert_encoding($name,"UTF7-IMAP","UTF-8");
        $this->folder = $name;

        $this->imap->setFolder($this);
        $this->imap->reconnect();

        return $this;
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public function createFolder($name)
    {
        $name = mb_convert_encoding($name,"UTF7-IMAP","UTF-8");
        if (@imap_createmailbox($this->imap->getConnection(), $this->imap->getServer().$name))
        {
            $this->folder = $name;
            return true;
        } else {
            $this->folder = null;
            return false;
        }
    }

    public function renameFolder($new_name, $old_name = null)
    {
        $old_name = ($old_name) ? mb_convert_encoding($old_name,"UTF7-IMAP","UTF-8") : $this->folder;
        $new_name = mb_convert_encoding($new_name,"UTF7-IMAP","UTF-8");

        if (!@imap_renamemailbox($this->imap->getConnection(), $this->imap->getServer().$old_name, $this->imap->getServer().$new_name)) return false;

        if ($old_name == null) $this->folder = $new_name;
        return true;
    }

    public function deleteFolder($name = null)
    {
        $name = ($name) ? mb_convert_encoding($name,"UTF7-IMAP","UTF-8") : $this->folder;

        if (!@imap_deletemailbox ( $this->imap->getConnection(), $this->imap->getServer().$name)) return false;

        if ($name == null) $this->folder = '';
        return true;
    }

    public function getMessageList($offset = false, $limit = false)
    {
        $check = $this->imap->checkConnection();

        $start = ($offset) ? $offset : 0;
        $end = ($limit) ? $start + $limit-1 : 0;

        $result = Kohana_Imap_Messageslist::factory();
        $result->start = ($start == 0) ? 1 : $start;
        $result->end = ($end == 0) ? $check->Nmsgs : $end;
        $result->order = $this->order;
        $result->revers = $this->revers;

        $messages = imap_sort($this->imap->getConnection(),$this->order,$this->revers,SE_UID);
        if ($offset and $limit) $messages = array_slice($messages,$offset-1,$limit);
        foreach($messages as $item)
        {
            $ms = Imap_Message::factory($this->imap,$item);
            $result->addMessage($ms);
        }

        return $result;
    }

    public function search($target = 'UNSEEN')
    {
        $target = mb_convert_encoding($target,"UTF7-IMAP","UTF-8");
        $emails = imap_search($this->imap->getConnection(), $target, SE_UID);

        $result = Kohana_Imap_Messageslist::factory();

        if (is_array($emails)) {
            foreach ($emails as $item) {
                $ms = Imap_Message::factory($this->imap,$item);
                $result->addMessage($ms);
            }
        }

        return $result;
    }

    /**
     * SORTDATE - message Date
     * SORTARRIVAL - arrival date
     * SORTFROM - mailbox in first From address
     * SORTSUBJECT - message subject
     * SORTTO - mailbox in first To address
     * SORTCC - mailbox in first cc address
     * SORTSIZE - size of message in octets
     */
    public function setOrder($order = SORTDATE, $revers = true)
    {
        $this->order = $order;
        $this->revers = (int) $revers;

        return $this;
    }
}