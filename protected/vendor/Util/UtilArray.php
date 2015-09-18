<?php
class UtilArray
{
    /**********************************************
     * 
     * 实现在数组前添加数组元素
     * 
     *******************************************************/ 
    public static function unshift($array, $insert=array())
    {
        
        $keys = array_keys($array);
        $values = array_values($array);
        
        foreach($insert as $key=>$value)
        {
            array_unshift($keys, $key);
            array_unshift($values, $value);
        }
        
        return array_combine($keys,$values);    
        
    }
    
}
?>