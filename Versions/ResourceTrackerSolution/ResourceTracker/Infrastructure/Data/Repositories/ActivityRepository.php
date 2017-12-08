<?php
namespace ResourceTrackerSolution\ResourceTracker\Infrastructure\Data\Repositories;


use ResourceTrackerSolution\ResourceTracker\Model\Activities\Activity;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\ActivityId;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\IActivityRepository;
use ResourceTrackerSolution\ResourceTracker\Model\Activities\User;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\DbContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\CodeIgniter\ResourceManagementContext;
use ResourceTrackerSolution\SharedDatabaseManagementTools\Model\ActivityType;
use ValueObjects\Person\Name;
use ValueObjects\StringLiteral\StringLiteral;

class ActivityRepository implements IActivityRepository
{
    private $context;

    public function __construct(ResourceManagementContext $context)
    {
        $this->context = $context;
    }

    public function add(Activity $entity)
    {
        $this->context->activities()->add($entity);
    }

    public function find(ActivityId $activityId)
    {
        return $this->context->activities()->find((string)$activityId);
    }

    public function fetch()
    {
        return $this->context->activities()->fetch();
    }

    public function update(Activity $activity)
    {
        $this->context->activities()->update($activity);
    }

    public function remove(ActivityId $activityId)
    {
        $this->context->activities()->remove($activityId);
    }

    public function findUser($id, $role)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('users u')
            ->join('roles r', 'u.role_id = r.id')
            ->where('u.id',$id)
            ->where('u.status','Active')
            ->where('LOWER(r.title)',strtolower($role))
            ->get()
            ->row(0,(string) $this->context->users());
    }

    public function findTypeName($name)
    {
        return $this->context
            ->db
            ->select('*')
            ->from('activity_type')
            ->where('title',$name)
            ->where('type','Activity')
            ->get()
            ->row(0,(string) $this->context->activityType());
    }

}