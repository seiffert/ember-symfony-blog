# Ember/Symfony Blog

This is an example project to demonstrate a development infrastructure for projects using ember.js
and symfony.

## Prerequisites

You will need the following things properly installed on your computer.

* [Git](http://git-scm.com/)
* [Node.js](http://nodejs.org/) (with NPM) and [Bower](http://bower.io/)
* [Vagrant](https://www.vagrantup.com)
* [Vagrant Librarian Puppet Plugin](https://github.com/mhahn/vagrant-librarian-puppet)

## Installation

* `git clone https://github.com/seiffert/ember-symfony-blog.git` this repository
* change into the new directory
* `npm install`
* `bower install`
* `vagrant up`
* `vagrant ssh`
    * `cd /opt/blog`
    * `composer install`
    * `php app/console doctrine:schema:create`
    * `php app/console doctrine:fixtures:load`

## Running / Development

* `ember server --proxy=http://192.168.10.123:80`
* Visit your app at http://localhost:4200.

### Building

* `ember build` (development)
* `ember build --environment production` (production)

## Further Reading / Useful Links

* ember: http://emberjs.com/
* ember-cli: http://www.ember-cli.com/
* [Give me some REST - RESTful APIs mit Symfony](http://de.slideshare.net/seiffertp/give-me-some-rest-restful-apis-mit-symfony)
