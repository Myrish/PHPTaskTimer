<?php

class TaskPresenter extends BasePresenter
{
    private $taskModel;

    public function startup()
    {
        parent::startup();

        $this->taskModel = $this->getService('taskModel');
    }

    public function createComponentAddForm()
    {
        $form = new \Nette\Application\UI\Form;

        $form->addText('name', 'Task name');
        $form->addSubmit('add', 'Add');

        $form->onSuccess[] = callback($this->addTaskSubmitted);

        return $form;
    }

    public function addTaskSubmitted($form)
    {
        $values = $form->getValues();

        $this->taskModel->addTask($values);

        $this->redirect('list');
    }

    public function handleRefresh()
    {
        if($this->isAjax())
        {
            $this->invalidateControl('tasklist');
        }
    }

    public function actionStart($id)
    {
        $this->taskModel->startTask($id);

        if($this->isAjax())
        {
            $this->invalidateControl('tasklist');
            $this->view = 'list';
        }
        else
        {
            $this->redirect('list');
        }
    }

    public function actionStop($id)
    {
        $this->taskModel->stopTask($id);

        if($this->isAjax())
        {
            $this->invalidateControl('tasklist');
            $this->view = 'list';
        }
        else
        {
            $this->redirect('list');
        }
    }

    public function renderAdd()
    {
        
    }

    public function renderList()
    {
        $tasks = $this->taskModel->getTasks();

        $this->template->tasks = $tasks;
    }
}
