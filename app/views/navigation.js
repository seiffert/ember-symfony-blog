import Ember from 'ember';

var NavigationView = Ember.View.extend({
    tagName: 'nav',
    classNames: ['navbar', 'navbar-default'],
    templateName: 'navigation',
    attributeBindings: ['role'],
    classNameBindings: ['fixed:navbar-fixed-top'],
    role: 'navigation',
    fixed: false,

    didInsertElement: function(){
        Ember.$(window).on('scroll', this.didScroll.bind(this));
    },

    didScroll: function () {
        this.set('fixed', Ember.$(window).scrollTop() > 20);
    },

    click: function() {
        if(this.$('.navbar-collapse').is('.in')) {
            this.$('.navbar-collapse').collapse('hide');
        }
    }
});

export default NavigationView;
