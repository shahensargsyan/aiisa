<?php

class Event extends AppModel {

    public $name = "Event";
    
    public $validate = array(
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'content cannot be empty'
        ),
        'event_type' => array(
            'rule' => 'numeric',
            'message' => 'content cannot be empty'
        ),
         'title' => array(
            'rule' => 'notEmpty',
            'message' => 'title cannot be empty'
        ),
         'event_date' => array(
            'rule' => 'notEmpty',
            'message' => 'event_date cannot be empty'
        ),
         'from_time' => array(
            'rule' => 'notEmpty',
            'message' => 'from_time cannot be empty'
        ),
         'to_time' => array(
            'rule' => 'notEmpty',
            'message' => 'to_time cannot be empty'
        ),
         'location' => array(
            'rule' => 'notEmpty',
            'message' => 'location cannot be empty'
        ),
         'participants' => array(
            'rule' => 'notEmpty',
            'message' => 'participants cannot be empty'
        ),
         'overview' => array(
            'rule' => 'notEmpty',
            'message' => 'overview cannot be empty'
        ),
         'email' => array(
            'rule' => 'notEmpty',
            'message' => 'email cannot be empty'
        ),
    );
    public function paginateCount($conditions, $recursive, $extra){
        if($extra['queryId'] == 1){
            $query = 'SELECT `Event`.*
                FROM `events` AS `Event`
                LEFT JOIN `topics` AS `Topic`
                  ON (`Topic`.`id` = `Event`.`topic_id`)
                LEFT JOIN .`regions` AS `Region`
                  ON (`Region`.`id` = `Event`.`topic_id`)
                 WHERE  `Event`.`active` = 1  ' . $conditions;

           $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 2){
            $query = 'SELECT `Event`.* '
                    . 'FROM `events` AS `Event` '
                    . 'LEFT JOIN `event_types` AS `EventType` ON (`EventType`.`id` = `Event`.`event_type`) '
                    . 'WHERE `Event`.`active` = 1 AND `Event`.`event_date`<NOW() AND '
                    . $conditions;

           $p = $this->query($query);
            return count($p);
        }
        if($extra['queryId'] == 3){
            $query = 'SELECT `Event`.* '
                    . 'FROM `events` AS `Event` '
                    . 'WHERE `Event`.`active` = 1'
                    . $conditions;

           $p = $this->query($query);
            return count($p);
        }
    }

    public function paginate($conditions, $fields, $order, $limit, $page, $recursive, $extra){
        $pageNumber = $page - 1;
        $pageNumber = ($pageNumber < 0) ? 0 : $pageNumber;
        $offset = $pageNumber * $limit;

        if($extra['queryId'] == 1){
            $query = 'SELECT `Event`.*, `EventType`.`name` '
                    . 'FROM `events` AS `Event` '
                    . 'LEFT JOIN `event_types` AS `EventType` ON (`EventType`.`id` = `Event`.`event_type`) '
                    . 'WHERE `Event`.`active` = 1 '.$conditions
                    . ' ORDER BY `Event`.`id` DESC '
                    . ' LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
        if($extra['queryId'] == 2){
            $query = 'SELECT
                        `Event`.`title`,
                        `Event`.`id`,
                        `Event`.`photo`,
                        `Event`.`photo_by`,
                        `Topic`.`name`
                      FROM `events` AS `Event`
                        LEFT JOIN `topics` AS `Topic`
                          ON (`Topic`.`id` = `Event`.`topic_id`)
                        LEFT JOIN `regions` AS `Region`
                          ON (`Region`.`id` = `Event`.`topic_id`)
                      WHERE `Event`.`active` = 1 AND `Event`.`event_date`<NOW() AND  '.$conditions.'
                      ORDER BY `Event`.`id` ASC 
                      LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
        if($extra['queryId'] == 3){
            $query = 'SELECT
                        `Event`.*
                      FROM `events` AS `Event`
                      WHERE `Event`.`active` = 1
                      ORDER BY `Event`.`id` ASC 
                      LIMIT '.$offset.', '.$limit;
           $p = $this->query($query);
           return $p;
        }
    }
    
    public function getEventCount($conditions){
        $query = 'SELECT  COUNT(*) AS `count` '
                . 'FROM `events` AS `Event` '
                . 'WHERE `Event`.`active` = 1 '.$conditions;

        $p = $this->query($query);
        return $p[0][0]["count"];
    }

}

