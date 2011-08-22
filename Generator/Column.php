<?php

namespace Admingenerator\GeneratorBundle\Generator;

/**
 *
 * This class describe a column
 * @author cedric Lombardot
 *
 */
use Doctrine\Common\Util\Inflector;

class Column
{
    protected $name;
    
    protected $sortOn;
    
    protected $dbType;
    
    protected $formType;
    
    protected $formOptions = array();
    
    protected $getter;
    
    protected $label;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getGetter()
    {
        return $this->getter ? $this->getter : Inflector::camelize($this->name);
    }
    
    public function setGetter($getter)
    {
        $this->getter = $getter;
    }

    public function getLabel()
    {
        return $this->label ? $this->label : $this->humanize($this->getName());
    }
    
    public function setLabel($label)
    {
        return $this->label = $label;
    }
    
    public function isSortable()
    {
        return $this->isReal() || $this->sortOn != "";
    }
    
    public function isReal()
    {
        return true;
    }
    
    public function getSortOn()
    {
        return $this->sortOn != "" ? $this->sortOn : $this->name;
    }
    
    public function setSortOn($sort_on)
    {
        return $this->sortOn = $sort_on;
    }
    
    private function humanize($text)
    {
        return ucfirst(strtolower(str_replace('_', ' ', $text)));
    }
    
    public function setDbType($dbType)
    {
        $this->dbType = $dbType;
    }
    
    public function getDbType()
    {
        return $this->dbType;
    }
    
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }
    
    public function getFormType()
    {
        return $this->formType;
    }
    
    public function setFormOptions($formOptions)
    {
        $this->formOptions = $formOptions;
    }
    
    public function getFormOptions()
    {
        return $this->formOptions;
    }
    
    public function setOption($option, $value)
    {
        $option = Inflector::classify($option);
        call_user_func_array(array($this, 'set'.$option), array($value));
    }
    
    public function setAddformOptions(array $complementary_options = array())
    {
        foreach ($complementary_options as $option => $value) {
            $this->formOptions[$option] = $value;
        }
    }
}