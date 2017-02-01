<?php
/**
 * User: MyCroft
 * Company: design2code.hu
 * Product: d2cadmin
 * Date: 2013.05.11.
 * Time: 11:29
 */
class Model_Board extends ORM {

    protected $_table_name = 'boards';
    protected $_primary_key = 'bo_id';

    protected $_has_many = array(
        'points'=>array(
            'model'=>'Board_Alives',
            'foreign_key'=>'boal_bo_id'
        )
    );

    public function addBoard($post)
    {
        try {
            $board = ORM::factory('Board', $post['list']);
            if (!$board->loaded()) {
                $board = ORM::factory('Board');
            }

            $board->bo_name = $post['name'];
            $board->bo_width = $post['board']['width'];
            $board->bo_height = $post['board']['height'];
            $board->save();

            $board->addPoints($post['alives']);

            return array('error' => false, 'id' => $board->pk(), 'name' => $board->bo_name);
        } catch (Exception $e) {
            return array('error' => true, 'message' => $e->getMessage());
        }
    }

    protected function addPoints(array $alives)
    {
        DB::delete('board_alives')->where('boal_bo_id','=',$this->pk())->execute();

        foreach ($alives as $item) {
            $coords = explode("-",$item);

            $point = ORM::factory('Board_Alives');
            $point->boal_bo_id = $this->pk();
            $point->boal_x = $coords[0];
            $point->boal_y = $coords[1];
            $point->save();
        }
    }

    public function loadBoard($id)
    {
        try {
            $board = ORM::factory('Board', $id);
            if (!$board->loaded()) return array('error' => true);

            return array(
                'error' => false,
                'board' => array(
                    'width' => $board->bo_width,
                    'height' => $board->bo_height
                ),
                'alives' => $board->getAlives()
            );
        } catch (Exception $e) {
            return array(
                'error' => false,
                'message'=>$e->getMessage()
            );
        }
    }

    protected function getAlives()
    {
        $query = DB::select(
                array(DB::expr('CONCAT_WS("-",boal_x,boal_y)'),'alives')
            )
            ->from('board_alives')
            ->where('boal_bo_id','=',$this->pk())
            ->execute()->as_array();

        $query = array_map(function ($item){
            return $item['alives'];
        },$query);

        return $query;
    }
}