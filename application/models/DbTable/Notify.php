<?php

class Application_Model_DbTable_Notify extends Application_Model_DbTable_Abstract
{

    protected $_name = 'notify';

    public function getActiveList($count = '', $start = ''){


        /**
         * getActiveList method
         *
         * Method to get active notify letters
         *
         * @param $count  (int) limit num
         * @param $start  (int) limit start
         *
         * @return (array) businesses data
         */

        $data = $this   ->select()
                        ->from($this->_name)
                        ->limit($start, $count);

        return $data->query()->fetchAll();


    }



}

