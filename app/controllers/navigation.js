import Ember from 'ember';

var NavigationController = Ember.ArrayController.extend({
    model: Ember.A([
        Ember.Object.create({title: "Blog", location: 'blog', active: null}),
        Ember.Object.create({title: "Projects", location: 'projects', active: null}),
        Ember.Object.create({title: "About", location: 'about', active: null})
    ]),
    title: "Almighty Machine"
});

export default NavigationController;
