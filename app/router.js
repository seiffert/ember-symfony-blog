import Ember from 'ember';

var Router = Ember.Router.extend({
  location: BlogENV.locationType
});

Router.map(function() {
    this.resource('blog', { path: '/' }, function () {
        this.route('post', { path: '/:slug' });
    });
    this.route('about');
    this.route('projects');
});

export default Router;
