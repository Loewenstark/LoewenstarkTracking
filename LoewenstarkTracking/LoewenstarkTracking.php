<?php

namespace LoewenstarkTracking;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;



/**
 * Shopware-Plugin LoewenstarkTracking.
 */
class LoewenstarkTracking extends Plugin
{

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('loewenstark_tracking.plugin_dir', $this->getPath());
        parent::build($container);
    }

	public function install(InstallContext $context)
	{
		$context->scheduleClearCache($this->getCacheArray());
		parent::install($context);
	}
 
	public function uninstall(UninstallContext $context)
	{
		$context->scheduleClearCache($this->getCacheArray());
		parent::uninstall($context);
	}
 
	public function activate(ActivateContext $context)
	{
		$context->scheduleClearCache($this->getCacheArray());
		parent::install($context);
	}
 
	public function deactivate(DeactivateContext $context)
	{
		$context->scheduleClearCache($this->getCacheArray());
		parent::install($context);
	}
 
	/**
	 * Get caches to clear
	 *
	 * @return array
	 */
	private function getCacheArray()
	{
		return [
			InstallContext::CACHE_TAG_CONFIG,
			InstallContext::CACHE_TAG_HTTP
		];
	}

	/**
     * subscribe on events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PreDispatch' => 'addTemplateDir',
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPostDispatch',
        ];
    }

    /**
     * Adds the Resources/view/  directory.
     *
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function addTemplateDir(\Enlight_Controller_ActionEventArgs $args)
    {
        $args->getSubject()->View()->addTemplateDir($this->getPath() . '/Resources/views');
    }

    /**
     * Read configuration and adds tracking codes to $view.
     *
     * @param \Enlight_Controller_EventArgs $args
     * @throws \Enlight_Exception
     */
    public function onPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        $shop = false;
        if ($this->container->initialized('shop')) {
            $shop = $this->container->get('shop');
        }
        if (!$shop) {
            $shop = $this->container->get('models')->getRepository(\Shopware\Models\Shop\Shop::class)->getActiveDefault();
        }
		$config = $this->container->get('shopware.plugin.cached_config_reader')->getByPluginName('LoewenstarkTracking', $shop);
		
		//debug
		//$config['ga_tracking_id'] = 'UA-12313';
		//$config['aw_tracking_id'] = 'AW-9595959';
		//$config['aw_tracking_phone_hash'] = 'fg4f46gf56df';
		//$config['aw_tracking_number'] = '05374 123456';
		//$config['aw_tracking_order_hash'] = 'g4g5g5g5g5g5g5';
		//$config['fb_tracking_id'] = '13123123123';
		//$config['additional_tracking'] = 'ADD TRACK!!';

        $trackingID = [
            'GaTrackingId' => $this->checkConfig($config['ga_tracking_id']),                     // Google Analytics
            'AwTrackingId' => $this->checkConfig($config['aw_tracking_id']),                     // Google Adwords Global
            'AwTrackingPhoneHash' => $this->checkConfig($config['aw_tracking_phone_hash']),      // Google Adwords Phone Conversion Tracking
			'AwTrackingNumber' => $this->checkConfig($config['aw_tracking_number']),             // Phone Number to Replace
			'AwTrackingOrderHash' => $this->checkConfig($config['aw_tracking_order_hash']),      // Google Adwords Order Conversion Tracking
            'FbTrackingId' => $this->checkConfig($config['fb_tracking_id']),                     // Facebook Pixel ID
            'AdditionalTracking' =>$this->checkConfig($config['additional_tracking']),           // Additional Tracking Code
        ];
        $controller = $args->getSubject();
        $view = $controller->View();
        $view->assign('loewenstarkTracking', $trackingID);
	}
	
	/**
     * checking if config is set, returns configuration
     *
     * @param $config
     * @return bool / string
     */
    private function checkConfig($config){
        if ($config !== null && $config !== 'none' && $config !== '<br/>'){
            return ($config);
        } else {
            return false;
        }
    }
}
