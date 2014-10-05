import Ember from 'ember';

var BlogPostRoute = Ember.Route.extend({
    model: function (params) {
        return this.store.find('post', { slug: params.slug });
    },

    serialize: function(model) {
        return { slug: model.get('slug') };
    }
});

export default BlogPostRoute;
