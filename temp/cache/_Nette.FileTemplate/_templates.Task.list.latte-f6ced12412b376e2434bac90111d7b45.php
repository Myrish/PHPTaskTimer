<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.93371500 1349805053";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"/home/uiii/Pracoviste/Projekty/PHPTaskTimer/app/templates/Task.list.latte";i:2;i:1349805037;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"6a33aa6 released on 2012-10-01";}}}?><?php

// source file: /home/uiii/Pracoviste/Projekty/PHPTaskTimer/app/templates/Task.list.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2ua2iupjp0')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb9c6f22d61f_content')) { function _lb9c6f22d61f_content($_l, $_args) { extract($_args)
?><ul>
<?php $iterations = 0; foreach ($tasks as $task): ?>    <li>
        <span><?php echo Nette\Templating\Helpers::escapeHtml($task->name, ENT_NOQUOTES) ?></span>
        <span>
<?php if ($task->is_started): ?>
            <a href="<?php echo htmlSpecialChars($_control->link("stop", array($task->id))) ?>
">stop</a>
<?php else: ?>
            <a href="<?php echo htmlSpecialChars($_control->link("start", array($task->id))) ?>
">start</a>
<?php endif ?>
        </span>
    </li>
<?php $iterations++; endforeach ?>
</ul>

<a href="<?php echo htmlSpecialChars($_control->link("add")) ?>">Add task</a>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 