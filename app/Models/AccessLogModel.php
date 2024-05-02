<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;
use Vanier\Api\Helpers\DateTimeHelper;

/**
 * A class that is used for logging user actions.
 *
 * @author frostybee
 */
class AccessLogModel extends BaseModel
{

    private $table_name = "ws_log";

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Adds to the access log table an entry containing information about the current user's action
     * For example, what resource has been invoked, by what account, and at what date and time...
     * 
     * @param array $account_data The account data to be logged in the DB.
     * @return int the newly generated id of the access log entry.
     */
    public function createLogEntry($account_data, $user_action)
    {
        $log_data["user_id"] = $account_data["id"];
        $log_data["email"] = $account_data["email"];
        $log_data["user_action"] = $user_action;
        $log_data["logged_at"] = DateTimeHelper::getDateAndTime(DateTimeHelper::M_D_Y_H_M_S);
        return $this->insert($this->table_name, $log_data);
    }
}
