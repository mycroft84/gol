<?php
/**
 * Created by PhpStorm.
 * User: Tibi
 * Date: 2017.02.01.
 * Time: 13:48
 */
class Kohana_Gol_Parser
{
    protected $groups = array();
    protected $inGroup = false;

    protected $tempGroup = array();
    protected $board_width = array(
        'min'=>0,
        'max'=>0
    );
    protected $board_height = array(
        'min'=>0,
        'max'=>0
    );

    protected $board = array(
        'width'=>0,
        'height'=>0
    );

    protected $center = array(
        "x"=>0,
        "y"=>0,
    );

    protected $alives = array();

    public static function factory($file)
    {
       return new Gol_Parser($file);
    }

    public function __construct($file)
    {
       if(!is_file($file)) return false;

       $this->parseFile($file);
    }

    public function getData()
    {
        return array(
            'board'=>$this->board,
            'alives'=>$this->alives
        );
    }

    protected function parseFile($file)
    {
        $this->readFileByRows($file);
        $this->calcBoardSize();
        $this->calcAlives();
    }

    protected function readFileByRows($file)
    {
        $content = file_get_contents($file);
        $rows = explode("\n",$content);

        foreach ($rows as $row) {
            if (strpos($row,'#P') !== false) {
                if ($this->inGroup) {
                    $this->groups[] = $this->tempGroup;
                }

                $offsets = explode(' ',trim(str_replace('#P ','',$row)));
                $this->tempGroup = array(
                    'offset_x'=>$offsets[0],
                    'offset_y'=>$offsets[1],
                    'alives'=>array()
                );
                $this->inGroup = true;

            } elseif(strpos($row,'#') === false) {

                $temp = array();
                for($i=0;$i<strlen($row);$i++) {
                    if ($row[$i] == '*') {
                        $temp[] = $i + 1;
                    }
                }

                $this->tempGroup['alives'][] = $temp;
            }
        }
    }

    protected function calcBoardSize()
    {
        foreach ($this->groups as $item) {
            if ($item['offset_x'] < 0) {
                if ($this->board_width['min'] > $item['offset_x']) {
                    $this->board_width['min'] = $item['offset_x'];
                }
            } else {
                if ($this->board_width['max'] < $item['offset_x']) {
                    $this->board_width['max'] = $item['offset_x'];
                }
            }

            if ($item['offset_y'] < 0) {
                if ($this->board_height['min'] > $item['offset_y']) {
                    $this->board_height['min'] = $item['offset_y'];
                }
            } else {
                if ($this->board_height['max'] < $item['offset_y']) {
                    $this->board_height['max'] = $item['offset_y'];
                }
            }
        }

        $this->board['width'] = abs($this->board_width['min']) + abs($this->board_width['max']);
        $this->board['height'] = abs($this->board_height['min']) + abs($this->board_height['max']);

        if ($this->board['width'] % 2) $this->board['width']++;
        if ($this->board['height'] % 2) $this->board['height']++;

        $this->center['x'] = $this->board['width'] / 2;
        $this->center['y'] = $this->board['height'] / 2;
    }

    protected function calcAlives()
    {
        foreach ($this->groups as $item) {
            $start_x = $this->center['x'] + $item['offset_x'];
            $start_y = $this->center['y'] + $item['offset_y'];

            foreach ($item['alives'] as $index=>$alives)
            {
                foreach ($alives as $alive) {
                    $this->alives[] = ($start_x + $alive)."-".($start_y + $index);
                }
            }
        }
    }
}