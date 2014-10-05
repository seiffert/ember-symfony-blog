import Ember from 'ember';

var BlogIndexRoute = Ember.Route.extend({
    model: function () {
        return this.store.find('post');
    }
});

export default BlogIndexRoute;
