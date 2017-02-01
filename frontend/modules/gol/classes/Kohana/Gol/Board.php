<?php
/**
 * User: tibi
 * Date: 2017.01.30.
 * Time: 17:13
 * Project: game
 * Company: d2c
 */

class Kohana_Gol_Board {

	protected $width;
	protected $height;
	protected $round = 1;

	protected $cells = array();
	protected $directions = array(
		array(-1, 1), array(0, 1), array(1, 1),
		array(-1, 0), array(1, 0),
		array(-1, -1), array(0, -1), array(1, -1)
    );

	public static function factory($width,$height) {
		return new Gol_Board($width,$height);
	}

	public function __construct($width,$height) {
		$this->width = $width + 1;
		$this->height = $height + 1;

		$this->initCells();
		$this->setNeighbours();
	}

	protected function initCells()
	{
		for ($i=1;$i <= $this->width;$i++) {
			for ($j=1;$j <= $this->height;$j++) {
				$cell = Gol_Cell::factory($i,$j);

				$this->addCell($cell);
			}
		}
	}

	public function addCell(Gol_Cell $cell)
	{
		$this->cells[$cell->getKey()] = $cell;
	}

	public function setNeighbours()
	{
		for ($i=1;$i <= $this->width;$i++) {
			for ($j=1;$j <= $this->height;$j++) {
				$cell = $this->getCell($i,$j);

				foreach ($this->directions as $direction) {
					$neighbour = $this->getCell($cell->getX() + $direction[0], $cell->getY() + $direction[1]);

					if ($neighbour) {
						$cell->setNeighbour($neighbour);
					}
				}
			}
		}
	}

	/**
	 * @param $x
	 * @param $y
	 *
	 * @return Gol_Cell|null
	 */
	public function getCell($x,$y)
	{
		$key = $x."-".$y;

		if (array_key_exists($key,$this->cells)) {
			return $this->cells[$key];
		}

		return null;
	}

	public function setLive(array $array)
	{
	    foreach ($array as $item) {
	        if (array_key_exists($item,$this->cells)) {
	        	$cell = $this->cells[$item];
	        	$cell->setAlive(true);
	        }
	    }
	}

	public function run()
	{
		while (true)
		{
            if ($this->round > 1) echo "\n";
			echo "Round: ".$this->round."\n";

			$this->printBoard();
			$this->updateBoard();

			$this->round++;
			sleep(1);

			if ($this->round > 5) exit;
		}


	}

	protected function printBoard()
	{
        echo "    ";
        for ($k=1;$k < $this->height;$k++) {
            echo " ".str_pad($k,3,'0',STR_PAD_LEFT);
        }
        echo "\n";
        
        for ($i=1;$i < $this->width;$i++) {
            echo str_pad($i,3,'0',STR_PAD_LEFT)." ";
			for ($j=1;$j < $this->height;$j++) {
				echo (string) " ".$this->getCell($i,$j);
			}
			echo "\n";
		}
	}

	protected function updateBoard()
	{
        foreach ($this->cells as $item) {
            $status = $this->getCellStatus($item);
            if ($status) {
                $item->setNextState(true);
            } else {
                $item->setNextState(false);
            }
		}

        foreach ($this->cells as $item) {
            $item->updateFromNextState();
        }
	}

	protected function getCellStatus(Gol_Cell $cell)
	{
		$alives = $this->countAlives($cell);

		if ($cell->isAlive()) {
		    if ($alives == 2 || $alives == 3) return 1;
        } else {
            if ($alives == 3) return 1;
        }

		if ($alives < 2 || $alives > 3) return 0;
	}

	protected function countAlives(Gol_Cell $cell)
	{
	    $num = 0;

	    foreach ($cell->getNeighbours() as $neighbour) {
	        if ($neighbour->isAlive()) $num++;
	    }

	    return $num;
	}

    protected function printDebug(array $data = array())
    {
        foreach ($data as $index => $value) {
            echo $index.": ".$value."\n";
        }
    }

    public function getNextStepLive()
    {
        $this->updateBoard();

        $result = array();
        foreach ($this->cells as $cell) {
            if ($cell->isAlive()) {
                $result[] = $cell->getKey();
            }
        }

        return $result;
    }
}