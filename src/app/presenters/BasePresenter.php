<?php

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->registerHelper('timeRep', function($secs) {
            $time = mktime(0, 0, 0, 1, 1, 2012) + $secs;
            return date("H:i:s", $time);
        });

        return $template;
    }
}
