<?php 

namespace App\Library;

class Xml
{
    /**
     * xml
     * @var string
     */
    protected $xml;

    /**
     * XSD validation errors
     * @var array
     */
    protected $errors;

    /**
     * Constructor
     *
     * @param string $xml
     */
    public function __construct($xml = '')
    {
        $this->xml = $xml;
    }

    /**
     * Gets all XML files from a remote folder
     * 
     * @param  string $xml 
     * @return array
     */
   	public function toArray($xml)
   	{    	
    	$xml = $xml ?: $this->xml;
        //$array = json_decode(str_replace('{"0":" "}','null', json_encode(simplexml_load_string($xml),JSON_NUMERIC_CHECK)), true);
        $array = json_decode(str_replace('{"0":" "}','null', json_encode(simplexml_load_string($xml))), true);
        $this->filterEmptyArray($array);

        return $array;
  	}

    /**
     * Replace data in a node
     * 
     * @param  string $xml 
     * @param  string $node 
     * @param  string $find 
     * @param  string $replace 
     * @return string
     */
    public function replaceInNode($xml, $node, $find, $replace)
    {       
        return preg_replace_callback('@(<' . $node . '>)' . $find . '(</' . $node . '>)@s', function ($matches) use ($replace) {
            return str_replace(' ', $replace, $matches[0]);
        }, $xml);
    }

    /**
     * Converts an xml string into a SimpleXml object
     * 
     * @param  string $xml 
     * @return SimpleXml
     */
    public function toXml($xml, $namespace = null)
    {       
        $xml = $xml ?: $this->xml;

        libxml_use_internal_errors(true);
        $xmlDoc = simplexml_load_string($xml, null, 0, $namespace, !is_null($namespace));
        
        if ($xmlDoc === false) {
            $this->errors = libxml_get_errors();
            
            return false;
        }

        return $xmlDoc;    
    }

    /**
     * Get an array of attributes from an XML node
     * @param  SimpleXMLElement $node 
     * @return array
     */
    public static function attributes($node)
    {
        return current($node->attributes());
    }

    /**
     * Validates an xml string against
     * @param  string $xml     
     * @param  string $xsdPath
     * @return bool
     */
    public function validate($xsdPath, $xml = null)
    {
        $xml = $xml ?: $this->xml;

        libxml_use_internal_errors(true);
        $xmlDoc = new \DOMDocument(); 
        $xmlDoc->loadXML($xml);
        
        if (!$xmlDoc->schemaValidate($xsdPath)) {
            
            $this->errors = libxml_get_errors();
            
            return false;
        }

        return true;
    }

    /**
     * Validates an xml string against
     * @param  bool $compact
     * @return array
     */
    public function getErrors($compact = true)
    {
        $errors = [];

        if (!$compact) {
            $errors = $this->errors;
        } else {

            foreach ($this->errors as $error) {
                $errors[] = $error->message;
            }
        }

        return $errors;
    }

    /**
     * Converts empty array nodes into empty strings to corredt the toArray() side effect
     * 
     * @param  array  &$array
     */
    public function filterEmptyArray(array &$array) 
    {
        foreach ($array as $key=>&$val) {
            if (empty($val)) {
                $array[$key] = "";
            } else {
                is_array($val) && $this->filterEmptyArray($val);
            }
        }
    }
}