<?php $view->script('style-index', 'ericf/imagestyler:app/bundle/style-index.js', ['vue']) ?>

<div id="styles" class="uk-form uk-form-horizontal" v-cloak>

	<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
		<div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

			<h2 class="uk-margin-remove" v-show="!selected.length">{{ '{0} %count% Styles|{1} %count% Style|]1,Inf[ %count% Stylesl' | transChoice count {count:count} }}</h2>
			<h2 class="uk-margin-remove" v-show="selected.length">{{ '{1} %count% Style selected|]1,Inf[ %count% Styles selected' | transChoice selected.length {count:selected.length} }}</h2>

			<div class="uk-margin-left" v-show="selected.length">
				<ul class="uk-subnav pk-subnav-icon">
					<li><a class="pk-icon-check pk-icon-hover" :title="'Publish' | trans" data-uk-tooltip="{delay: 500}"
						   @click.prstyle="status(1)"></a></li>
					<li><a class="pk-icon-block pk-icon-hover" :title="'Unpublish' | trans" data-uk-tooltip="{delay: 500}"
						   @click.prstyle="status(0)"></a></li>
					<li><a class="pk-icon-delete pk-icon-hover" :title="'Delete' | trans" data-uk-tooltip="{delay: 500}"
						   @click.prstyle="removeStyles"
						   v-confirm="'Delete style? All data will be deleted from the database.' | trans"></a>
					</li>
				</ul>
			</div>

		</div>
		<div class="uk-position-relative" data-uk-margin>

			<div data-uk-dropdown="{ mode: 'click' }">
				<a class="uk-button uk-button-primary" :href="$url.route('admin/imagestyler/style/edit')">
					{{ 'Add Style' | trans }}</a>

			</div>

		</div>
	</div>

	<div class="uk-overflow-container">
		<table class="uk-table uk-table-hover uk-table-middle">
			<thead>
			<tr>
				<th class="pk-table-width-minimum"><input type="checkbox" v-check-all:selected.literal="input[name=id]"></th>
				<th class="pk-table-min-width-200" v-order:title="config.filter.order">{{ 'Title' | trans }}</th>
				<th class="pk-table-width-100 uk-text-center">
					<input-filter :title="$trans('Status')" :value.sync="config.filter.status" :options="statusOptions"></input-filter>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr class="check-item" v-for="style in styles" :class="{'uk-active': active(style)}">
				<td><input type="checkbox" name="id" value="{{ style.id }}"></td>
				<td>
					<a :href="$url.route('admin/imagestyler/style/edit', { id: style.id })">{{ style.title }}</a>
				</td>
				<td class="uk-text-center">
					<a title="{{ getStatusText(style) }}" :class="{
                                'pk-icon-circle-danger': style.status == 0,
                                'pk-icon-circle-success': style.status == 1
                            }" @click="toggleStatus(style)"></a>
				</td>
			</tr>
			</tbody>
		</table>
	</div>


	<h3 class="uk-h1 uk-text-muted uk-text-center"
		v-show="styles && !styles.length">{{ 'No styles found.' | trans }}</h3>

	<v-pagination :page.sync="config.page" :pages="pages" v-show="pages > 1"></v-pagination>

</div>
