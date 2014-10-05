import Ember from 'ember';

var BlogPostController = Ember.ObjectController.extend({
    _models: null,

    model: function(key, value) {
        var models = this.get('_models');
        if (arguments.length === 2) {
            models = Ember.makeArray(value);
            this.set('_models', models);
        }
        return Ember.get(models, 'firstObject');
    }.property('_models.firstObject'),

    actions: {
        addComment: function () {
            var author = this.get('newCommentAuthor'),
                body = this.get('newComment');

            if (!author || !author.trim()) {
                return false;
            }
            if (!body || !body.trim()) {
                return false;
            }

            var post = this.get('model');
            var comment = this.store.createRecord('comment', {
                author: author,
                body: body,
                post: post
            });

            this.set('newCommentAuthor', '');
            this.set('newComment', '');

            // Save the new model
            comment.save().then(function () {
                post.addComment(comment);
            });
        },

        removeComment: function (id) {
            if (confirm('Are you sure?')) {
                var post = this.get('model');
                this.store.find('comment', id).then(function (comment) {
                    post.removeComment(comment);
                    comment.destroyRecord();
                });
            }
        }
    }
});

export default BlogPostController;
