<?php
namespace ResourceTrackerSolution\Workflow\Model;
/**
 * Class BusinessProcess
 * @package ResourceTrackerSolution\Workflow\Model
 * eg. Administration
 * Banking
 * Compliance
 * http://simplicable.com/new/business-process-examples
 */

class BusinessProcess
{
    public $id;
    public $next_process_id;
    public $name;
    public $description;
    public $status;
    public $create_date;
    public $create_user_id;

    public function __toString()
    {
        return get_class($this);
    }
}

/**
 * Class Event
 * @package ResourceTrackerSolution\Workflow\Model
 */
class Event
{
    public $id;
    public $next_event_id;
    public $name;
    public $description;
    /**
     * @var
     * eg. Insurance Claim, Onboarding
     */
    public $type;

    public static function create($event_name, $transaction_name, $details, $date)
    {

    }
}

class ProcessEvent
{
    public $id;
    public $business_process_id;
    public $event_id;

}

/**
 * Class Transaction
 * @package ResourceTrackerSolution\Workflow\Model
 * aka circulation
 */
class Transaction
{
    public $id;
    public $name;
    /**
     * @var
     * eg Make a Claim
     * Recieve a Payment
     */
    public $type;
    public $description;
}

/**
 * Class ActualEvent
 * @package ResourceTrackerSolution\Workflow\Model
 * aka slot
 */
class ActualEvent
{
    public $id;
    public $process_event_id;
    public $transaction_id;
    /**
     * @var
     * eg. OK, Done
     */
    public $status;

    public static function create($event_name, $transaction_name, $details, $date)
    {

    }
}


class UserInActualEvent
{
    public $user_id;
    public $actual_event_id;
    public $start_date;
    public $end_date;
}

$event = Event::create('Insurance Claim 1', 'description', "Insurance Claim (type)", $date);
$event->addProcess('process 1', array('user 1', 'user 2'), $form );
$event->addProcess('process 2', array('user 1', 'user 2'), $form );

