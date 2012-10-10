<?php

class ActionsPanel extends \Nette\Object implements \Nette\Diagnostics\IBarPanel
{
    private $template;
    private $actions;
    private $request;

    public function __construct(\Nette\Http\Request $request)
    {
        $this->template = $this->createTemplate($request);
        
        $this->request = $request;
    }

    public function createTemplate(\Nette\Http\Request $request)
    {
        $template = new \Nette\Templating\FileTemplate;

        $latte = new \Nette\Latte\Engine();
        $set = \Nette\Latte\Macros\MacroSet::install($latte->getCompiler());
		$set->addMacro('src', NULL, NULL, 'echo \'src="\'.\Nette\Templating\Helpers::dataStream(file_get_contents(%node.word)).\'"\'');
		$set->addMacro('stylesheet','echo \'<style type="text/css">\'.file_get_contents(%node.word).\'</style>\'');
        $set->addMacro('action-href', NULL, NULL, function($node, $writer) use($request) {
            $query = $request->getQuery();
            $query['actions-panel-run-action'] = "";
            $url = clone $request->getUrl();
            $url->setQuery($query);
            return $writer->write('echo \' href="' . (string) $url . '\' . ' . $node->args . ' . \'"\'');
        });

        $template->registerFilter($latte);

        $template->basePath = realpath(__DIR__);

        return $template;
    }

    public function runAction(\Nette\Http\Request $request)
    {
        \Nette\Diagnostics\Debugger::barDump($request->getQuery(),"query");
        $actionToRun = $request->getQuery('actions-panel-run-action', null);
        \Nette\Diagnostics\Debugger::barDump($actionToRun, "action to run");

        if(! is_null($actionToRun))
        {
            \Nette\Diagnostics\Debugger::barDump($actionToRun, "action to run");
            \Nette\Diagnostics\Debugger::barDump($this->actions, "actions");
            if(isset($this->actions[(int) $actionToRun]))
            {
                $action = $this->actions[$actionToRun];
                call_user_func_array($action['callback'], $action['params']);
            }

            $this->redirect($request);
        }
    }

    public function addAction($name, $callback, $params = array())
    {
        $this->actions[] = array(
            'name' => $name,
            'callback' => $callback,
            'params' => $params
        );
        \Nette\Diagnostics\Debugger::barDump($this->actions, "actions");
    }

    public function redirect(\Nette\Http\Request $request)
    {
        $response = new \Nette\Http\Response;

        $query = $request->getQuery();
        unset($query['actions-panel-run-action']);

        $url = clone $request->getUrl();
        $url->setQuery($query);

        $response->redirect($url);
    }

    public function getTab()
    {
        $this->template->setFile(__DIR__ . "/templates/tab.latte");
		return $this->template;
    }

    public function getPanel()
    {
        $this->template->setFile(__DIR__ . "/templates/panel.latte");
        $this->template->actions = $this->actions;
		return $this->template;
    }

    public function clearCache(\Nette\Caching\IStorage $cacheStorage)
    {
        $cacheStorage->clean(array(\Nette\Caching\Cache::ALL => true));
    }
}
