<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2018-2020 The MingYu                                   |
// +----------------------------------------------------------------------+
// | Authors: Original Author <285412937@qq.com>                          |
// |          MingYu <285412937@qq.com>                                   |
// +----------------------------------------------------------------------+
namespace mac;
    class GetMacAddr{
            var $return_array = array(); // 返回带有MAC地址的字串数组
            var $mac_addr;
            function GetMacAddr($os_type){
                    switch(strtolower($os_type)){   
                            case "linux":$this->forLinux();break;
                            default:$this->forWindows();break;
                    }   
                    $temp_array = array();   
                    foreach ( $this->return_array as $value ){   
                            if ( preg_match( "/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i", $value, $temp_array ) ) {   
                                    $this->mac_addr = $temp_array[0];   
                                    break;   
                            }   
                    }   
                    unset($temp_array);   
                    return $this->mac_addr;   
            }  
            function forWindows()   {   
                    @exec("ipconfig /all", $this->return_array);   
                    if ( $this->return_array )   
                            return $this->return_array;   
                    else{   
                            $ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";   
                            if ( is_file($ipconfig) )   
                                    @exec($ipconfig." /all", $this->return_array);   
                            else  
                                    @exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all", $this->return_array);   
                            return $this->return_array;   
                    }   
            }   
      }   

?>