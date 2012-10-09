<?php

class Task
{
    private $properties;
    private $events;

    public function __construct(\Nette\Database\Table\ActiveRow $taskRecord, \Nette\Database\Table\Selection $eventRecords)
    {
        $this->properties = $taskRecord->toArray();

        foreach($eventRecords as $eventRecord)
        {
            $this->events[] = $eventRecord;
        }

        $this->properties['is_started'] = count($this->events[0]) > 0 && $this->events[0]->event == 'start';
    }

    public function __get($property)
    {
        if(! isset($this->properties[$property]))
        {
            throw new Exception("Undefined task property '" . $property . "'");
        }

        return $this->properties[$property];
    }
}
