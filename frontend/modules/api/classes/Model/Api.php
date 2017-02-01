<?php defined('SYSPATH') or die('No direct script access.');

class Model_Api extends Model
{
    public function getNextState(array $board,array $points)
    {
        $board = Gol_Board::factory($board['width'],$board['height']);
        $board->setLive($points);

        return $board->getNextStepLive();
    }
}