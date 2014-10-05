class blog-mysql (
    $database_name      = 'blog',
    $database_username  = 'blog',
    $database_password  = 'blog',
    $root_password      = 'ThisPasswordIsVeryStrong',
) {
    class { '::mysql::server':
      root_password    => $root_password
    }

    mysql::db { $database_name:
      user     => $database_username,
      password => $database_password,
      host     => 'localhost',
      grant    => ['ALL'],
    }
}
