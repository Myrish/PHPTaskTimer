<?php

class ImprovedContainerPanel extends \Nette\DI\Diagnostics\ContainerPanel
{
	public function getTab()
	{
		ob_start();
		require __DIR__ . '/templates/ContainerPanel.tab.phtml';
		return ob_get_clean();
	}
}
