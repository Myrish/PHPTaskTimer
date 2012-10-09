<?php

class TaskModel extends \Nette\Object
{
    private $connection;

    public function __construct(\Nette\Database\Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addTask($params)
    {
        $this->connection->table('task')->insert($params);
    }

    public function getTasks()
    {
        $taskRecords = $this->connection->table('task');

        $tasks = array();
        foreach($taskRecords as $taskRecord)
        {
            $eventRecords = $this->connection->table('task_event')->where('task_id', $taskRecord->id)->order('date_time DESC');

            $tasks[] = new Task($taskRecord, $eventRecords);
        }

        return $tasks;
    }

    public function getTaksEvents($id)
    {

        return $events;
    }
}
