<template>

    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="uk-flex-item-1 uk-form-horizontal">

            <div class="uk-form-row">
                <label for="form-title" class="uk-form-label">{{ 'Title' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-title" class="uk-form-width-large" type="text" name="title" v-model="widget.title" v-validate:required>
                    <p class="uk-form-help-block uk-text-danger" v-show="form.title.invalid">{{ 'Title cannot be blank.' | trans }}</p>
                </div>
            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">Image</span>
                <div class="uk-form-controls uk-form-controls-text">
                    <label><input id="form-display-image" class="uk-form-width-large" type="checkbox" name="display-image" v-model="widget.data.display_image"> Show Article Image</label>
                </div>
            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">How many posts did you want to display?</span>
                <div class="uk-form-controls">
                    <input id="form-blog-posts-limit" class="uk-form-width-large" type="number", name="blog-posts-limit" v-model="widget.data.blog_posts_limit">
                </div>
            </div>

        </div>
        <div class="pk-width-sidebar pk-width-sidebar-large">

            <partial name="settings"></partial>

        </div>
    </div>

</template>

<script>
    module.exports = {

        section: {
            label: 'Settings'
        },

        replace: false,

        props: ['config', 'form', 'widget'],

        created: function () {
            this.$options.partials = this.$parent.$options.partials;
        }
    };
    window.Widgets.components['vision-rbp:settings'] = module.exports;
</script>
