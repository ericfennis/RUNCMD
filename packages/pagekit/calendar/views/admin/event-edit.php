<?php $view->script('event-edit', 'calendar:app/bundle/event-edit.js', ['vue', 'editor', 'uikit']) ?>

<form id="event" class="uk-form" v-validator="form" @submit.prevent="save | valid" v-cloak>

    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>

            <h2 class="uk-margin-remove" v-if="event.id">{{ 'Edit Event' | trans }}</h2>
            <h2 class="uk-margin-remove" v-else>{{ 'Add Event' | trans }}</h2>

        </div>
        <div data-uk-margin>

            <a class="uk-button uk-margin-small-right" :href="$url.route('admin/calendar/event')">{{ event.id ? 'Close' : 'Cancel' | trans }}</a>
            <button class="uk-button uk-button-primary" type="submit">{{ 'Save' | trans }}</button>

        </div>
    </div>

    <ul class="uk-tab" v-el:tab v-show="sections.length > 1">
        <li v-for="section in sections"><a>{{ section.label | trans }}</a></li>
    </ul>

    <div class="uk-switcher uk-margin" v-el:content>
        <div v-for="section in sections">
            <component :is="section.name" :event.sync="event" :data.sync="data" :form="form"></component>
        </div>
    </div>

</form>
