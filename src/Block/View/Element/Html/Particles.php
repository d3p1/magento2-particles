<?php
/**
 * @description Main block to add effect
 * @author      C. M. de Picciotto <d3p1@d3p1.dev> (https://d3p1.dev/)
 */
namespace D3p1\Particles\Block\View\Element\Html;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Particles extends Template
{
    /**
     * @var Json
     */
    protected Json $_json;

    /**
     * @var string
     */
    protected $_template = 'D3p1_Particles::js/particles.phtml';

    /**
     * Constructor
     *
     * @param Json    $json
     * @param Context $context
     * @param array   $data
     */
    public function __construct(
        Json    $json,
        Context $context,
        array   $data = []
    ) {
        $this->_json = $json;
        parent::__construct($context, $data);
    }

    /**
     * Get element ID
     *
     * @return string
     */
    public function getElementId(): string
    {
        return $this->getData('element_id');
    }

    /**
     * Is interactive flag
     *
     * @return bool
     */
    public function isInteractive(): bool
    {
        return $this->getData('is_interactive');
    }

    /**
     * Get configuration in JSON format
     *
     * @return string
     */
    public function getParticlesConfigJson(): string
    {
        $config = [];

        if ($this->isInteractive()) {
            $config['configJs']['interactivity']['events']['onhover']['enable'] = true;
            $config['configJs']['interactivity']['events']['onhover']['mode']   = 'repulse';
            $config['configJs']['interactivity']['events']['onclick']['enable'] = true;
            $config['configJs']['interactivity']['events']['onclick']['mode']   = 'push';
        }

        return $this->_json->serialize($config);
    }
}
