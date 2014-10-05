import DS from 'ember-data';

var Comment = DS.Model.extend({
    author: DS.attr(),
    body: DS.attr(),
    date: DS.attr(),
    post: DS.belongsTo('post')
});

export default Comment;
