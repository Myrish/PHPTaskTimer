<?php

class Task
{
    private $properties;
    private $events;

    public function __construct(\Nette\Database\Table\ActiveRow $taskRecord, \Nette\Database\Table\Selection $eventRecords)
    {
        $this->properties = $taskRecord->toArray();

        $this->properties['totalWorkTime'] = 0;

        $currentStop = time();
        foreach($eventRecords as $eventRecord)
        {
            if($eventRecord->event == 'start')
            {
                $this->properties['totalWorkTime'] += $currentStop - $eventRecord->time;
            }
            else
            {
                $currentStop = $eventRecord->time;
            }

            $this->events[] = $eventRecord;
        }

        $this->properties['is_started'] = count($this->events[0]) > 0 && $this->events[0]->event == 'start';
    }

    public function __get($property)
    {
        if(isset($this->properties[$property]))
        {
            return $this->properties[$property];
        }
        elseif($property == 'events')
        {
            return $this->events;
        }
        else
        {
            throw new Exception("Undefined task property '" . $property . "'");
        }

    }
}
