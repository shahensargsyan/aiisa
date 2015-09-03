<?php
    class BlockedIp extends AppModel{
        public $validate = array(
          'ip_address' => array(
              'ip' => array(
                  'rule' => 'ip',
                  'message' => 'You must enter an IP address'
              ),
              'unique' => array(
                  'rule' => 'isUnique',
                  'required' => 'create',
                  'message' => 'This IP address already exists'
              ),
            'reason' => array(
                'rule' => 'notEmpty',)          
          )
      );
}
?>