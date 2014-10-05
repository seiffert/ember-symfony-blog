class blog-php (
    $user             = vagrant,
    $group            = vagrant,
    $max_children     = 5,
    $start_servers    = 2,
    $min_spare        = 1,
    $max_spare        = 3,
    $max_requests     = 0,
    $default_timezone = 'Europe/Berlin'
) {
    class { ['php::fpm', 'php::cli', 'php::extension::curl']:

    }

    class { 'php::extension::mysql':
        package   => 'php5-mysqlnd',
    }

    php::fpm::pool { 'www':
        ensure => absent,
    }

    php::fpm::pool { 'blog':
        listen                => '127.0.0.1:9001',
        user                  => $user,
        group                 => $group,
        pm_max_children       => $max_children,
        pm_start_servers      => $start_servers,
        pm_min_spare_servers  => $min_spare,
        pm_max_spare_servers  => $max_spare,
        pm_max_requests       => $max_requests,
    }

    php::config { 'set timezone':
        setting => 'date.timezone',
        value   => $default_timezone,
        file    => '/etc/php5/fpm/php.ini',
        section => 'Date',
    }

    class { ['php::composer', 'php::composer::auto_update']:

    }
}
