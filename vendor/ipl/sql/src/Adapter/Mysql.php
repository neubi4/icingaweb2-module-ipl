<?php

namespace ipl\Sql\Adapter;

use ipl\Sql\Connection;
use ipl\Sql\Config;
use PDO;

class Mysql extends BaseAdapter
{
    protected $quoteCharacter = ['`', '`'];

    protected $escapeCharatcer = '``';

    public function setClientTimezone(Connection $db)
    {
        $db->prepexec('SET time_zone = ?', [$this->getTimezoneOffset()]);

        return $this;
    }

    public function getOptions(Config $config)
    {
        $options = parent::getOptions($config);

        if (property_exists($config, 'use_ssl') && $config->use_ssl === '1') {
            if (property_exists($config, 'ssl_key')) {
                $options[PDO::MYSQL_ATTR_SSL_KEY] = $config->ssl_key;
            }
            if (property_exists($config, 'ssl_cert')) {
                $options[PDO::MYSQL_ATTR_SSL_CERT] = $config->ssl_cert;
            }
            if (property_exists($config, 'ssl_ca')) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = $config->ssl_ca;
            }
            if (property_exists($config, 'ssl_capath')) {
                $options[PDO::MYSQL_ATTR_SSL_CAPATH] = $config->ssl_capath;
            }
            if (property_exists($config, 'ssl_cipher')) {
                $options[PDO::MYSQL_ATTR_SSL_CIPHER] = $config->ssl_cipher;
            }
        }

        return $options;
    }
}
