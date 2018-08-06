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
class GetMacAddr {
    /**
     * 返回数据[数组]
     *
     * @return array
     */
    private $data;
    /**
     * MAC地址
     *
     * @return MAC
     */
    private $mac_addr;
    /**
     * 系统类型
     *
     * @return PHP_OS
     */
    private $os_type;
    /**
     * 返回读取的长整型数
     *
     * @access private
     * @return int
     */
    public function GetMacAddr($os_type) {
        switch (strtolower($os_type)) {
            case "linux":
                $this->forLinux();
                break;

            case "solaris":
                break;

            case "unix":
                break;

            case "aix":
                break;

            default:
                $this->forWindows();
                break;
        }
        $temp_array = array();
        foreach ($this->data as $value) {
            if (preg_match("/[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f]/i", $value, $temp_array)) {
                $this->mac_addr = $temp_array[0];
                break;
            }
        }
        unset($temp_array);
        return $this->mac_addr;
    }
    public function forWindows() {
        @exec("ipconfig /all", $this->data);
        if ($this->data) return $this->data;
        else {
            $ipconfig = $_SERVER["WINDIR"] . "\system32\ipconfig.exe";
            if (is_file($ipconfig)) @exec($ipconfig . " /all", $this->data);
            else @exec($_SERVER["WINDIR"] . "\system\ipconfig.exe /all", $this->data);
            return $this->data;
        }
    }
    public function forLinux() {
        @exec("ifconfig -a", $this->data);
        return $this->data;
    }
}
?>