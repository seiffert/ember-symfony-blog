import DS from 'ember-data';

var Post = DS.Model.extend({
    title: DS.attr(),
    body: DS.attr(),
    date: DS.attr(),
    slug: DS.attr(),
    comments: DS.hasMany('comment', {async: true}),

    teaser: function () {
        return this.get('body').substr(0, 10);
    }.property('body'),

    addComment: function (comment) {
        this.get('comments').addObject(comment);
    },

    removeComment: function (comment) {
        this.get('comments').removeObject(comment);
    }
});

export default Post;
