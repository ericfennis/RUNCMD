window.Post = {

    el: '#style',

    data: function () {
        return {
            data: window.$data,
            event: window.$data.event,
            sections: []
        }
    },

    created: function () {

        var sections = [];

        _.forIn(this.$options.components, function (component, name) {

            var options = component.options || {};

            if (options.section) {
                sections.push(_.extend({name: name, priority: 0}, options.section));
            }

        });

        this.$set('sections', _.sortBy(sections, 'priority'));

        this.resource = this.$resource('api/imagestyler/style{/id}');
    },

    ready: function () {
        this.tab = UIkit.tab(this.$els.tab, {connect: this.$els.content});
    },

    methods: {

        save: function () {
            var data = {event: this.style, id: this.style.id};

            this.$broadcast('save', data);

            this.resource.save({id: this.style.id}, data).then(function (res) {

                var data = res.data;

                if (!this.style.id) {
                    window.history.replaceState({}, '', this.$url.route('admin/imagestyler/style/edit', {id: data.style.id}))
                }

                this.$set('style', data.style);

                this.$notify('Style saved.');

            }, function (res) {
                this.$notify(res.data, 'danger');
            });
        }

    },

    components: {



    }

};

Vue.ready(window.Post);
