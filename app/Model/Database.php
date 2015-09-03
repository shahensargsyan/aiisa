<?php

class Database extends AppModel {

    public $validate = array(
        'title' => array(
            'rule' => array('maxLength', 255),
            'message' => 'title must be no larger than 255 characters long.'
        ),
        'path' => array(
            'rule' => 'notEmpty'
        )
    );

    public function paginateCount($conditions, $recursive, $extra) {
        if ($extra['queryId'] == 1) {
            $query = 'SELECT `Database`.* '
                    . 'FROM `databases` AS `Database` '
                    . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Database`.`topic_id`) '
                    . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `Database`.`topic_id`)'
                    . 'WHERE 1=1 ' . $conditions
                    . ' ORDER BY `Database`.`id` DESC ';
            $p = $this->query($query);
            return count($p);
        }

    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra) {
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;

     
        if ($extra['queryId'] == 1) {
            $query = 'SELECT `Database`.*, `Topic`.`name` '
                    . 'FROM `databases` AS `Database` '
                    . 'LEFT JOIN `topics` AS `Topic` ON (`Topic`.`id` = `Database`.`topic_id`) '
                    . 'LEFT JOIN `regions` AS `Region` ON (`Region`.`id` = `Database`.`topic_id`)'
                    . 'WHERE 1=1 ' . $conditions
                    . ' ORDER BY `Database`.`id` DESC '
                    . 'LIMIT ' . $offset . ', ' . $limit;
            $p = $this->query($query);
            return $p;
        }
      
    }
}
