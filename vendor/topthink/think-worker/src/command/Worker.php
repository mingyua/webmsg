<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think\worker\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Config;
use think\worker\Worker as HttpServer;

/**
 * Worker 命令行类
 */
class Worker extends Command
{
    protected $config = [];

    public function configure()
    {
        $this->setName('worker')
            ->addArgument('action', Argument::OPTIONAL, "start|stop|restart|reload|status", 'start')
            ->setDescription('Workerman HTTP Server for ThinkPHP');
    }

    public function execute(Input $input, Output $output)
    {
        $action = $input->getArgument('action');

        $this->config = Config::pull('worker');

        if (DIRECTORY_SEPARATOR !== '\\') {
            if (!in_array($action, ['start', 'stop', 'reload', 'restart', 'status'])) {
                $output->writeln("Invalid argument action:{$action}, Expected start|stop|restart|reload|status .");
                exit(1);
            }

            global $argv;
            array_shift($argv);
            array_shift($argv);
            array_unshift($argv, 'think', $action);
        } elseif ('start' != $action) {
            $output->writeln("Not Support action:{$action} on Windows.");
            exit(1);
        }

        $output->writeln('Starting Workerman http server...');

        $host = !empty($this->config['host']) ? $this->config['host'] : '0.0.0.0';
        $port = !empty($this->config['port']) ? $this->config['port'] : 2346;

        if (isset($this->config['context_option'])) {
            $context = $this->config['context_option'];
            unset($this->config['context_option']);
        } else {
            $context = [];
        }

        $worker = new HttpServer($host, $port, $context);

        if (!empty($this->config['ssl'])) {
            $this->config['transport'] = 'ssl';
        }

        $worker->option($this->config);

        if (DIRECTORY_SEPARATOR == '\\') {
            $output->writeln("Workerman http server started: <http://{$host}:{$port}>");
            $output->writeln('You can exit with <info>`CTRL-C`</info>');
        }

        $worker->start();
    }

}
