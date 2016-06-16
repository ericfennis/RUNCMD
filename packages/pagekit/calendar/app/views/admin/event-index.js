module.exports = {

    name: 'post',

    el: '#post',

    data: function() {
        return _.merge({
            events: false,
            config: {
                filter: this.$session.get('events.filter', {order: 'date desc', limit:25})
            },
            pages: 0,
            count: '',
            selected: [],
            canEditAll: false
        }, window.$data);
    },

    ready: function () {
        this.resource = this.$resource('api/calendar/post{/id}');
        this.$watch('config.page', this.load, {immediate: true});    
    },

    watch: {

        'config.filter': {
            handler: function (filter) {
                if (this.config.page) {
                    this.config.page = 0;
                } else {
                    this.load();
                }

                this.$session.set('events.filter', filter);
            },
            deep: true
        }

    },

    computed: {

        statusOptions: function () {

            var options = _.map(this.$data.statuses, function (status, id) {
                return { text: status, value: id };
            });

            return [{ label: this.$trans('Filter by'), options: options }];
        }

        // authors: function() {

        //     var options = _.map(this.$data.authors, function (author) {
        //         return { text: author.username, value: author.user_id };
        //     });

        //     return [{ label: this.$trans('Filter by'), options: options }];
        // }
    },

    methods: {

        active: function (post) {
            return this.selected.indexOf(post.id) != -1;
        },

        save: function (post) {
            this.resource.save({ id: post.id }, { post: post }).then(function () {
                this.load();
                this.$notify('Event saved.');
            });
        },

        status: function(status) {

            var events = this.getSelected();

            events.forEach(function(post) {
                post.status = status;
            });

            this.resource.save({ id: 'bulk' }, { events: events }).then(function () {
                this.load();
                this.$notify('Events saved.');
            });
        },

        remove: function() {

            this.resource.delete({ id: 'bulk' }, { ids: this.selected }).then(function () {
                this.load();
                this.$notify('Events deleted.');
            });
        },

        toggleStatus: function (post) {
            post.status = post.status === 2 ? 3 : 2;
            this.save(post);
        },

        copy: function() {

            if (!this.selected.length) {
                return;
            }

            this.resource.save({ id: 'copy' }, { ids: this.selected }).then(function () {
                this.load();
                this.$notify('Events copied.');
            });
        },

        load: function () {
            this.resource.query({ filter: this.config.filter, page: this.config.page }).then(function (res) {

                var data = res.data;

                this.$set('events', data.events);
                this.$set('pages', data.pages);
                this.$set('count', data.count);
                this.$set('selected', []);
            });
        },

        getSelected: function() {
            return this.events.filter(function(post) { return this.selected.indexOf(post.id) !== -1; }, this);
        },

        getStatusText: function(post) {
            return this.statuses[post.status];
        }

    }

};

Vue.ready(module.exports);
