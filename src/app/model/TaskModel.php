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

    public function getTasks($id = "")
    {
        $taskRecords = $this->connection->table('task');

        if(! empty($id))
        {
            $taskRecords = $taskRecords->where('id', $id);
        }

        $tasks = array();
        foreach($taskRecords as $taskRecord)
        {
            $eventRecords = $this->connection->table('task_event')->where('task_id', $taskRecord->id)->order('time DESC');

            $tasks[] = new Task($taskRecord, $eventRecords);
        }

        return $tasks;
    }

    public function getTask($id)
    {
        $tasks = $this->getTasks($id);
        $task = count($tasks) > 0 ? $tasks[0] : null;

        return $task;
    }

    public function startTask($id)
    {
        $task = $this->getTask($id);

        if(count($task->events) == 0 || $task->events[0]->event == 'stop')
        {
            $this->connection->table('task_event')->insert(
                array(
                    'task_id' => $id,
                    'time' => time(),
                    'event' => 'start'
                )
            );
        }
    }

    public function stopTask($id)
    {
        $task = $this->getTask($id);

        \Nette\Diagnostics\Debugger::barDump($task, "taaask");
        if(count($task->events) > 0 && $task->events[0]->event == 'start')
        {
            $this->connection->table('task_event')->insert(
                array(
                    'task_id' => $id,
                    'time' => time(),
                    'event' => 'stop'
                )
            );
        }
    }
}
