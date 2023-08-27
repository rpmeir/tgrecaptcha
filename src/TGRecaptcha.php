<?php

namespace Rpmeir\TGRecaptcha;

use Adianti\Widget\Form\TField;
use Adianti\Widget\Form\AdiantiWidgetInterface;

class TGRecaptcha extends TField implements AdiantiWidgetInterface
{
    protected $name;
    protected $form;
    protected $required;
    protected $labelRequired;
    protected $validator;
    protected $validatorLabel;
    protected $width;
    protected $height;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTagName('div');
        $this->setName($name);
        $this->id = 'tgrecaptcha'.mt_rand(1000000000, 1999999999);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRequired($required)
    {
        $this->required = $required;
    }

    public function getRequired()
    {
        return $this->required;
    }

    public function setLabelRequired($labelRequired)
    {
        $this->labelRequired = $labelRequired;
    }

    public function getLabelRequired()
    {
        return $this->labelRequired;
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidatorLabel($validatorLabel)
    {
        $this->validatorLabel = $validatorLabel;
    }

    public function getValidatorLabel()
    {
        return $this->validatorLabel;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getSize()
    {
        return [
            $this->width ?? null,
            $this->height ?? null
        ];
    }

    public function getPostData()
    {
        return $_REQUEST['g-recaptcha-response'] ?? null;
    }

    public function show()
    {
        $this->tag->id = $this->id;
        $this->tag->name = $this->name;

        $recaptcha_config = require_once('app/config/recaptcha.php');

        $this->tag->style = 'padding-left:50px; margin-bottom: -25px;';
        $this->tag->add("
            <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
            <div class='g-recaptcha' data-sitekey='{$recaptcha_config['chave_site']}' ></div>
        ");

        if(!empty($this->width))
        {
            $width = (strstr((string) $this->width, '%') !== false) ? $this->width : "{$this->width}";
            $this->tag->style .= "width:{$width}";
        }

        if(!empty($this->height))
        {
            $height = (strstr((string) $this->height, '%') !== false) ? $this->height : "{$this->height}";
            $this->tag->style .= "height:{$height}";
        }

        $this->tag->class = '';

        $this->tag->show();
    }
}
