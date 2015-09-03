<?php
    class MembershipContract extends AppModel {
        public function contract($contract_id,$membership_id){
            $i = 0;
            foreach ($contract_id as $id){
                $contract[$i]['membership_id'] = $membership_id;
                $contract[$i]['contract_id'] = $id;
                $i++;
            }
            return $contract;
        }
    }
?>
