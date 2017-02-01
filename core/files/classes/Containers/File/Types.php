<?php
/**
 * User: Tibor
 * Date: 2014.02.27.
 * Time: 13:25
 * Project: panoramaapartman.eu
 * Company: d2c
 */
class Containers_File_Types extends Containers
{
    private $types;
    private $firsts;

    function __construct(array $types)
    {
        foreach($types as $item)
        {
            $this->initTypes($item);
            $this->initFirsts($item);
        }
    }

    /**
     * @param mixed $types
     */
    public function initTypes($types)
    {
        $this->types[$types->ft_tag] = array();
    }

    /**
     * @return mixed
     */
    public function getTypes($name)
    {
        return (isset($this->types[$name])) ? $this->types[$name] : array();
    }

    /**
     * @param mixed $firsts
     */
    public function initFirsts($firsts)
    {
        $this->firsts[$firsts->ft_tag] = new Model_Files();
    }

    /**
     * @return mixed
     */
    public function getFirst($name)
    {
        return $this->firsts[$name];
    }

    /**
     * @param mixed $firsts
     */
    public function setFirsts($tag ,Model_Files $file)
    {
        $this->firsts[$tag] = $file;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($tag, Model_Files $file)
    {
        $this->types[$tag][] = $file;
    }

    public function setFileType(Model_Files $file)
    {
        $currentTypes = $file->types->find_all();
        foreach($currentTypes as $item)
        {
            if (count($this->getTypes($item->ft_tag)) == 0) {
                $this->setFirsts($item->ft_tag,$file);
            }

            $this->setTypes($item->ft_tag,$file);
        }
    }

}