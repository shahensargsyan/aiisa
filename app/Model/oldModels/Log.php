<?php
class Log extends AppModel{
    public function addLog($data = array()){
        try {
            if(empty($data))
                throw new Exception ('No data passed');
            $saveData['type'] = $data['type'];
            $saveData['user_ip'] = $data['user_ip'];
            $save = $this->save($data);
            if(!$save)
                throw new Exception ('Cant save');
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
?>
