<?php
/**
 * User: tibi
 * Date: 2017.01.30.
 * Time: 17:19
 * Project: game
 * Company: d2c
 */

class Kohana_Gol_Cell {

	protected $x;
	protected $y;
	protected $key;
	protected $neighbours = array();
	protected $alive = false;
	protected $nextState = null;

	public static function factory($x,$y)
	{
		return new Gol_Cell($x,$y);
	}

	public function __construct($x,$y) {
		$this->x = $x;
		$this->y = $y;

		$this->key = $x."-".$y;
	}

	public function getX() {
		return $this->x;
	}

	public function getY() {
		return $this->y;
	}

	public function getKey() {
		return $this->key;
	}

	public function setAlive($alive)
	{
	    $this->alive = $alive;
	    return $this;
	}

	public function isAlive()
	{
	    return $this->alive;
	}

	public function setNeighbour(Gol_Cell $cell)
	{
	    $this->neighbours[$cell->getKey()] = $cell;
	}

    public function setNextState($state)
    {
        $this->nextState = $state;
        return $this;
	}

    public function updateFromNextState()
    {
        if ($this->nextState !== null) {
            $this->alive = $this->nextState;
            $this->nextState = null;
        }
	}

	/**
	 * @return array|Cell
	 */
	public function getNeighbours()
	{
	    return $this->neighbours;
	}

	public function __toString() {
		return ($this->alive) ? "  *" : "  -";
	}

}