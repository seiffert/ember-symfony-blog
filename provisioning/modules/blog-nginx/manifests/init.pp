class blog-nginx (
    $basedir                  = '/opt/blog',
    $worker_processes         = 1,
    $worker_connections       = 1024
  ) {

  class { 'nginx':
    worker_processes    => $worker_processes,
    worker_connections  => $worker_connections
  }

  nginx::resource::vhost { 'blog':
    ensure               => present,
    listen_port          => '80',
    error_log            => '/var/log/nginx/blog.error.log',
    access_log           => '/var/log/nginx/blog.access.log',
    use_default_location => false,
  }

  nginx::resource::location {'~ ^/(app|app_dev)\.php(/|$)':
    ensure              => present,
    fastcgi             => '127.0.0.1:9001',
    www_root            => "$basedir/api/web",
    fastcgi_split_path  => '/(.+\.php)(/.*)$',
    fastcgi_params      => '/etc/nginx/fastcgi_params',
    fastcgi_script      => '$document_root/$fastcgi_script_name',
    vhost               => 'blog'
  }

  nginx::resource::location {'/':
    ensure              => present,
    www_root            => "$basedir/dist",
    try_files           => ['$uri /index.html'],
    vhost               => 'blog'
  }

  nginx::resource::location {'~ ^/api':
    ensure              => present,
    www_root            => "$basedir/web",
    try_files           => ['$uri @rewriteapp'],
    vhost               => 'blog'
  }

  nginx::resource::location { '@rewriteapp':
    ensure               => present,
    location_custom_cfg  => {'rewrite' => '^/api/(.*)$ /app.php/$1 last'},
    vhost                => 'blog'
  }
}
