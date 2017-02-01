<?php
/**
 * User: MyCroft
 * Date: 2013.07.04.
 * Time: 17:53
 * Company: d2c
 */
class Kohana_Imap_Message
{
    protected $imap = null;
    protected $msgno = null;
    protected $uid = null;

    public $subject;
    public $from;
    public $to;
    public $cc;
    public $date;
    public $message_id;
    public $size;
    public $recent;
    public $flagged;
    public $answered;
    public $deleted;
    public $seen;
    public $draft;
    public $udate;

    public $bodyPlain;
    public $bodyHtml;
    public $attachment = array();

    public static function factory(Imap $imap,$ui_id)
    {
        $ms = new Kohana_Imap_Message();
        $ms->imap = $imap;
        $ms->uid = $ui_id;

        $ms->parseEmail();

        return $ms;
    }

    public function getUid()
    {
        return $this->uid;
    }

    protected function parseEmail()
    {
        $overview = imap_fetch_overview($this->imap->getConnection(),$this->uid, FT_UID);

        $headerfetch = imap_fetchheader($this->imap->getConnection(),$this->uid, FT_UID);
        $headers = imap_rfc822_parse_headers($headerfetch);
        //echo Debug::vars($headers);
        foreach((array) $overview[0] as $index=>$item)
        {
            //echo Debug::vars($index,$item);
            switch($index)
            {
                case 'subject':
                    $this->$index = imap_utf8($item);
                    break;

                case 'from':
                    $temp = array(
                        "name"=>(isset($headers->from[0]->personal)) ? imap_utf8($headers->from[0]->personal) : false,
                        "email"=>imap_utf8($headers->from[0]->mailbox."@".$headers->from[0]->host)
                    );
                    $this->$index = $temp;
                    break;

                case 'to':
                    if (!empty($headers->$index)) {
                        $temp = array();
                        foreach ($headers->$index as $ftc_key => $ftc_value) {
                            $temp[] = array(
                                "name"=>(isset($ftc_value->personal)) ? imap_utf8($ftc_value->personal) : false,
                                "email"=>imap_utf8($ftc_value->mailbox."@".$ftc_value->host)
                            );
                        }
                        $this->$index = $temp;
                    }
                    break;

                case 'date':
                    $this->$index = strtotime($item);
                    break;

                default: $this->$index = $item;
            }
        }
        //---Masolat-Cc-----------------------------------------------
        if (!empty($headers->cc)) {
            $cc_temp = array();
            foreach ($headers->cc as $cc_key => $cc_value) {
                $cc_temp[] = array(
                    "name"=>(isset($cc_value->personal)) ? imap_utf8($cc_value->personal) : false,
                    "email"=>imap_utf8($cc_value->mailbox."@".$cc_value->host)
                );
            }
            $this->cc = $cc_temp;
        }
        //------------------------------------------------------------

        //$this->loadBody();

        return $this;
    }

    public function loadBody()
    {
        $st = imap_fetchstructure($this->imap->getConnection(), $this->uid, FT_UID);
        //echo Debug::vars($st);

        if (isset($st->parts))
        {
            foreach($st->parts as $index=>$part)
            {
                if (isset($part->parts)) {
                    foreach($part->parts as $pIndex=>$pPart)
                    {
                        $this->parseBodyPart($pPart,($index+1).".".($pIndex+1));
                    }
                } else {
                    $this->parseBodyPart($part,$index+1);
                }
            }
        } else {
            $this->parseBodyPart($st,1);
        }
    }

    protected function getInfo()
    {
        return imap_headerinfo($this->imap->getConnection(),$this->uid);
    }

    protected function parseBodyPart($data,$partNum)
    {
        $body = imap_fetchbody($this->imap->getConnection(), $this->uid, $partNum, FT_UID);
        //echo Debug::vars($body,$partNum,$data);

        switch($data->subtype)
        {
            case 'PLAIN':
                if (!isset($data->disposition))
                    $this->bodyPlain = trim(self::convertCharset($this->encodeData($data->encoding,$body),$data->parameters));
                else if ($data->disposition == "ATTACHMENT") {
                    $this->attachment[] = Imap_Attachment::factory($data,$this->encodeData($data->encoding,$body));
                }
                break;

            case 'HTML':
                $this->bodyHtml = trim(self::convertCharset($this->encodeData($data->encoding,$body),$data->parameters,true));
                break;

            default:
                $this->attachment[] = Imap_Attachment::factory($data,$this->encodeData($data->encoding,$body));
                break;
        }
    }

    protected function encodeData($encodeType, $data)
    {
        switch($encodeType) {
            case 0: return $data; // 7BIT
            case 1: return $data; // 8BIT
            case 2: return $data; // BINARY
            case 3: return base64_decode($data); // BASE64
            case 4: return quoted_printable_decode($data); // QUOTED_PRINTABLE
            case 5: return $data; // OTHER
        }
    }

    protected function convertCharset($string,$params,$isHtml = false)
    {
        mb_internal_encoding('UTF-8');
        $charset = $this->getChatset($params);
        //if ($isHtml) $string = imap_qprint($string);
        //echo Debug::vars($string,$charset,mb_convert_encoding($string,'UTF-8',$charset));
        return trim(mb_convert_encoding($string,'UTF-8',$charset));
    }

    protected function getChatset($params)
    {
        $charset = "UTF-8";
        foreach($params as $value)
        {
            if ($value->attribute == "CHARSET") {
                $charset = $value->value;
            }
        }

        return $charset;
    }

    public function move($folder)
    {
        $folder = mb_convert_encoding($folder,"UTF7-IMAP","UTF-8");

        if (imap_mail_move($this->imap->getConnection(), $this->uid, $folder, CP_UID)) {
            imap_expunge($this->imap->getConnection());
            return true;
        }

        return false;
    }

    public function delete()
    {
        if (imap_delete($this->imap->getConnection(), $this->uid, FT_UID))
        {
            imap_expunge($this->imap->getConnection());
            return true;
        }

        return false;
    }

    public function setSeen()
    {
        return $this->setFullFlags('\\Seen');
    }

    public function setAnswered()
    {
        return $this->setFullFlags('\\Answered');
    }

    public function setFlagged()
    {
        return $this->setFullFlags('\\Flagged');
    }

    public function setDeleted()
    {
        return $this->setFullFlags('\\Deleted');
    }

    public function setDraft()
    {
        return $this->setFullFlags('\\Draft');
    }

    public function setUnseen()
    {
        return $this->clearFullFlags('\\Seen');
    }

    public function setUnanswered()
    {
        return $this->clearFullFlags('\\Answered');
    }

    public function setUnflagged()
    {
        return $this->clearFullFlags('\\Flagged');
    }

    public function setUndeleted()
    {
        return $this->clearFullFlags('\\Deleted');
    }

    public function setUndraft()
    {
        return $this->clearFullFlags('\\Draft');
    }

    protected function setFullFlags($flag)
    {
        if (imap_setflag_full($this->imap->getConnection(), $this->uid, $flag, ST_UID)) {
            imap_expunge($this->imap->getConnection());
            return true;
        }

        return false;
    }

    protected function clearFullFlags($flag)
    {
        if (imap_clearflag_full($this->imap->getConnection(), $this->uid, $flag, ST_UID)) {
            imap_expunge($this->imap->getConnection());
            return true;
        }

        return false;
    }

}