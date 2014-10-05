import Ember from 'ember';

var NavigationLinkComponent = Ember.Component.extend({
    tagName: 'li',
    classNameBindings: ['active'],
    active: function() {
        return this.get('childViews').isAny('active');
    }.property('childViews.@each.active')
});

export default NavigationLinkComponent;
