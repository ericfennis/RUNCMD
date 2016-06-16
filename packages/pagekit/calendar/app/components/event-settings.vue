<template>

    <div class="uk-grid pk-grid-large pk-width-sidebar-large uk-form-stacked" data-uk-grid-margin>
        <div class="pk-width-content">

            <div class="uk-form-row">
                <input class="uk-width-1-1 uk-form-large" type="text" name="title" :placeholder="'Enter Title' | trans" v-model="event.title" v-validate:required>
                <p class="uk-form-help-block uk-text-danger" v-show="form.title.invalid">{{ 'Title cannot be blank.' | trans }}</p>
            </div>
            <div class="uk-form-row">
                    <span class="uk-form-label">{{ 'Event date' | trans }}</span>
                    <div class="uk-form-controls">
                        <input-date :datetime.sync="event.eventDate"></input-date>
                    </div>
            </div>

            <div class="uk-form-row">
                                    <label for="form-location" class="uk-form-label">{{ 'Location' | trans }}</label>
                                    <div class="uk-form-controls">
                                        <input id="form-location" class="uk-width-1-1 uk-form-large" type=url name="location" placeholder="NHL Hogeschool, Rengerslaan 10, 8917 DD Leeuwarden" v-model="event.location">
                                    </div>
                                </div> 

            <div class="uk-form-row">
                <label for="form-facebook_url" class="uk-form-label">{{ 'Facebook URL' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-facebook_url" class="uk-width-1-1 uk-form-large" type="url" name="Facebook url" :placeholder="'https://www.facebook.com/events/000000000/'" v-model="event.facebook_url" v-validate:required>
                    </div>
                <p class="uk-form-help-block uk-text-danger" v-show="form.facebook_url.invalid">{{ 'URL cannot be blank.' | trans }}</p>
            </div>

            <div class="uk-form-row">
                <v-editor id="event-content" :value.sync="event.content" :options="{markdown : event.data.markdown}"></v-editor>
            </div>
            <div class="uk-form-row">
                <label for="form-event-excerpt" class="uk-form-label">{{ 'Excerpt' | trans }}</label>
                <div class="uk-form-controls">
                    <v-editor id="event-excerpt" :value.sync="event.excerpt" :options="{markdown : event.data.markdown, height: 250}"></v-editor>
                </div>
            </div>

        </div>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <div class="uk-form-row">
                    <label for="form-image" class="uk-form-label">{{ 'Image' | trans }}</label>
                    <div class="uk-form-controls">
                        <input-image-meta :image.sync="event.data.image" class="pk-image-max-height"></input-image-meta>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label for="form-slug" class="uk-form-label">{{ 'Slug' | trans }}</label>
                    <div class="uk-form-controls">
                        <input id="form-slug" class="uk-width-1-1" type="text" v-model="event.slug">
                    </div>
                </div>
                <div class="uk-form-row">
                    <label for="form-status" class="uk-form-label">{{ 'Status' | trans }}</label>
                    <div class="uk-form-controls">
                        <select id="form-status" class="uk-width-1-1" v-model="event.status">
                            <option v-for="(id, status) in data.statuses" :value="id">{{status}}</option>
                        </select>
                    </div>
                </div>
                <div class="uk-form-row">
                    <span class="uk-form-label">{{ 'Publish on' | trans }}</span>
                    <div class="uk-form-controls">
                        <input-date :datetime.sync="event.date"></input-date>
                    </div>
                </div>

                <div class="uk-form-row">
                    <span class="uk-form-label">{{ 'Restrict Access' | trans }}</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <p v-for="role in data.roles" class="uk-form-controls-condensed">
                            <label><input type="checkbox" :value="role.id" v-model="event.roles" number> {{ role.name }}</label>
                        </p>
                    </div>
                </div>
                <div class="uk-form-row">
                    <span class="uk-form-label">{{ 'Options' | trans }}</span>
                    <div class="uk-form-controls">
                        <label><input type="checkbox" v-model="event.data.markdown" value="1"> {{ 'Enable Markdown' | trans }}</label>
                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

    module.exports = {

        props: ['event', 'data', 'form'],

        section: {
            label: 'event'
        }

    };

</script>
